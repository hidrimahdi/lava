
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
    color: #27ae60;
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
    </style>



<?php
require_once("config.php");

session_start();

// Vérifier si l'utilisateur est connecté
if(!isset($_SESSION["id"]))
 {
    header("Location: login.php");
    exit();
}

// Récupérer les informations de l'utilisateur à partir de la table "compte"
$id = $_SESSION["id"];
$sql = "SELECT * FROM compte WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(":id", $id);
$stmt->execute();
$user = $stmt->fetch();

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


<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gestion de compte</title>
    <link rel="stylesheet" href="style_compte.css" />
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
  </head>
  <body>

  <header>
  <a href="#" class="logo1"><i class="fas fa-seedling"></i>Virtuart</a>
        <ul class="menu">
       
            <li><a href="index.php">Acceuil</a></li>
            <li><a href="produitt.php">Produits</a></li>
            
            <li><a href="login.php">Logout</a></li>

        </ul>

        <!-- menu responsive -->
         <!-- menu responsive -->
         <div class="toggle_menu"></div>
        </header>
    


    
    
    <br><br><br>
    <div class="container">
    <h1 >Gestion du compte</h1>
    <br>
      

      

      <div class="separator"></div>

      <h2 class="main-title">Informations du compte</h2>
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

