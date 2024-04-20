<?php

define('WP_USE_THEMES', false);
require('D:\xamp\htdocs\wordpress_dashbord\wp-load.php');

if (isset($_POST['submit'])) {
    $email = $_POST['email'];

    global $wpdb;
    $user = $wpdb->get_row($wpdb->prepare("SELECT * FROM $wpdb->users WHERE user_email = %s", $email));

    if ($user) {
        $activation_key = $user->user_activation_key;

        $reset_link = add_query_arg(
            array('key' => $activation_key, 'email' => $email),
            site_url('/wp-content/themes/superb-ecommerce/reset_password.php')
        );

        $subject = 'Password Reset';
        $message = "To reset your password, click on the following link: <a href=\"" . esc_url($reset_link) . "\">click</a>";
        $headers = array('Content-Type: text/html; charset=UTF-8');

        if (wp_mail($email, $subject, $message, $headers)) {
            echo 'Message has been sent';
        } else {
            echo 'Failed to send email';
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
