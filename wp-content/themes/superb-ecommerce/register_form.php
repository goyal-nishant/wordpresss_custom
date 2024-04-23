<?php
/*
Template Name: Custom Registration
*/

require_once('D:\xamp\htdocs\wordpress_dashbord\wp-load.php');

if (isset($_POST['btn_submit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $selected_role = $_POST['role']; 

    $activation_key = wp_generate_password(20, false);

    if (!empty($username) && !empty($email)) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            if (username_exists($username)) {
                echo "Username already exists";
            } else {
                $user_id = wp_create_user($username, $password, $email,$selected_role);

                if (!is_wp_error($user_id)) {
                    global $wpdb;
                    $wpdb->update(
                        $wpdb->users,
                        array('user_activation_key' => $activation_key),
                        array('ID' => $user_id)
                    );

                    echo "User registered successfully";
                } else {
                    echo "Error registering user: " . $user_id->get_error_message();
                }
            }
        } else {
            echo "Invalid email address";
        }
    } else {
        echo "Username and email are required";
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Register</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .container-fluid {
            padding-top: 50px;
        }
        .form-outline {
            position: relative;
        }
        .form-outline input {
            padding: 15px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            width: 100%;
        }
        .form-outline label {
            position: absolute;
            left: 15px;
            top: 15px;
            transition: top 0.3s ease, left 0.3s ease;
            color: #999;
        }
        .form-outline input:focus + label,
        .form-outline input:not(:placeholder-shown) + label {
            top: -10px;
            left: 0;
            background-color: #fff;
            padding: 5px;
            font-size: 12px;
        }
        .btn-register {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .btn-register:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<section class="vh-100">
    <div class="container-fluid">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-md-8 col-lg-6 col-xl-4">
                <form method="post" action="">

                    <div class="form-outline mb-4">
                        <input type="text" id="username" class="form-control form-control-lg" name="username" required>
                        <label class="form-label" for="username">Username</label>
                    </div>

                    <div class="form-outline mb-4">
                        <input type="email" id="email" class="form-control form-control-lg" name="email" required>
                        <label class="form-label" for="email">Email</label>
                    </div>

                    <div class="form-outline mb-3">
                        <input type="password" id="password" class="form-control form-control-lg" name="password" required>
                        <label class="form-label" for="password">Password</label>
                    </div>
                    <div class="form-outline mb-3">
                            <select class="form-select" name="role" required>
                                <option value="" selected disabled>Select Role</option>
                                <option value="subscriber">Subscriber</option>
                                <option value="editor">Editor</option>
                                <option value="author">Author</option>
                                <option value="Administrator">Administrator</option>
                                <option value="contributor">contributor</option>
                            </select>
                    </div>
                    <div class="text-center mt-4">
                        <button type="submit" name="btn_submit" class="btn btn-register">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
