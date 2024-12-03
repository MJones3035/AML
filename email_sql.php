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
    
    $mail = new PHPMailer(true);

    $activation_link = APP_URL . "/activate.php?email=$email&activation_code=$activation_code";

    $subject = 'AML Account Activation';

    $message = <<<MESSAGE
Hello,
Please activate your account by following the link:
$activation_link
MESSAGE;
    
    try {
        $mail->SMTPDebug = 2;                                       
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