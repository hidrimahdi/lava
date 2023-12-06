
<?php
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "css";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get the form data
    $username = $_POST["username"];
    $password = $_POST["password"];
    $userType = $_POST["userType"];

    // Perform login or registration based on user type
    $tableName = ($userType == "artist") ? "user_art" : "user_vis";

    if ($userType == "artist") {
        // Login query for artists
        $sql = "SELECT * FROM $tableName WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                // Password is correct, login successful
                $_SESSION["username"] = $username;
                $_SESSION["userType"] = $userType;
                echo "Login successful!";
                // Redirect to a welcome page or the main application page
                header("Location: ../index.php");
                exit();
            } else {
                // Password is incorrect
                echo "Login failed. Please check your username and password.";
            }
        } else {
            // User not found
            echo "Login failed. Please check your username and password.";
        }
    } else {
        // Registration query for visitors (you might want to customize this)
        $sql = "INSERT INTO $tableName (username, password) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Hash the password
        $stmt->bind_param("ss", $username, $hashedPassword);
        $stmt->execute();
        $stmt->close();

        // Now, proceed with the login using the same query as for artists
        $sql = "SELECT * FROM $tableName WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        if ($result->num_rows > 0) {
            // Login successful
            $_SESSION["username"] = $username;
            $_SESSION["userType"] = $userType;
            echo "Login successful!";
            // Redirect to a welcome page or the main application page
            header("Location: index.php");
            exit();
        } else {
            // Login failed
            echo "Login failed. Please check your username and password.";
        }
    }

    // Close the database connection
    $conn->close();
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
                <label for="userType">User Type:</label>
                <select id="userType" name="userType">
                    <option value="artist">Artist</option>
                    <option value="visitor">Visitor</option>
                </select>
            </div>
            <div class="form-group">
                <button type="submit">Login</button>
            </div>
            
        </form>
        <a href="signin.php">
             <div class="form-group">
                <button>creat an Account</button>
            </div></a>
    </div>

</body>
</html>
