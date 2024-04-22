<!-- login-form-template.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
                margin: 0;
                padding: 0;
            }
    
            h2 {
                text-align: center;
                color: #333;
            }
    
            .wrapper {
                width: 100%;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 330px;
            }
    
            .container {
                width: 300px;
                border: 1px solid #ccc;
                border-radius: 5px;
                padding: 20px;
                background-color: #fff;
            }
    
            .form {
                margin-bottom: 20px;
            }
    
            .form label {
                display: inline-block;
                width: 100px;
                margin-right: 10px;
                text-align: centre;
            }
    
            .form input {
                width: 180px;
                border: 1px solid #ccc;
                border-radius: 3px;
                box-sizing: border-box;
            }
    
            .form input[type="submit"] {
                width: 100%;
                background-color: #007bff;
                color: #fff;
                border: none;
                padding: 10px;
                border-radius: 3px;
                cursor: pointer;
            }
    
            .form input[type="submit"]:hover {
                background-color: #0056b3;
            }
            #name,#email,#password{
                margin-left:40px;
            }
        </style>
</head>
<body>
    <h2>Login Form</h2>
    <div class="wrapper">
        <div class="container">
            <form method="post" action="">
                <div class="form">
                    <label for="name">User Name:</label>
                    <input type="text" name="name" id="name">
                </div>

                <div class="form">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email">
                </div>
                
                <div class="form">
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password">
                </div>

                <div class="form">
                    <input type="submit" value="Login">
                </div>
            </form>
        </div>
    </div>
</body>
</html>
