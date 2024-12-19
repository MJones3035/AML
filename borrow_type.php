<?php
require_once("session.php");
include("database.php");

// Include PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

// Check if ID and borrow_type are set
if (isset($_GET['id']) && isset($_GET['borrow_type'])) {
    $borrow_type = $_GET['borrow_type'];
    $media_id = $_GET['id'];

    // Update borrow table
    $query = "UPDATE borrow SET borrow_type = $borrow_type WHERE media_id = $media_id;";
    mysqli_query($db_conn, $query);

    // Update media stock
    $query1 = "UPDATE media SET stock = stock - 1 WHERE media_id = $media_id;";
    mysqli_query($db_conn, $query1);

    // Fetch user email using session user_id
    $user_id = $_SESSION['user_id'];
    $result_user = mysqli_query($db_conn, "SELECT email FROM user_details WHERE user_id = $user_id LIMIT 1");
    $user = mysqli_fetch_assoc($result_user);
    $user_email = $user['email'];

    // Fetch media details (title)
    $result_media = mysqli_query($db_conn, "SELECT title FROM media WHERE media_id = $media_id LIMIT 1");
    $media = mysqli_fetch_assoc($result_media);
    $media_title = $media['title'];

    // Email content
    $subject = "Confirmation of Borrowed Media";
    $message = "You have successfully borrowed the media titled '$media_title'.\nBorrow Type: $borrow_type\n\nPlease return it by the due date.\n\nThank you!";

    // Setup PHPMailer
    $mail = new PHPMailer(true);
    try {
        // SMTP Configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'aml195391@gmail.com'; // Your Gmail email
        $mail->Password = 'khxfnlzqmuygieti';   // Your App-Specific Password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Email Details
        $mail->setFrom('aml195391@gmail.com', 'Library Notifications');
        $mail->addAddress($user_email); // Recipient email
        $mail->Subject = $subject;
        $mail->Body = $message;

        // Send Email
        $mail->send();
        echo "Confirmation email sent successfully.";
    } catch (Exception $e) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    }

    // Redirect to current loan page
    header("Location: current_loan.php");
    exit;
}
?>
