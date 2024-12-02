<?php

include('database.php');

if (!defined('APP_URL')) {
    define('APP_URL', 'http://localhost/AML');
    define('SENDER_EMAIL_ADDRESS', 'no-reply@email.com');
}

function SendActivationEmail(string $email, string $activationCode): void {
    $activationLink = APP_URL . "/activate.php?email=$email&activationCode=$activationCode";

    $subject = 'AML Account Activation';

    $message = <<<MESSAGE
                Hello,
                Please activate your account by following the link:
                $activationLink
                MESSAGE;
                
    $header = "From:" . SENDER_EMAIL_ADDRESS;

    mail($email, $subject, nl2br($message), $header);   
}