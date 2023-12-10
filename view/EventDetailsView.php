<?php
include '../config.php';

$pdo = config::getConnexion();
$movieId = $_GET['id'];
include '../controller/MoviesC.php';
require_once('../controller/RatingC.php');

// Fetch movie details based on the ID
$RC = new RatingC();
$ratings = $RC->getMovieRatings($movieId);
$m= new MoviesC();
$result = $m->getMovieDetailsById($movieId);
session_start();
error_reporting(E_ERROR | E_WARNING);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $movieId = $_GET['id'];  // Add the input name attribute for the movie ID if not present
    $comment = $_POST["comment"];
    $rating = $_POST["rating"];

    // Include necessary files and classes

    // Create an instance of ReviewController

    // Call the addReview function
    $RC->addReview($movieId, $_SESSION["username"], $comment, $rating);
    
    // Redirect back to the movie details page or any other page
    exit();
}
?>

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Free Guy 2021</title>

  <!-- 
    - favicon
  -->
  <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">
<style>
    /* Add this CSS to your existing stylesheet or in a new style tag in the head section of your HTML */

.form-group {
    margin-bottom: 20px;
}

label {
    display: block;
    margin-bottom: 5px;
    font-size: 14px;
    color: #ecf0f1; /* Light text color */
}

textarea,
input[type="number"] {
    width: 100%;
    padding: 8px;
    border: 1px solid #95a5a6; /* Border color */
    border-radius: 4px;
    background-color: #1e1e1e; /* Input background color */
    color: #ecf0f1; /* Input text color */
    margin-bottom: 10px;
}

button[type="submit"] {
    width: 100%;
    padding: 10px;
    border: none;
    border-radius: 4px;
    background-color: #3498db; /* Button background color */
    color: #ecf0f1; /* Button text color */
    cursor: pointer;
    font-size: 16px;
}

button[type="submit"]:hover {
    background-color: #2980b9; /* Button hover background color */
}

    </style>
  <!-- 
    - custom css link
  -->
  <link rel="stylesheet" href="./assets/css/style.css">
  <link rel="stylesheet" href="./assets/css/style2.css">

  <!-- 
    - google font link
  -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body id="#top">

  <!-- 
    - #HEADER
  -->

 <?php
    include './assets/header.php';
    ?>






  <main>
    <article>

      <!-- 
        - #MOVIE DETAIL
      -->

    <section class="movie-detail">
    <div class="container">

        <figure class="movie-detail-banner">
            <?php
                $row = $result;
                echo '<img src="' . $row["image"] . '" alt="' . $row["name"] . ' movie poster">';
            
            ?>

            <button class="play-btn">
                <ion-icon name="play-circle-outline"></ion-icon>
            </button>

        </figure>

        <div class="movie-detail-content">

            <?php
            if ($result) {
                // Output all movie details here
                echo '<p class="detail-subtitle">' . $row["type"] . '</p>';
                echo '<h1 class="h1 detail-title">' . $row["name"] . '</h1>';
                echo '<p class="detail-subtitle">Year: ' . date('Y', strtotime($row["year"])) . '</p>';
                echo '<div class="rating">';
        for ($r = 0; $r < $row["rate"]; $r++) {
            echo '<i class="fas fa-star"></i>';
        }
        for ($r = 0; $r < (5 - $row["rate"]); $r++) {
            echo '<i class="far fa-star"></i>';
        }
        echo '<p class="detail-subtitle">' . $row["rate"] . '/5</p>';
    
        echo '</div>';
                echo '<p class="detail-subtitle">Tags: ' . $row["tag1"] . ', ' . $row["tag2"] . ', ' . $row["tag3"] . '</p>';
                echo '<p class="detail-subtitle">Description: ' . $row["description"] . '</p>';
                echo '<p class="detail-subtitle">Author: ' . $row["username"] . '</p>';
                // ... (other details)
            } else {
                echo '<p class="detail-subtitle">No details available</p>';
            }
            ?>

            <div class="details-actions">

           
<!-- Add this script tag at the end of your body or include it in your existing script file -->

<script>
document.addEventListener('DOMContentLoaded', function () {
    const ratingContainer = document.getElementById('rating-container');
    const ratingInput = document.getElementById('rating');
    let currentRating = 0;

    ratingContainer.addEventListener('mouseover', function (event) {
        const star = event.target;
        if (star.classList.contains('star')) {
            const ratingValue = parseInt(star.getAttribute('data-rating'), 10);
            fillStarsUpToRating(ratingValue);
        }
    });

    ratingContainer.addEventListener('mouseout', function () {
        fillStarsUpToRating(currentRating);
    });

    ratingContainer.addEventListener('click', function (event) {
        const star = event.target;
        if (star.classList.contains('star')) {
            const ratingValue = parseInt(star.getAttribute('data-rating'), 10);
            setRating(ratingValue);
        }
    });

    function fillStarsUpToRating(value) {
        const stars = ratingContainer.getElementsByClassName('star');
        for (const star of stars) {
            const starValue = parseInt(star.getAttribute('data-rating'), 10);
            star.classList.toggle('active', starValue <= value);
        }
    }

    function setRating(value) {
        currentRating = value;
        fillStarsUpToRating(value);
        ratingInput.value = value;
    }
});
</script>

<style>
    /* Add this CSS to your existing stylesheet or in a new style tag in the head section of your HTML */

.rating-container {
    display: flex;
}

.star {
    font-size: 24px;
    color: #ecf0f1; /* Light text color */
    cursor: pointer;
    transition: color 0.3s;
}

.star:hover,
.star.active {
    color: #f39c12; /* Star color on hover or when selected */
}

</style>
                <?php
                if(isset($_SESSION['username']))
                {
                $role=$_SESSION['role'];
                
                if ($_SESSION['username'] != $result['username'] && $result){
                 
                        echo '<form method="post">';
                        echo '<div class="form-group">';
                        echo '<label for="comment">Leave a Comment:</label>';
                        echo '<textarea id="comment" name="comment" rows="4" cols="50"></textarea>';
                        echo '</div>';
                
                        echo '<div class="form-group">
                        <label for="rating">Rating:</label>
                        <div class="rating-container" id="rating-container">
                            <span class="star" data-rating="1">&#9733;</span>
                            <span class="star" data-rating="2">&#9733;</span>
                            <span class="star" data-rating="3">&#9733;</span>
                            <span class="star" data-rating="4">&#9733;</span>
                            <span class="star" data-rating="5">&#9733;</span>
                        </div>
                        <input type="hidden" id="rating" name="rating" value="0">
                    </div>
';                    
                
                        echo '<button type="submit">Submit Comment</button>';
                        echo '</form>';
                }
            }
                ?>

                <a href="./assets/images/movie-4.png" download class="download-btn">
                    <span>Download</span>
                    <ion-icon name="download-outline"></ion-icon>
                </a>
               
<style>
    /* Ratings section */
.ratings-section {
  padding: 20px;
  border: 1px solid #ccc;
  margin-bottom: 20px;
}

/* Ratings list */
.ratings-list {
  list-style: none;
  margin: 0;
  padding: 0;
}

/* Rating item */
.rating-item {
  background-color: #f2f2f2;
  padding: 10px;
  margin-bottom: 10px;
}

/* Star rating container */
.rating-stars {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

/* Star rating icons */
.fa-star {
  font-size: 18px;
  color: #f29433;
}

/* Empty stars */
.fa-star-o {
  color: #e7e7e7;
}

/* Username and rating */
.rating-item p {
  margin-bottom: 5px;
}

    </style>

            </div>
 <?php
// Display ratings
if (!empty($ratings)) {
  echo '<div class="ratings-section">';
  echo '<h2 >Ratings</h2>';
  echo '<ul class="ratings-list">';
  foreach ($ratings as $rating) {
    echo '<li class="rating-item">';

    // Star rating container
    echo '<div class="rating-stars" style="display: flex; justify-content: space-between; align-items: center;">';




    echo '</div>';

    // Username and rating
    echo '<p><strong>Username:</strong> ' . $rating['username'] . '</p>';
    echo '<strong>Rating:</strong><div class="rating-container" id="rating-container">';
    if($rating['rating'] == 1)
    {
        echo '<span class="star active" data-rating="' . 1 . '">&#9733;</span>';}
    if($rating['rating'] == 2)
        {
            echo '<span class="star active" data-rating="' . 1 . '">&#9733;</span>';
            echo '<span class="star active" data-rating="' . 2 . '">&#9733;</span>';
          
        }
        if($rating['rating'] == 3)
        {
            echo '<span class="star active" data-rating="' . 1 . '">&#9733;</span>';
            echo '<span class="star active" data-rating="' . 2 . '">&#9733;</span>';
            echo '<span class="star active" data-rating="' . 3 . '">&#9733;</span>';
           
        }
    if($rating['rating'] == 4)
        {
            echo '<span class="star active" data-rating="' . 1 . '">&#9733;</span>';
            echo '<span class="star active" data-rating="' . 2 . '">&#9733;</span>';
            echo '<span class="star active" data-rating="' . 3 . '">&#9733;</span>';
            echo '<span class="star active" data-rating="' . 4 . '">&#9733;</span>';
           
        }
    if($rating['rating'] == 5)
    {
        echo '<span class="star active" data-rating="' . 1 . '">&#9733;</span>';
        echo '<span class="star active" data-rating="' . 2 . '">&#9733;</span>';
        echo '<span class="star active" data-rating="' . 3 . '">&#9733;</span>';
        echo '<span class="star active" data-rating="' . 4 . '">&#9733;</span>';
        echo '<span class="star active" data-rating="' . 5 . '">&#9733;</span>';
    }
  
    }

  
    echo '</div>';
    // Comment
    echo '<p><strong>Comment:</strong> ' . $rating['comment'] . '</p>';

    echo '</li>';
} else {
  echo '<p>No ratings available.</p>';
}
?>
        </div>

    </div>
</section>






  <footer class="footer">

    <div class="footer-top">
      <div class="container">

        <div class="footer-brand-wrapper">

            <a href="./index.html" class="logo">
                <p class="hero-subtitle">virtuart</p>
            </a>

          <ul class="footer-list">

            <li>
              <a href="./index.html" class="footer-link">Home</a>
            </li>

            <li>
              <a href="#" class="footer-link">section 1</a>
            </li>

            <li>
              <a href="#" class="footer-link">section 2</a>
            </li>

            <li>
              <a href="#" class="footer-link">section 3</a>
            </li>

            <li>
              <a href="#" class="footer-link">section 4</a>
            </li>

          </ul>

        </div>

        <div class="divider"></div>

        <div class="quicklink-wrapper">

          <ul class="quicklink-list">

            <li>
              <a href="#" class="quicklink-link">Faq</a>
            </li>

            <li>
              <a href="#" class="quicklink-link">Help center</a>
            </li>

            <li>
              <a href="#" class="quicklink-link">Terms of use</a>
            </li>

            <li>
              <a href="#" class="quicklink-link">Privacy</a>
            </li>

          </ul>

          <ul class="social-list">

            <li>
              <a href="#" class="social-link">
                <ion-icon name="logo-facebook"></ion-icon>
              </a>
            </li>

            <li>
              <a href="#" class="social-link">
                <ion-icon name="logo-twitter"></ion-icon>
              </a>
            </li>

            <li>
              <a href="#" class="social-link">
                <ion-icon name="logo-pinterest"></ion-icon>
              </a>
            </li>

            <li>
              <a href="#" class="social-link">
                <ion-icon name="logo-linkedin"></ion-icon>
              </a>
            </li>

          </ul>

        </div>

      </div>
    </div>

    <div class="footer-bottom">
      <div class="container">
        
              <p class="copyright">
                  &copy; 2022 <a href="#">IYED HOSNI</a>. All Rights Reserved
              </p>
          
       

      </div>
    </div>

  </footer>





  <!-- 
    - #GO TO TOP
  -->

  <a href="#top" class="go-top" data-go-top>
    <ion-icon name="chevron-up"></ion-icon>
  </a>





  <!-- 
    - custom js link
  -->
  <script src="./assets/js/script.js"></script>

  <!-- 
    - ionicon link
  -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>