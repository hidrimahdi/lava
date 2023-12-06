<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "css";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$movieId = $_GET['id'];

// Fetch movie details based on the ID
$sql = "SELECT * FROM movies WHERE id = $movieId";
$result = $conn->query($sql);
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
    include './header.php';
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
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                echo '<img src="' . $row["image"] . '" alt="' . $row["name"] . ' movie poster">';
            }
            ?>

            <button class="play-btn">
                <ion-icon name="play-circle-outline"></ion-icon>
            </button>

        </figure>

        <div class="movie-detail-content">

            <?php
            if ($result->num_rows > 0) {
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
        echo '<span>' . $row["rate"] . '/5</span>';
    
        echo '</div>';
                echo '<p class="detail-subtitle">Tags: ' . $row["tag1"] . ', ' . $row["tag2"] . ', ' . $row["tag3"] . '</p>';
                echo '<p class="detail-subtitle">Description: ' . $row["description"] . '</p>';
                // ... (other details)
            } else {
                echo '<p class="detail-subtitle">No details available</p>';
            }
            ?>

            <div class="details-actions">

                <button class="share">
                    <ion-icon name="share-social"></ion-icon>
                    <span>Share</span>
                </button>

                <div class="title-wrapper">
                    <p class="title">art</p>
                    <p class="text">living art</p>
                </div>

                <?php
                if ($result->num_rows > 0) {
                    echo '<a href="eventcard.php?id=' . $row["id"] . '" class="btn btn-primary">See More</a>';
                }
                ?>

                <a href="./assets/images/movie-4.png" download class="download-btn">
                    <span>Download</span>
                    <ion-icon name="download-outline"></ion-icon>
                </a>

            </div>

        </div>

    </div>
</section>

<?php
// Close the database connection
$conn->close();
?>






  <footer class="footer">

    <div class="footer-top">
      <div class="container">

        <div class="footer-brand-wrapper">

            <a href="./index.html" class="logo">
                <p class="hero-subtitle">ElBay.Tn</p>
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