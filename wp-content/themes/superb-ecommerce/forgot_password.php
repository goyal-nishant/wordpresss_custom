<?php
define('WP_USE_THEMES', false);
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require('D:\xamp\htdocs\wordpress_dashbord\wp-load.php');
require_once('D:\xamp\htdocs\wordpress_dashbord\vendor\autoload.php');

session_start();

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
            //Server settings
            $mail->isSMTP();      
            $mail->isHTML();                                      // Send using SMTP
            $mail->Host = 'sandbox.smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Port = 2525;
            $mail->Username = '05ee71512c7caa';
            $mail->Password = 'cbf4265255585e';                          
            
            $mail->setFrom('from@example.com', 'Mailer');
            $mail->addAddress($email);// TCP port to connect to
        
            $mail->Subject = $subject;
            $mail->Body    = $message;
        
            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }


        // try {
        //     wp_mail($email, $subject, $message, $headers,$smtp_settings);
        // } catch (Exception $e) {
        //     // Handle the exception
        //     echo 'Caught exception: ',  $e->getMessage(), "\n";
        // }

        // if(wp_mail($email, $subject, $message, $headers,$smtp_settings)) {
        //     echo "Mail Sent Success";
        // } else {
        //     echo "Mail Sent Failed";
        // }
        // wp_mail($email, $subject, $message, $headers);    wp_mail($email, $subject, $message, $headers,$smtp_settings);


    
        
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
</head>
<body>
    <h2>Forgot Password</h2>
    <form method="post" action="">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <button type="submit" name="submit">Reset Password</button>
    </form>
</body>
</html>
