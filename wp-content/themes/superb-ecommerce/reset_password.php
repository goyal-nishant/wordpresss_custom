<?php
require_once('D:\xamp\htdocs\wordpress_dashbord\wp-load.php');

// Start session
session_start();
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
            echo "<form method='post'>";
            echo "<label>New Password:</label>";
            echo "<input type='password' name='new_password' required>";
            echo "<button type='submit' name='reset'>Reset Password</button>";
            echo "</form>";

            if (isset($_POST['reset'])) {
                $new_password = $_POST['new_password'];

                wp_set_password($new_password, $user->ID);

                // Clear the activation key from the database
                $wpdb->update(
                    $wpdb->users,
                    array('user_activation_key' => ''),
                    array('ID' => $user->ID)
                );

                echo "Password reset successfully.";
            }
        } else {
            echo "Invalid key or email.";
        }
    } else {
        echo "User not found.";
    }
} else {
    echo "Invalid request.";
}

?>
