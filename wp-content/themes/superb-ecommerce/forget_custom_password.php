<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require('D:\xamp\htdocs\wordpress_dashbord\wp-load.php');
require_once('D:\xamp\htdocs\wordpress_dashbord\vendor\autoload.php');

$mail = new PHPMailer(true);

if (isset($_POST['submit'])) {
    $email = $_POST['email'];

    global $wpdb;
    $user = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM $wpdb->users WHERE user_email = %s", $email ) );

    if ($user) {
        $activation_key = $user->user_activation_key;

        $reset_link = add_query_arg(
            array('key' => $activation_key, 'email' => $email),
            site_url('/wp-content/themes/superb-ecommerce/reset_password.php')
        );
        
        $subject = 'Password Reset';
        $message = "To reset your password, click on the following link: <a href=". $reset_link .">click</a>";
        $headers = array('Content-Type: text/html; charset=UTF-8');
        $smtp_settings = array(
            'host' => "sandbox.smtp.mailtrap.io",
            'port' => 2525,
            'username' => "05ee71512c7caa",
            'password' => "cbf4265255585e",
            'ssl' => false,
            'tls' => false,
        );

        try {
            $mail->isSMTP();      
            $mail->isHTML();                                      
            $mail->Host = 'sandbox.smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Port = 2525;
            $mail->Username = '05ee71512c7caa';
            $mail->Password = 'cbf4265255585e';                          
            
            $mail->setFrom('from@example.com', 'Mailer');
            $mail->addAddress($email);
        
            $mail->Subject = $subject;
            $mail->Body    = $message;
        
            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "Email not found in our records.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <style>
 
    </style>
</head>
<body>
    <?php get_header(); ?>
    <form method="post" action="">
    <h2>Forgot Password</h2>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <button type="submit" name="submit">Reset Password</button>
    </form>
    
</body>
</html>


