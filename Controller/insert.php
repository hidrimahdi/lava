<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Form</title>
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


    </style>
</head>

<body>
    <div>
        <h2>Insert Event Data</h2>
        
        <form method="post" action="insert.php" enctype="multipart/form-data">
            <div>
 <label for="image">Event's Image:</label>
                <input type="file" name="image" accept="image/*" required>
               
            </div>

            <div>
<label for="name">Event's Name:</label>
                <input type="text" name="name" required>
                
            </div>

            <div>
                <label for="year">Date:</label>
                <input type="date" name="year" required>
            </div>

            <div>
 <label for="type">Type:</label>
                <input type="text" name="type" required>
               
            </div>

            <div>
<label for="category">Category:</label>
                <input type="text" name="category" required>
                
            </div>

            <div>
 <label for="rate">Rate (/5):</label>
                <input type="number" name="rate" min="1" max="5" required>
               
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

            <input type="submit" value="Submit">
        </form>
    </div>
</body>
</html>


<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection code (replace with your database details)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "works";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Handle file upload
    $targetDir = "./uploads/"; // Make sure this directory exists and is writable
    $targetFile = $targetDir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if the image file is an actual image or fake image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check === false) {
        displayMessage("File is not an image.", "error");
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["image"]["size"] > 500000) {
        displayMessage("Sorry, your file is too large.", "error");
        $uploadOk = 0;
    }

    // Allow certain file formats
    $allowedFormats = ["jpg", "jpeg", "png", "gif"];
    if (!in_array($imageFileType, $allowedFormats)) {
        displayMessage("Sorry, only JPG, JPEG, PNG & GIF files are allowed.", "error");
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        displayMessage("Sorry, your file was not uploaded.", "error");
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            displayMessage("The file " . basename($_FILES["image"]["name"]) . " has been uploaded.", "success");

            // Insert data into the database with the file path
            $imagePath = $targetFile;
            $name = $conn->real_escape_string($_POST["name"]);
            $year = $conn->real_escape_string($_POST["year"]);
            $type = $conn->real_escape_string($_POST["type"]);
            $category = $conn->real_escape_string($_POST["category"]);
            $rate = $conn->real_escape_string($_POST["rate"]);
            $tag1 = $conn->real_escape_string($_POST["tag1"]);
            $tag2 = $conn->real_escape_string($_POST["tag2"]);
            $tag3 = $conn->real_escape_string($_POST["tag3"]);
            $description = $conn->real_escape_string($_POST["description"]);

            // Use prepared statements to prevent SQL injection
            $stmt = $conn->prepare("INSERT INTO movies (image, name, year, type, category, rate, tag1, tag2, tag3, description)
                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

            $stmt->bind_param("ssssssssss", $imagePath, $name, $year, $type, $category, $rate, $tag1, $tag2, $tag3, $description);

            if ($stmt->execute()) {
                displayMessage("Record inserted successfully", "success");
            } else {
                displayMessage("Error: " . $stmt->error, "error");
            }

            $stmt->close();
        } else {
            displayMessage("Sorry, there was an error uploading your file.", "error");
        }
    }

    // Close the database connection
    $conn->close();
}

function displayMessage($message, $type) {
    echo "<div class=\"$type\">$message</div>";
}
?>
