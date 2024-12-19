<?php
include_once('user_sql.php');

$email = filter_var(filter_input(INPUT_GET, 'email', FILTER_SANITIZE_EMAIL), FILTER_VALIDATE_EMAIL);
$activation_code = filter_input(INPUT_GET, 'activation_code', FILTER_SANITIZE_FULL_SPECIAL_CHARS);


if ($email and $activation_code) {
    $user = find_unactivated_user($email, $activation_code);

    var_dump($user);

    if ($user) {

        if ((int)$user['expired'] === 1) {
            delete_user_by_id($user['user_id']);
            header('Location: sign_up.php?user_expired=1');
        } else {

            $is_active = activate_user($user['user_id']);

            header('Location: login.php?user_activated=' . $is_active);
        }
    } else {
        delete_user_by_id($user['user_id']);
        header('Location: sign_up.php?user_activated=0');
    }
} else {
    header('Location: sign_up.php?user_activated=0');
}
