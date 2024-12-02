<?php

include('database.php');

if (!defined('APP_URL')) {
    define('APP_URL', 'http://localhost/AML');
    define('SENDER_EMAIL_ADDRESS', 'AML8822@email.com');
}

// function SendActivationEmail(string $email, string $activationCode): void {
//     $activationLink = APP_URL . "/activate.php?email=$email&activationCode=$activationCode";

//     $subject = 'AML Account Activation';

//     $message = <<<MESSAGE
//                 Hello,
//                 Please activate your account by following the link:
//                 $activationLink
//                 MESSAGE;
                
//     $header = "From:" . SENDER_EMAIL_ADDRESS;

//     mail($email, $subject, nl2br($message), $header);   
// }

require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function SendActivationEmail(string $email, string $activationCode): void {
    
    $mail = new PHPMailer(true);

    $activationLink = APP_URL . "/activate.php?email=$email&activationCode=$activationCode";

    $subject = 'AML Account Activation';

    $message = <<<MESSAGE
                Hello,
                Please activate your account by following the link:
                $activationLink
                MESSAGE;
    
    try {
        $mail->SMTPDebug = 2;                                       
        $mail->isSMTP();                                            
        $mail->Host       = 'smtp.gfg.com;';                    
        $mail->SMTPAuth   = true;                             
        $mail->Username   = SENDER_EMAIL_ADDRESS;                 
        $mail->Password   = 'G12?Zq89v>';                        
        $mail->SMTPSecure = 'tls';                              
        $mail->Port       = 587;  
    
        $mail->setFrom(SENDER_EMAIL_ADDRESS, 'AML');           
        $mail->addAddress($email);
        
        $mail->isHTML(true);                                  
        $mail->Subject = $subject;
        $mail->Body    = $message;
        //$mail->AltBody = 'Body in plain text for non-HTML mail clients';
        $mail->headerLine("From ", SENDER_EMAIL_ADDRESS);
        $mail->send();
        echo "Mail has been sent successfully!";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>