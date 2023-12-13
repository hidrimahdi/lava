
<style>
      header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    height: 50px;
    padding: 0 10%;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    background-color: rgba(255 255 255 /0.9);
    box-shadow: 0 0 10px rgba(0,0,0,0.2);
    z-index: 10;
}
.menu {
    display: flex;
}
.logo1 {
    color: black;
    font-weight: 700;
    font-size: 25px;
}
.logo1 span {
    color: #273e60;
}
.menu li {
   margin: 0 15px;
   list-style: none;
}
.menu li a {
    font-size: 14px;
    text-decoration: 0;
    color: #999;
    position: relative;
}
.menu li a::before {
    position: absolute;
    top: -5px;
    left: 0;
    content: "";
    width: 0;
    height: 2px;
    border-radius: 6px;
    background-color: #bc732a;
    transition: 0.5s;
}
.menu li a:hover::before {
    width: 100%;
}
.menu li a::after {
    position: absolute;
    bottom: -5px;
    right: 0;
    content: "";
    width: 0;
    height: 2px;
    border-radius: 6px;
    background-color: #a8711f;
    transition: 0.5s;
}
.menu li a:hover::after {
    width: 100%;
}
.menu li a:hover {
    color: #000;
}
.logout-button {
      position: fixed;
      top: 10px;
      right: 10px;
      background-color: lightseagreen; /* Change the background color if needed */
      padding: 10px;
      border: none;
      color: white;
      text-decoration: none;
      cursor: pointer;
    }

    .logout-button:hover {
      background-color: lightskyblue; /* Change the background color on hover if needed */
    }
    </style>



<?php
require_once("config.php");

session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION["id"])) {
  header("Location: login.php");
  exit();
}

// Assurez-vous que $_SESSION["id"] est défini
$id = $_SESSION["id"];

try {
  $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_user, $db_pass);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Récupérer les informations de l'utilisateur à partir de la table "compte"
  $sql = "SELECT * FROM compte WHERE id = :id";
  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(":id", $id);
  $stmt->execute();
  $user = $stmt->fetch();

  // Utilisez les données récupérées dans $user
  // ...
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

if (isset($_POST["update_supprimer"])) {
  $id = $_SESSION["id"];
  $sql = "DELETE FROM compte WHERE id = :id";
  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(":id", $id);
  $stmt->execute();
 
  header("Location: login.php");
  exit();
}

if (isset($_POST["update_modifier"])) {
  $_SESSION["id"] = $id ; 
  header("Location: modifier.php");
  exit();
}



?>


<<!DOCTYPE html>
<html lang="en">

<head>
  <title>Virtuart</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://fonts.googleapis.com/css?family=Rubik:400,700|Crimson+Text:400,400i" rel="stylesheet">
  <link rel="stylesheet" href="fonts/icomoon/style.css">

  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/magnific-popup.css">
  <link rel="stylesheet" href="css/jquery-ui.css">
  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">


  <link rel="stylesheet" href="css/aos.css">

  <link rel="stylesheet" href="css/style.css">

</head>

<body>

  <div class="site-wrap">


    <div class="site-navbar py-2">

      <div class="search-wrap">
        <div class="container">
          <a href="#" class="search-close js-search-close"><span class="icon-close2"></span></a>
          <form action="#" method="post">
            <input type="text" class="form-control" placeholder="Search keyword and hit enter...">
          </form>
        </div>
      </div>

      <div class="container">
        <div class="d-flex align-items-center justify-content-between">
          <div class="logo">
            <div class="site-logo">
              <a href="index.php" class="js-logo-clone">Virtuart</a>
            </div>
          </div>
          <div class="main-nav d-none d-lg-block">
            <nav class="site-navigation text-right text-md-center" role="navigation">
              <ul class="site-menu js-clone-nav d-none d-lg-block">
                <li class=""><a href="index.php">Home</a></li>
                <li><a href="store.php">Store</a></li>
              
                <li><a href=" http://localhost/Project/Dashbord/View/tableRec.php">My Products</a></li>
                <li class=""><a href="http://localhost/Project/Dashbord/View/addCommande.php">Commande</a></li>
                <li class=""><a href="http://localhost/Project/Dashbord/View/add.php">Product</a></li>
                <li class="active"><a href="http://localhost/Project/Dashbord/View/modifier.php">gestion de compte</a></li>
                <li><a href="http://localhost/Project/Dashbord/View/MyEventsView.php">events</a></li>
                <li><a href="http://localhost/Project/Dashbord/View/login.php" class="logout-button">Logout</a></li>
              </ul>
            </nav>
          </div>
          <div class="icons">
            <a href="#" class="icons-btn d-inline-block js-search-open"><span class="icon-search"></span></a>
            <a href="cart.html" class="icons-btn d-inline-block bag">
              <span class="icon-shopping-bag"></span>
              <span class="number">2</span>
            </a>
            <a href="#" class="site-menu-toggle js-menu-toggle ml-3 d-inline-block d-lg-none"><span
                class="icon-menu"></span></a>
          </div>
        </div>
      </div>
    </div>

    <div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0">
            <a href="index.php">Home</a> <span class="mx-2 mb-0">/</span>
            <strong class="text-black">Home</strong>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h2 class="h3 mb-5 text-black"> Gestion Du Compte</h2>
            <h2 class="h3 mb-5 text-black">Informations du compte</h2>
            
        </ul>

        <!-- menu responsive -->
         <!-- menu responsive -->
         <div class="toggle_menu"></div>
        </header>
    


    
    
    <br><br><br>
    <div class="container">
    <h1 ></h1>
    <br>
      

      

      <div class="separator"></div>
      <form method="post" >
        <div class="form-container">
          <div class="form-group">
            <label for="nom">Nom :</label>
            <input type="text" id="Nom" name="Nom" value="<?php echo $user["Nom"]; ?>" readonly>
          </div>
          <div class="form-group">
            <label for="prenom">Prénom :</label>
            <input type="text" id="Prenom" name="Prenom" value="<?php echo $user["Prenom"]; ?>" readonly>
          </div>
          <div class="form-group">
            <label for="adresse">Adresse :</label>
            <input type="text" id="adresse" name="adresse" value="<?php echo $user["adresse"]; ?>" readonly>
          </div>
          <div class="form-group">
            <label for="telephone">Numéro de téléphone :</label>
            <input type="tel" id="telephone" name="telephone" value="<?php echo $user["num_tel"]; ?>" readonly>
          </div>
          <div class="form-group">
            <label for="mail">Adress Mail :</label>
            <input type="email" id="mail" name="mail" value="<?php echo $user["mail"]; ?>" readonly>
          </div>

          <div class="form-group">
            <label for="date-anniversaire">Date d'anniversaire :</label>
            <input type="date" id="date-anniversaire" name="date-anniversaire" value="<?php echo $user["date_anniversaire"]; ?>" readonly>
          </div>
        </div>

        <div class="button-container">
          <button type="submit" name="update_modifier" >Modifier Les informations </button>
        </div>
        </form>

        <div class="separator"></div>

        <form method="post">
        <div class="button-container">
          <button type="submit" name="update_supprimer">Supprimer le compte</button>
        </div>

        </form>

      


      
        <div class="separator"></div>
      </div>
    </body>
    </html>

