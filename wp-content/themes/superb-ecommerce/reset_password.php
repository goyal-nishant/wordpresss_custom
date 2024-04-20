<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="password"] {
            width: 230px;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button[type="submit"] {
            width: 160px;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }

        .message {
            margin-top: 10px;
            color: green;
            font-weight: bold;
        }

        .error {
            margin-top: 10px;
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
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
</body>
</html>
