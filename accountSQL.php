<?php

include("database.php");

enum Roles {
    case USER;
    case BRANCH_LIBRARIAN;
    case BRANCH_MANAGER;
    case PURCHASE_MANAGER;
    case ACCOUNTANT;
    case ADMIN;
}

enum AuthoriseStates {
    const MATCH = 1;
    const INVALID_PASSWORD = 2;
    const INVALID_BOTH = 3;
}

function Authorise($username, $password) {
    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    $sql = 'SELECT user_id, password FROM user_credentials WHERE username=?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

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

function GetAccount($userID) {

    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    $query = "SELECT * FROM user_details WHERE user_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $userID);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the user exists
    if ($result->num_rows == 0) {
        echo "User not found.";
        exit;
    }

    // Fetch the user's information
    $userData = $result->fetch_assoc();

    // Close the statement and connection
    $stmt->close();
    $conn->close();

    return $userData;
}

function UsernameExists($username) {

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

    $conn->close();

    return $res;

}

function GenerateRandomCode($size = 16): string {
    return bin2hex(random_bytes($size));
}

function CreateAccount($data, $role, $expiry = 1 * 24 * 60 * 60, )
{
    // credentials
    $created = true;
    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    $sql = 'INSERT INTO user_credentials(username, password) VALUES (?,?)';

    $stmt = $conn->prepare($sql);

    //$id = uniqid();

    $passwordHash = password_hash($data['password'], PASSWORD_BCRYPT);

    $stmt->bind_param(
        'ss',
        $data['username'],
        $passwordHash
    );

    $stmt->execute();

    if (!$stmt) {
        $created = false;
    }

    // activation
    $sql = 'INSERT INTO user_activation(user_id, activation_code, activation_expiry) VALUES (?,?,?)';

    $stmt = $conn->prepare($sql);

    $lastID = mysqli_insert_id($conn);
    $activationCode = GenerateRandomCode();
    $expiryDate = date(('Y-m-d H:i:s'), time() + $expiry);

    $stmt->bind_param(
        'iss',
        $lastID,
        $activationCode,
        $expiryDate

    );

    $stmt->execute();

    if ($stmt) {
        $created = true;
    }

    // details
    $sql = 'INSERT INTO user_details(user_id, first_name, last_name, date_of_birth, email, address, postcode, phone_number) VALUES (?, ?, ?, ?, ?, ?, ?, ?)';

    $stmt = $conn->prepare($sql);

    $passwordHash = password_hash($data['password'], PASSWORD_BCRYPT);

    $stmt->bind_param(
        'issssssi',
        $lastID,
        $data['firstname'],
        $data['lastname'],
        $data['dateofbirth'],
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

    $passwordHash = password_hash($data['password'], PASSWORD_BCRYPT);

    $isBranchLibrarian =  ($role == Roles::BRANCH_LIBRARIAN) ? 1 : 0;
    $isBranchManager = ($role == Roles::BRANCH_MANAGER) ? 1 : 0;
    $isPurchaseManager = ($role == Roles::PURCHASE_MANAGER) ? 1 : 0;
    $isAccountant = ($role == Roles::ACCOUNTANT) ? 1 : 0;
    $isAdmin = ($role == Roles::ADMIN) ? 1 : 0;

    $stmt->bind_param(
        'iiiiii',
        $lastID,
        $isBranchLibrarian,
        $isBranchManager,
        $isPurchaseManager,
        $isAccountant,
        $isAdmin
    );

    $stmt->execute();

    if (!$stmt) {
        $created = false;
    }

    $conn->close();

    return $created;


}

function UpdateAccount($userID, $first_name, $last_name, $date_of_birth, $email, $address, $postcode, $phone_number) {
    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    $query = "UPDATE user_details SET first_name = ?, last_name = ?, date_of_birth = ?, email = ?, address = ?, postcode = ?, phone_number = ? WHERE user_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssssssi", $first_name, $last_name, $date_of_birth, $email, $address, $postcode, $phone_number, $userID);
    $stmt->execute();

    $stmt->close();
    $conn->close();
}

?>