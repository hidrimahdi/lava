<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  include("../config.php");
    $conn = config::getConnexion();

 

    // Get the form data
    $username = $_POST["username"];
    $password = $_POST["password"]; // Hash the password
    $userType = $_POST["userType"];

    // Perform registration based on user type
    require_once '../controller/UsersC.php';
    $loginController = new UsersC();
     $loginController->registerUser($username,$password,$userType);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
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
        <h1>Create Account</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <h3>Choose artist or visitor and click register</h3>
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" placeholder="Enter your username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <div class="form-group">
                <label for="userType">User Type:</label>
                <select id="userType" name="userType" required>
                    <option value="artist">Artist</option>
                    <option value="visitor">Visitor</option>
                </select>
            </div>
            <div class="form-group">
                <button type="submit">Register</button>
            </div>
        </form>
    </div>

</body>

</html>
