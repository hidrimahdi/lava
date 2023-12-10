
<?php
session_start();
error_reporting(E_ERROR | E_WARNING);

include '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $conn = config::getConnexion();


    // Get the form data
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Perform login or registration based on user type
   // $tableName = ($userType == "artist") ? "user_art" : "user_vis";
   
   require_once '../controller/UsersC.php';
   $loginController = new UsersC();
    $loginController->loginUser($username,$password);
    // Close the database connection
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background-color: #1e1e1e; /* Dark background color */
            color: #ecf0f1; /* Light text color */
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .login-container {
            background-color: #333333; /* Darker container background color */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

            .login-container h2 {
                margin-bottom: 20px;
            }

        .form-group {
            margin-bottom: 15px;
        }

            .form-group label {
                display: block;
                margin-bottom: 5px;
                font-size: 14px;
            }

            .form-group input,
            .form-group select {
                width: 100%;
                padding: 8px;
                border: 1px solid #95a5a6; /* Border color */
                border-radius: 4px;
                background-color: #1e1e1e; /* Input background color */
                color: #ecf0f1; /* Input text color */
            }

            .form-group button {
                width: 100%;
                padding: 10px;
                border: none;
                border-radius: 4px;
                background-color: #3498db; /* Button background color */
                color: #ecf0f1; /* Button text color */
                cursor: pointer;
                font-size: 16px;
            }

                .form-group button:hover {
                    background-color: #2980b9; /* Button hover background color */
                }
    </style>
</head>
<body>

    <div class="login-container">
        <h1><?php echo isset($_SESSION["username"]) ? "Welcome, " . $_SESSION["username"] : "Create Account"; ?></h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <h3>Choose artist or visitor and click <?php echo isset($_SESSION["username"]) ? "logout" : "register"; ?></h3>
           <h3>well i didn't code this part yet so just choose artist or visitor and click login</h3>
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" placeholder="Enter your username">
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Enter your password">
            </div>
            
            <div class="form-group">
                <button type="submit">Login</button>
            </div>
            
        </form>
        <a href="SignupView.php">
             <div class="form-group">
                <button>Create an Account</button>
            </div></a>
    </div>

</body>
</html>
