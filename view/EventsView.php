<?php

// Fetch categories from the 'categories' table
include '../controller/categoryC.php';
$c = new CategoryC();
$result = $c->getMoviesWithCategories();

$categoryResult = $c->getAllCategories();

?>

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

   <?php
    include './assets/header.php';
    ?>




 





      <!-- 
        - #UPCOMING
      -->



      <!-- 
        - #TOP RATED
      -->
      
<section class="top-rated">
        <div class="container">

            <p class="section-subtitle">ART EVENTS</p>

            <h2 class="h2 section-title">Our Events </h2>

            <ul class="filter-list">
    <li>
        <a href="?category_id=all" class="filter-btn">All</a>
    </li>

    <?php
    // Generate filter buttons dynamically based on categories
    if ($categoryResult) { 
        foreach ($categoryResult as $category) {
            echo '<li>';
            echo '<a href="?category_id=' . $category["id"] . '" class="filter-btn">' . $category["name"] . '</a>';
            echo '</li>';
        }
    }
    ?>
</ul>



           
            <ul class="movies-list">
    <?php
    include 'display.php';
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
                  &copy; 2022 <a href="#">Ahmed khlifi</a>. All Rights Reserved
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


    </script>


</body>

</html>
