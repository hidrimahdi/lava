<?php
require_once('../config.php');
class UsersC
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = config::getConnexion();
    }

    public function loginUser($username, $password)
    {
        // Login query for the "users" table
        $sql = "SELECT * FROM users WHERE username = :username";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($password, $user['password'])) {
            // Password is correct, login successful
            $_SESSION["username"] = $username;
            $_SESSION["role"] = $user['role']; // Assuming 'role' is the correct column name
            echo "Login successful!";
            // Redirect to a welcome page or the main application page
            header("Location: MoviesView.php");
            exit();
        } else {
            // Password is incorrect or user not found
            echo "<script>alert('Login failed. Please check your username and password.');</script>";
        }
    }

    public function registerUser($username, $password,$role)
    {
        // Registration query
        $sql = "INSERT INTO users (username, password,role) VALUES (:username, :password,:role)";
        $stmt = $this->pdo->prepare($sql);

        // Hash the password before storing
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':role',$role);

        if ($stmt->execute()) {
            // Registration successful
            echo "Registration successful!";
            $this->loginUser($username,$password);
        } else {
            // Registration failed
            echo "<script>alert('". $stmt->error."');</script>";
        }
    }

}
