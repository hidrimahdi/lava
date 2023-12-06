<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Management</title>
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

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        form {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        input[type="text"] {
            padding: 8px;
            width: 70%;
            margin-right: 10px;
        }

        button {
            padding: 8px 16px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button.delete {
            background-color: #f44336;
        }
    </style>
</head>
<body>
<?php
include('adminheader.php');
?>
<div class="container">
    <h2>Category Management</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Action</th>
        </tr>
        <?php
        // Database connection
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "css";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Add new category
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['categoryName'])) {
            $categoryName = $_POST['categoryName'];
            $sql = "INSERT INTO categories (name) VALUES ('$categoryName')";
            $conn->query($sql);
        }

        // Delete category
        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['delete'])) {
            $categoryId = $_GET['delete'];
            $sql = "DELETE FROM categories WHERE id = $categoryId";
            $conn->query($sql);
        }

        // Fetch categories from the database and display them in a table
        $sql = "SELECT * FROM categories";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['name']}</td>
                        <td><button class='delete' onclick='deleteCategory({$row['id']})'>Delete</button></td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No categories found</td></tr>";
        }

        $conn->close();
        ?>
    </table>

    <form id="categoryForm" action="manage_categories.php" method="post">
        <input type="text" name="categoryName" placeholder="New Category Name" required>
        <button type="submit">Add Category</button>
    </form>

</div>

<script>
    function deleteCategory(categoryId) {
        if (confirm("Are you sure you want to delete this category?")) {
            window.location.href = "manage_categories.php?delete=" + categoryId;
        }
    }
</script>

</body>
</html>
