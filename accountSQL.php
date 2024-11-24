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

    $stmtRes = $stmt->get_result()->fetch_row();

    //bool
    $res = $stmtRes[0];

    $conn->close();

    return $res;

}

function CreateProfile($data, $role)
{
    $created = false;
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

    if ($stmt) {
        $created = true;
    }

    $sql = 'INSERT INTO user_details(user_id, first_name, last_name, date_of_birth, email, address, postcode, phone_number) VALUES (?, ?, ?, ?, ?, ?, ?, ?)';

    $stmt = $conn->prepare($sql);

    $passwordHash = password_hash($data['password'], PASSWORD_BCRYPT);

    $lastID = mysqli_insert_id($conn);

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

    if ($stmt) {
        $created = true;
    }

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

    if ($stmt) {
        $created = true;
    }

    $conn->close();

    return $created;


}

?>