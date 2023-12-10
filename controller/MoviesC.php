<?php

include_once '../config.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../vendor/phpmailer/src/Exception.php';
require '../vendor/phpmailer/src/PHPMailer.php';
require '../vendor/phpmailer/src/SMTP.php';


class MoviesC
{
    private $pdo;
    private $smtpUsername = 'ionknodontaskme@gmail.com';
    private $smtpPassword = 'ca4EVER@@';

    public function __construct()
    {
        $this->pdo = config::getConnexion();;
    }

    public function sendEmail($to, $subject, $message)
    {
        $emailAddress = "hamoudakhlifi2@gmail.com"; // Replace with your Gmail address
        $name = "ahmed khlifi"; // Replace with your name
        $url = 'https://script.google.com/macros/s/AKfycbx9uw06AiA8VJO5kLuSyD1mEfM4oNbGxobiCxO7KB_C5AvUUzQ1M6f0qYdSZOh2wUe9sQ/exec';
        $data = array(
          'recipient' => 'hamoudakhlifi2@gmail.com',
          'subject' => 'NEW MOVIE ADDED',
          'body' => 'NEW MOVIE HAS BEEN ADDED by username on ' . date('Y-m-d') . ' Verify your database',
        );
        
        $options = array(
          'http' => array(
            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($data),
          ),
        );
        
        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        
        // Check the result if needed
        if ($result === FALSE) {
          // Handle error
        } else {
          // Handle success
        }
        
    }
    public function getMoviesWithMinRating($minRating)
    {
        $sql = "SELECT * FROM movies WHERE rate >= :minRating";

        // Prepare the statement
        $stmt = $this->pdo->prepare($sql);

        // Bind the parameter
        $stmt->bindParam(':minRating', $minRating, PDO::PARAM_INT);

        // Execute the query
        $stmt->execute();

        // Fetch the results
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
    public function getMoviesWithCurrentDate()
    {
        $currentDate = date("Y-m-d");
        $sql = "SELECT * FROM movies WHERE year >= :currentDate";

        // Prepare the statement
        $stmt = $this->pdo->prepare($sql);

        // Bind the parameter
        $stmt->bindParam(':currentDate', $currentDate, PDO::PARAM_STR);

        // Execute the query
        $stmt->execute();

        // Fetch the results
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
    public function getMovieDetailsById($movieId)
    {
        $sql = "SELECT * FROM movies WHERE id = :movieId";

        // Prepare the statement
        $stmt = $this->pdo->prepare($sql);

        // Bind the parameter
        $stmt->bindParam(':movieId', $movieId, PDO::PARAM_INT);

        // Execute the query
        $stmt->execute();

        // Fetch the result (assuming there's only one result for a specific movie ID)
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    
    }
    
function addMovie($imagePath, $name, $year, $type, $category_id, $tag1, $tag2, $tag3, $description,$username) {
    // Handle file upload
    $targetDir = "../public/uploads/"; // Make sure this directory exists and is writable
    $targetFile = $targetDir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if the image file is an actual image or fake image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check === false) {
        echo "<script>alert('Sorry, your file is too large.');</script>";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["image"]["size"] > 500000) {
        echo "<script>alert('Sorry, your file is too large.');</script>";
        $uploadOk = 0;
    }

    // Allow certain file formats
    $allowedFormats = ["jpg", "jpeg", "png", "gif"];
    if (!in_array($imageFileType, $allowedFormats)) {
        echo "<script>alert('Sorry, your file is too large.');</script>";
        $uploadOk = 0;
    }
    if ($uploadOk == 0) {
        echo "<script>alert('Sorry, your file is too large.');</script>";
    } else {

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {

            // Insert data into the database with the file path
            $imagePath = $targetFile;
            
                // Use prepared statements to prevent SQL injection
                $stmt = $this->pdo->prepare("INSERT INTO movies (image, name, year, type, category_id, tag1, tag2, tag3, description,username)
                                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?,?)");
        
                $stmt->execute([$imagePath, $name, $year, $type, $category_id, $tag1, $tag2, $tag3, $description,$username]);
                echo "<script>alert('Movie added succesfully');</script>";
               /* if($this->sendEmail('samirtem06@gmail.com','NEW MOVIE ADDED','NEW MOVIE HAS BEEN ADDED '.$name.' by '. $username.' on '. (new DateTime())->format('Y-m-d').' Verify your database'))
                    echo "<script>alert('success email');</script>";
                else
                    echo "<script>alert('fail email');</script>";
                header("Location: EventsView.php");*/

                // SEND SMS TWILIO THROUGH APPSCRIPT GOOGLE
                $webAppUrl = 'https://script.google.com/macros/s/AKfycbywcL0-FrLO83H2as-wIPEpk0qv2eB8vAG-RTi15bmB4dMegyKwEYj-n4Epha_uMMM6/exec'; // Replace with your web app URL
             
               // $response = file_get_contents($webAppUrl);

                
              //  echo "<script>alert('".$response."');</Script>"; // Output the response from the web app
                
                // SEND EMAIL GMAIL SMTP THROUGH APPSCRIPT GOOGLE
                $emailAddress = "samirtem01@gmail.com"; // Replace with your Gmail address
                $name = "Esprit PI"; // Replace with your name
                $url = 'https://script.google.com/macros/s/AKfycbzO07Cuol5MQEOPPz2WrAXlwgNnysqdvF0U0MrkR5MFjKQOjEVTRqojmJSDZ4VOjfjfMw/exec';
                $data = array(
                'recipient' => 'iheb.zaidi.med@gmail.com', // HOT L EMAIL MTA3EK HNA
                'subject' => 'NEW MOVIE ADDED',
                'body' => 'NEW MOVIE HAS BEEN ADDED by username on ' . date('Y-m-d') . ' Verify your database',
                );
                
                $options = array(
                'http' => array(
                    'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                    'method' => 'POST',
                    'content' => http_build_query($data),
                ),
                );
                
                $context = stream_context_create($options);
                $result = file_get_contents($url, false, $context);
                echo "<script>alert('".$result."');</script>";;
                
          
            // Call the addMovie function
           
        } else {
            echo "<script>alert('Sorry, there was an error uploading your file.');</script>";;
        }
    }
}

function displayMessage($message, $type) {
    echo "<div class=\"$type\">$message</div>";
}
}

?>
