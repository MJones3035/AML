<?php

function UsernameExists() {

    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_NAME, DB_PASSWORD);
    $sql = 'SELECT EXISTS(SELECT 1 FROM user_credentials WHERE username=?)';

    $stmt = $conn->prepare($sql);

    $stmt->bind_param(
        's',
        $_POST['username']
    );

    $stmt->execute();

    $res = $stmt->get_result();

    $conn->close();

    return $res;

}

function CreateProfile()
{
    $created = false;
    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_NAME, DB_PASSWORD);
    $sql = 'INSERT INTO user_credentials(username, password) VALUES (?,?)';

    $stmt = $conn->prepare($sql);

    //$id = uniqid();

    $passwordHash = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $stmt->bind_param(
        'ss',
        $_POST['username'],
        $passwordHash
    );

    $stmt->execute();

    if ($stmt) {
        $created = true;
    }

    $conn->close();

    return $created;


}

?>