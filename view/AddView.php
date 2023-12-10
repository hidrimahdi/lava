<!DOCTYPE html>
<html lang="en">
<head>
    <?php
   
    include("../controller/categoryC.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
     $name = $_POST["name"];
     $year = $_POST["year"];
     $type = $_POST["type"];
     $category_id = $_POST["category"]; // Use 'category_id' instead of 'category'
     $tag1 = $_POST["tag1"];
     $tag2 = $_POST["tag2"];
     $tag3 = $_POST["tag3"];
     $description = $_POST["description"];
     $image = $_FILES['image'];
session_start();
error_reporting(E_ERROR | E_WARNING);

     $username = $_SESSION['username'];
     include("../controller/MoviesC.php");
     $c = new MoviesC();
     $c->AddMovie($image, $name, $year, $type, $category_id, $tag1, $tag2, $tag3, $description,$username);
}

    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Movie - virtuart</title>
 <link rel="stylesheet" href="./assets/css/style.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/hint.css/2.7.0/hint.min.css'>
    <link rel="stylesheet" href="./assets/css/style2.css">

    <!--
      - google font link
    -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #1a1a1a; /* Dark background color for the entire webpage */
            color: #fff; /* White text color */
            font-family: 'Arial', sans-serif; /* Choose a great font */
            text-align: center;
            margin: 0;
            padding: 0;
        }

        h2 {
            color: #ffcc00; /* Color for the title */
        }

        form {
            display: inline-block;
            text-align: left;
            margin: auto;
            background-color: #333; /* Dark background color for the form */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5); /* Dark box shadow for the form */
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #fff; /* White text color for labels */
        }

        input, textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            background-color: #444; /* Dark background color for inputs */
            color: #fff; /* White text color for inputs */
            border: none;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #ffcc00; /* Submit button color */
            color: #000; /* Text color for the submit button */
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #ffc966; /* Hover color for the submit button */
        }

        textarea {
            resize: vertical;
        }

    /* Your existing styles */

    .success {
        color: #4CAF50; /* Green */
    }

    .error {
        color: #f44336; /* Red */
    }


        /* Add this style to customize the select dropdown */
        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            background-color: #444;
            color: #fff;
            border: none;
            border-radius: 4px;
        }
    </style>
</head>

<body>
<?php
include('./assets/header.php');
?>
    <div style="margin-top:15%;">
        <h2>Add New Movie</h2>
        
        <form method="post" enctype="multipart/form-data">
            <div>
                <label for="image">Movie Image:</label>
                <input type="file" name="image" accept="image/*" required>
            </div>

            <div>
                <label for="name">Movie Name:</label>
                <input type="text" name="name" required>
            </div>

            <div>
                <label for="year">Release Year:</label>
                <input type="date" name="year" required>
            </div>

            <div>
                <label for="type">Movie Type:</label>
                <input type="text" name="type" required>
            </div>

            <div>
                <label for="category">Category:</label>
                <select name="category" required>
                    <!-- Fetch and display categories dynamically from the database -->
                    <?php
                    // Include your database connection code here
                   $c = new CategoryC();
                   $categoryResult = $c->getAllCategories();
                    if ($categoryResult) {
                        foreach($categoryResult as $category){
                            echo '<option value="' . $category["id"] . '">' . $category["name"] . '</option>';
                        }
                    }

                    ?>
                </select>
            </div>

            <div>
                <label for="tag1">Tag 1:</label>
                <input type="text" name="tag1" required>
            </div>

            <div>
                <label for="tag2">Tag 2:</label>
                <input type="text" name="tag2" required>
            </div>

            <div>
                <label for="tag3">Tag 3:</label>
                <input type="text" name="tag3" required>
            </div>

            <div>
                <label for="description">Description:</label>
                <textarea name="description" rows="4" required></textarea>
            </div>

            <input type="submit" value="Add Movie"></input>
        </form>
    </div>
</body>
</html>

