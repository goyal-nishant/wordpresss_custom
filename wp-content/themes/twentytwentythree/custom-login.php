<?php
session_start(); 


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dashbordproject";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failure: " . $conn->connect_error);
}

if (isset($_POST['btn_submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    define('WP_USE_THEMES', false);
    require_once('D:\xamp\htdocs\wordpress_dashbord\wp-load.php');

    $user = wp_authenticate($username, $password);

    if (!is_wp_error($user)) {
        wp_set_current_user($user->ID, $user->user_login);
        wp_set_auth_cookie($user->ID);
        do_action('wp_login', $user->user_login);
        header("Location: http://localhost/wordpress_dashbord/wp-admin/");
        exit();
    } else {
        echo "Invalid username or password";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
        }
        .login-wrapper {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .login-container {
            max-width: 400px;
            margin: 0 auto;
        }
        .login-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .login-form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .login-form label {
            display: block;
            margin-bottom: 6px;
        }
        .login-form input[type="text"],
        .login-form input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .login-form button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #ffffff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .login-form button:hover {
            background-color: #0056b3;
        }
    
    </style>
</head>
<body>
<div class="login-wrapper">
        <div class="login-container">
            <h2 class="login-header">Login</h2>
            <div class="login-form">
                <form method="post">
                    <label for="username">Username/email</label>
                    <input type="text" name="username" id="username" placeholder="Enter username/email">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="Enter password">
                    <input type="submit" name="btn_submit">
                </form>
            </div>
        </div>
    </div>
</body>
</html>
