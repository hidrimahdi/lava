<?php
// Get the selected category ID from the URL
$category_id = isset($_GET['category_id']) ? $_GET['category_id'] : 'all';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "events";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Build the SQL query based on the selected category
if ($category_id === 'all') {
    $sql = "SELECT movies.*, categories.name AS category_name FROM movies LEFT JOIN categories ON movies.category_id = categories.id";
} else {
    $sql = "SELECT movies.*, categories.name AS category_name FROM movies LEFT JOIN categories ON movies.category_id = categories.id WHERE movies.category_id = " . $category_id;
}

$result = $conn->query($sql);
?>

<ul class="movies-list">
   <?php
include('assets/eventcard.php');
?>
</ul>
