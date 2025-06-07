<?php
session_start();
$status = '';

if (isset($_SESSION['status'])) {
    $status = $_SESSION['status'];
    unset($_SESSION['status']); // <-- This is safe here
}


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if(isset($_POST['Send'])){

    //Create an instance; passing `true` enables exceptions
    $subject = $_POST['subject'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'uni.anjali1@gmail.com';                     //SMTP username
        $mail->Password   = 'vfthcofnpqbeovke';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('uni.anjali1@gmail.com', 'Anju');
        $mail->addAddress('uni.anjali1@gmail.com', 'Anjali');     //Add a recipient

        //Content
        $mail->isHTML(true);
        $mail->Subject = "$subject";
        $mail->Body = 'You got a new message<br>' .
          '<h3>Name: ' . $name . '</h3>'.
          '<h3>Email: ' . $email . '</h3>' .
          '<h3>Message: ' . $message . '</h3>';

        if ($mail->send()) {
          $_SESSION['status'] = "Thank you for contacting me";
          header("Location: {$_SERVER['HTTP_REFERER']}");
          exit(0);
        }
        else {
          $_SESSION['status'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
          header('Location: portfolio.php');
          exit(0);
        }
        echo 'Message has been sent';
    }
    catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
else {
  header('Location: portfolio.php');
  exit(0);
}
?>
