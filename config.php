<?php
$db_host = 'localhost';
$db_name = 'administrateur';
$db_user = 'root';
$db_pass = '';

try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_user, $db_pass);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
