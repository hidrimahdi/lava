<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Dish Site</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
    <header>
        <a href="#" class="logo"><i class="fas fa-seedling"></i>VirtuArt</a>
        <ul class="menu">
            <li><a href="index.php">Acceuil</a></li>
            <li><a href="index.php">A Propos</a></li>
            <li><a href="afficher.php"><img src="images/1.png" alt="compte" width="20px"></a></li>
            <li><a href="login.php">Logout</a></li>

        </ul>

        <!-- menu responsive -->
         <!-- menu responsive -->
         <div class="toggle_menu"></div>
        </header>
    
        <!-- section acceuil home -->
    
        <section id="home">
            <div class="left">
                <h4>Our New products</h4>
                <h1>NATURAL PRODUCTS</h1>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ipsa sequi eveniet sed quidem reprehenderit libero officiis.</p>
                 <button><a href="#">commander maintenant</a></button>
            </div>
            <div class="right">
                <img src="images/img.png">
            </div>
        </section>


       <!-- section about us -->
       

       <section id="about_us">
        <img class="wave" src="images/emna.jpg">
            <h4 class="mini_title">About Us</h4>
            <h2 class="title">Why choose us ?</h2>
            <div class="about">
                <div class="left">
                    <img src="images/hooo.png">
                </div>
                <div class="right">
                    <h3>Best product in The Word</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae est, iure culpa ipsa tempora explicabo ullam similique? Ipsum, est, beatae adipisci autem dolores, dolore eveniet mollitia quibusdam eius provident fugiat!</p>
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Debitis ipsa non quis pariatur enim fugit ratione. Unde maiores veritatis eaque accusamus minus sunt, eligendi nisi officiis quis vitae dignissimos officia.</p>
                    <button><a href="#">Learn More</a></button>
                </div>
            </div>
       </section>


      

      <!-- footer -->
      <footer>
          <div class="services_list">
              <div class="service">
                  <img src="images/clock.png" alt="">
                  <h2>Ouverture</h2>
                  <p>10h30 à 23h45</p>
                  <p>23h45 à 9h30</p>
              </div>

              <div class="service">
                <img src="images/pin.png" alt="">
                <h2>Adresses</h2>
                <p>tunis </p>
                <p>Bénin-Cotonou</p>
            </div>
            <div class="service">
                <img src="images/email.png" alt="">
                <h2>Emails</h2>
                <p>email@gmail.com</p>
                <p>your.dish@gmail.com</p>
            </div>
            <div class="service">
                <img src="images/call.png" alt="">
                <h2>Numbers</h2>
                <p>+33 54454544</p>
                <p>+33 45687515</p>
            </div>
            
            <hr>
          </div>

          <p class="footer_text">Réalisé par <span>Faiz Dev</span> | Tous les droits sont réservés.</p>
      </footer>




      <script>
          var small_menu = document.querySelector('.toggle_menu')
          var menu = document.querySelector('.menu')

          small_menu.onclick = function(){
               small_menu.classList.toggle('active');
               menu.classList.toggle('responsive');
          }
      </script>
</body>
</html>