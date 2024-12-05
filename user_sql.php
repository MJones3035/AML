<?php

include_once("database.php");

enum Roles
{
    const USER = 1;
    const BRANCH_LIBRARIAN = 2;
    const BRANCH_MANAGER = 3;
    const PURCHASE_MANAGER = 4;
    const ACCOUNTANT = 5;
    const ADMIN = 6;
}

enum AuthoriseStates
{
    const MATCH = 1;
    const INVALID_PASSWORD = 2;
    const INVALID_BOTH = 3;
    const INACTIVE = 4;
}

function authorise_user(string $username, string $password): array
{
    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    $sql = 'SELECT user_id, password FROM user_credentials WHERE username=?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    $stmt->close();
    $conn->close();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            return ['status' => AuthoriseStates::MATCH, 'user_id' => $row['user_id']];
        } else {
            return ['status' => AuthoriseStates::INVALID_PASSWORD];
        }
    } else {
        return ['status' => AuthoriseStates::INVALID_BOTH];
    }
}

function get_user(int $user_id): array
{

    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    $query = 'SELECT * FROM user_details, user_credentials WHERE user_credentials.user_id = ?';
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the user exists
    if ($result->num_rows == 0) {
        echo "User not found.";
        exit;
    }

    // Fetch the user's information
    $user_data = $result->fetch_assoc();

    // Close the statement and connection
    $stmt->close();
    $conn->close();

    return $user_data;
}

function does_username_exist(string $username): bool
{

    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    // returns bool
    $sql = 'SELECT EXISTS(SELECT 1 FROM user_credentials WHERE username=?)';

    $stmt = $conn->prepare($sql);

    $stmt->bind_param(
        's',
        $username
    );

    $stmt->execute();

    $row = $stmt->get_result()->fetch_row();

    //bool
    $res = $row[0];

    $stmt->close();
    $conn->close();

    return $res;
}

function generate_random_code(int $size = 32): string
{
    return bin2hex(random_bytes($size / 2));  // returns 32 random characters
}

function create_user(array $data, Roles $role, float $expiry = 1 * 24 * 60 * 60,): bool
{
    // credentials
    $created = true;
    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    $sql = 'INSERT INTO user_credentials(username, password) VALUES (?,?)';

    $stmt = $conn->prepare($sql);

    //$id = uniqid();

    $password_hash = password_hash($data['password'], PASSWORD_BCRYPT);

    $stmt->bind_param(
        'ss',
        $data['username'],
        $password_hash
    );

    $stmt->execute();

    if (!$stmt) {
        $created = false;
    }

    // activation
    $sql = 'INSERT INTO user_activation(user_id, activation_code, activation_expiry) VALUES (?,?,?)';

    $stmt = $conn->prepare($sql);

    $last_id = mysqli_insert_id($conn);
    $activation_code = $data['activation_code'];
    $expiryDate = date(('Y-m-d H:i:s'), time() + $expiry);

    $stmt->bind_param(
        'iss',
        $last_id,
        $activation_code,
        $expiryDate

    );

    $stmt->execute();

    if ($stmt) {
        $created = true;
    }

    // details
    $sql = 'INSERT INTO user_details(user_id, first_name, last_name, date_of_birth, email, address, postcode, phone_number) VALUES (?, ?, ?, ?, ?, ?, ?, ?)';

    $stmt = $conn->prepare($sql);

    $password_hash = password_hash($data['password'], PASSWORD_BCRYPT);

    $stmt->bind_param(
        'issssssi',
        $last_id,
        $data['first_name'],
        $data['last_name'],
        $data['date_of_birth'],
        $data['email'],
        $data['address'],
        $data['postcode'],
        $data['phone'],

    );

    $stmt->execute();

    if (!$stmt) {
        $created = false;
    }

    // privileges
    $sql = 'INSERT INTO user_privileges(user_id, is_branch_librarian, is_branch_manager, is_purchase_manager, is_accountant, is_admin) VALUES (?, ?, ?, ?, ?, ?)';

    $stmt = $conn->prepare($sql);

    $password_hash = password_hash($data['password'], PASSWORD_BCRYPT);

    $is_branch_librarian =  ($role == Roles::BRANCH_LIBRARIAN) ? 1 : 0;
    $is_branch_manager = ($role == Roles::BRANCH_MANAGER) ? 1 : 0;
    $is_purchase_manager = ($role == Roles::PURCHASE_MANAGER) ? 1 : 0;
    $is_accountant = ($role == Roles::ACCOUNTANT) ? 1 : 0;
    $is_admin = ($role == Roles::ADMIN) ? 1 : 0;

    $stmt->bind_param(
        'iiiiii',
        $last_id,
        $is_branch_librarian,
        $is_branch_manager,
        $is_purchase_manager,
        $is_accountant,
        $is_admin
    );

    $stmt->execute();

    if (!$stmt) {
        $created = false;
    }

    $stmt->close();
    $conn->close();

    return $created;
}

function update_user(int $user_id, string $first_name, string $last_name, string $date_of_birth, string $email, string $address, string $postcode, int $phone_number): bool
{
    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    $query = 'UPDATE user_details SET first_name = ?, last_name = ?, date_of_birth = ?, email = ?, address = ?, postcode = ?, phone_number = ? WHERE user_id = ?';
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssssssi", $first_name, $last_name, $date_of_birth, $email, $address, $postcode, $phone_number, $user_id);
    $stmt->execute();

    $updated = $stmt->affected_rows > 0; // returns if any rows were updated

    $stmt->close();
    $conn->close();

    return $updated;
}

function activate_user(int $user_id): bool
{
    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    $sql = 'UPDATE user_activation
            SET active = 1,
                activated_at = CURRENT_TIMESTAMP
            WHERE user_id=?';

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $user_id);

    $stmt->execute();
    $activated = $stmt->affected_rows > 0; // returns if any rows were updated

    $stmt->close();
    $conn->close();

    return $activated;
}

function find_unactivated_user(string $email, string $activation_code)
{

    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    $sql = 'SELECT 
            user_activation.user_id, 
            user_activation.activation_code, 
            user_activation.activation_expiry < NOW() AS expired
            FROM 
                user_details
            INNER JOIN 
                user_activation 
            ON 
                user_details.user_id = user_activation.user_id
            WHERE 
                user_details.email = ? 
                AND user_activation.active = 0
                AND user_activation.activation_code=?';

    $statement = $conn->prepare($sql);

    $statement->bind_param('ss', $email, $activation_code);
    $statement->execute();

    $res = $statement->get_result();

    $user = $res->fetch_assoc();

    $statement->close();
    $conn->close();

    if (password_verify($activation_code, $user['activation_code'])){
        return $user;
    }

    return $user;
}

function is_user_active(int $user_id, int $active = 1): bool
{
    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    $sql = 'SELECT EXISTS(SELECT 1 FROM user_activation
            WHERE user_id =? AND active =?)';

    $statement = $conn->prepare($sql);
    $statement->bind_param('ii', $user_id, $active);

    $statement->execute();

    $is_active = 0;

    $statement->bind_result($is_active);
    $statement->fetch();

    $statement->close();
    $conn->close();

    return (bool)$is_active;
}

function delete_user_by_id(int $user_id): bool
{
    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    $sql = 'DELETE FROM user_credentials
            WHERE user_id=?';

    $statement = $conn->prepare($sql);
    $statement->bind_param('i', $user_id);

    $deleted = $statement->execute();

    $statement->close();
    $conn->close();

    return $deleted;
}
