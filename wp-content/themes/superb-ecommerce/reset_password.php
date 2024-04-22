<?php 
require_once('D:\xamp\htdocs\wordpress_dashbord\wp-load.php');
get_header(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <style>
      
    </style>
</head>
<body>

<?php
require_once('D:\xamp\htdocs\wordpress_dashbord\wp-load.php');
   
if (isset($_GET['key']) && isset($_GET['email'])) {
    $key = $_GET['key'];
    $email = $_GET['email'];

    global $wpdb;

    // Verify key and email
    $user = $wpdb->get_row(
        $wpdb->prepare(
            "SELECT * FROM $wpdb->users WHERE user_email = %s",
            $email
        )
    );

    if ($user) {
        $stored_key = $user->user_activation_key;

        if ($stored_key === $key) {
            ?>
            <form method='post'>
                <label>New Password:</label>
                <input type='password' name='new_password' required>
                <button type='submit' name='reset'>Reset Password</button>
            </form>
            <?php
      

            if (isset($_POST['reset'])) {
                $new_password = $_POST['new_password'];

                wp_set_password($new_password, $user->ID);

                // Clear the activation key from the database
                $wpdb->update(
                    $wpdb->users,
                    array('user_activation_key' => ''),
                    array('ID' => $user->ID)
                );

                echo "<p class='message'>Password reset successfully.</p>";
            }
        } else {
            echo "<p class='error'>Invalid key or email.</p>";
        }
    } else {
        echo "<p class='error'>User not found.</p>";
    }
} else {
    echo "<p class='error'>Invalid request.</p>";
}
?>

<?php
echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
get_footer() ?>
</body>
</html>
