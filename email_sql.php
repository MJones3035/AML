<?php

include('database.php');

if (!defined('APP_URL')) {
    define('APP_URL', 'http://localhost/AML');
    define('SENDER_EMAIL_ADDRESS', 'aml195391@gmail.com');  // password = G12?Zq89v>

    // init_set()
}


require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function send_activation_email(string $email, string $activation_code): string {
    
    $activation_link = APP_URL . "/activate.php?email=$email&activation_code=$activation_code";

    $subject = 'AML Account Activation';

    $message = <<<MESSAGE
Hello,

Please activate your account by following the link:
$activation_link
MESSAGE;

    $res = send_email($email, $subject, $message);

    return $res;
    

}

function send_profile_updated_email(string $email): string {
    

    $help_email_address = SENDER_EMAIL_ADDRESS;
    $help_phone_number = '+44 7847246990';

    $subject = 'Profile Updated';

    $message = <<<MESSAGE
Hello,

Your profile details have been updated. If this was not you, please contact $help_phone_number or $help_email_address.
MESSAGE;

    $res = send_email($email, $subject, $message);

    return $res;
    

}

function send_password_updated_email(string $email): string {
    

    $help_email_address = SENDER_EMAIL_ADDRESS;
    $help_phone_number = '+44 7847246990';

    $subject = 'Password Updated';

    $message = <<<MESSAGE
Hello,

Your password has been updated. If this was not you, please contact $help_phone_number or $help_email_address.
MESSAGE;

    $res = send_email($email, $subject, $message);

    return $res;
    

}

function send_email(string $email, string $subject, string $message): string {
    $mail = new PHPMailer(true);

    try {
        //$mail->SMTPDebug = 2;
        $mail->SMTPDebug = 0;                                         
        $mail->isSMTP();                                            
        $mail->Host       = 'smtp.gmail.com';                    
        $mail->SMTPAuth   = true;                             
        $mail->Username   = SENDER_EMAIL_ADDRESS;                 
        $mail->Password   = 'khxfnlzqmuygieti';           
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;                              
        $mail->Port       = 587;  
    
        $mail->setFrom(SENDER_EMAIL_ADDRESS, 'AML');           
        $mail->addAddress($email);
        
        $mail->isHTML(true);                                  
        $mail->Subject = $subject;
        $mail->Body    = $message;
        $mail->send();
        return "Mail has been sent successfully!";
    } catch (Exception $e) {
        return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>