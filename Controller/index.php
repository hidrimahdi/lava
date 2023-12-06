<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>virtuart - Best Art collection</title>

    <!--
      - favicon
    -->
    <link rel="shortcut icon" href="./favicon1.svg" type="image/svg+xml">

    <!--
      - custom css link
    -->
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
</head>

<body id="top">

  <!-- 
    - #HEADER
  -->
  <!-- include artistheader.php here -->
  

 <?php
    include './assets/header.php';
    ?>


  <main>
    <article>

      <!-- 
        - #HERO
      -->
      
      <section class="hero">
        <div class="container">

            <div class="hero-content">

                <p class="hero-subtitle">ART HUB</p>

                <h1 class="h1 hero-title">
                    Unlimited <strong>Pinture</strong>, photography, & More.
                </h1>

                <div class="meta-wrapper">

                    <div class="badge-wrapper">
                        <div class="badge badge-fill">Tunis</div>

                        <div class="badge badge-outline">ART</div>
                    </div>

                    <div class="ganre-wrapper">
                        <a href="#">open sale,</a>

                        <a href="#">Gallery</a>
                    </div>

                    <div class="date-time">

                        <div>
                            <ion-icon name="calendar-outline"></ion-icon>

                            <time datetime="2022">03/12/2023</time>
                        </div>

                        <div>
                            <ion-icon name="time-outline"></ion-icon>

                            <time datetime="PT128M"> 23:00 </time>
                        </div>

                    </div>

                </div>
                <a href="./assets/login.php">
                    <button class="btn btn-primary">
                        <span>participate now</span>
                    </button>
                </a>


            </div>

        </div>
      </section>





      <!-- 
        - #UPCOMING
      -->

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "css";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$currentDate = date("Y-m-d");
$sql = "SELECT * FROM movies WHERE year >= '$currentDate'";
$result = $conn->query($sql);

?>

<section class="upcoming">
    <div class="container">
        <div class="flex-wrapper">
            <div class="title-wrapper">
                <p class="section-subtitle">Art Events</p>
                <h2 class="h2 section-title">Upcoming Events</h2>
            </div>
           
        </div>
<ul class="movies-list has-scrollbar">
<?php
include('./assets/eventcard.php');
?>
</ul>

    </div>
</section>






      <!-- 
        - #SERVICE
      -->

      <section class="service">
        <div class="container">

          <div class="service-banner">
            <figure>
              <img src="./assets/images/service-banner.jpg" alt="HD 4k resolution! only $3.99">
            </figure>

            <a href="./assets/images/service-banner.jpg" download class="service-btn">
              <span>Felsa ? </span>

              
            </a>
          </div>

          <div class="service-content">

            <p class="service-subtitle">Our Services</p>

            <h2 class="h2 service-title">Stay Update.</h2>

            <p class="service-text">
              description ta3 el site bech tkoun able enha tetbadel ay wa9et mel admine page

            </p>

            <ul class="service-list">

              <li>
                <div class="service-card">

                  <div class="card-icon">
                    <ion-icon name="tv"></ion-icon>
                  </div>

                  <div class="card-content">
                    <h3 class="h3 card-title">looks useful .</h3>

                    <p class="card-text">
                     i'll find something to add here , the image and this text will be able to get changed anytime too.
                    </p>
                  </div>

                </div>
              </li>

              <li>
                <div class="service-card">

                  <div class="card-icon">
                    <ion-icon name="videocam"></ion-icon>
                  </div>

                  <div class="card-content">
                      <h3 class="h3 card-title">looks useful.</h3>

                      <p class="card-text">
                          i'll find something to add here , the image and this text will be able to get changed anytime too.
                      </p>
                  </div>

                </div>
              </li>

            </ul>

          </div>

        </div>
      </section>





      <!-- 
        - #TOP RATED
      -->

      

            <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "css";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT * FROM movies WHERE rate >= 4";
$result = $conn->query($sql);

?>

<section class="top-rated">
        <div class="container">

            <p class="section-subtitle">ART EVENTS</p>

          <h2 class="h2 section-title">Still not sure what should i add here , top rated maybe ? </h2>

        

          <ul class="movies-list">
            <?php
include('./assets/eventcard.php');
?>

          </ul>

        </div>
      </section>





      <!-- 
        - #nature
      -->

    




      <!-- 
        - #CTA
      -->

      <section class="cta">
        <div class="container">

          <div class="title-wrapper">
            <h2 class="cta-title">ay jomla .</h2>

            <p class="cta-text">
                tchaja3 el utilisateur bech ya3mel account.
            </p>
          </div>

          <form action="" class="cta-form">
            <input type="email" name="email" required placeholder="Enter your email" class="email-field">

            <button type="submit" class="cta-form-btn">Get started</button>
          </form>

        </div>
      </section>

    </article>
  </main>





  <!-- 
    - #FOOTER
  -->

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