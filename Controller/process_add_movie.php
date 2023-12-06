<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection code (replace with your database details)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "css";

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
            $category_id = $conn->real_escape_string($_POST["category"]); // Use 'category_id' instead of 'category'
            $tag1 = $conn->real_escape_string($_POST["tag1"]);
            $tag2 = $conn->real_escape_string($_POST["tag2"]);
            $tag3 = $conn->real_escape_string($_POST["tag3"]);
            $description = $conn->real_escape_string($_POST["description"]);

            // Use prepared statements to prevent SQL injection
            $stmt = $conn->prepare("INSERT INTO movies (image, name, year, type, category_id, tag1, tag2, tag3, description)
                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

            $stmt->bind_param("ssssissss", $imagePath, $name, $year, $type, $category_id, $tag1, $tag2, $tag3, $description); // Changed 's' to 'i' for 'category_id'

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
