
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

//////////////////////////////////////////////////////////////////////////////////////

$v1=0 ;
$v2=0 ;
$v4=0 ;

if (isset($_POST["update_nom"])) 
{
    // Récupérer les valeurs du formulaire
    $nom = $_POST["Nom"];
    $prenom = $_POST["Prenom"];
    $adresse = $_POST["adresse"];
    $num_tel = $_POST["telephone"];
    $date_anniversaire = $_POST["date-anniversaire"];

    // Vérifier si l'utilisateur a plus de 18 ans
    $today = new DateTime();
    $birthday = new DateTime($date_anniversaire);
    $interval = $today->diff($birthday);

    if ($interval->y < 18) {
        $message4 = "Vous devez avoir au moins 18 ans pour vous inscrire.";
    }
    else {$v4=1;}
    // Vérifier si le numéro de téléphone contient 8 chiffres
    if (!preg_match('/^\d{8}$/', $num_tel)) {
        $message2 = "Le numéro de téléphone doit être composé de 8 chiffres.";
    }
    else{$v2=1;}
    if (strlen($adresse) < 10) {
			$message1 = "L'adresse doit contenir au moins 10 caractères.";
		}
		else
		{$v1=1;}

    if($v1==1 && $v2==1 && $v4 ==1)
    {
        // Mettre à jour les informations de l'utilisateur dans la base de données
        $sql = "UPDATE compte SET Nom = :nom, Prenom = :prenom, adresse = :adresse, num_tel = :num_tel, date_anniversaire = :date_anniversaire WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":nom", $nom);
        $stmt->bindParam(":prenom", $prenom);
        $stmt->bindParam(":adresse", $adresse);
        $stmt->bindParam(":num_tel", $num_tel);
        $stmt->bindParam(":date_anniversaire", $date_anniversaire);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        // Rediriger l'utilisateur vers la page de gestion de compte
        $_SESSION["id"] = $id ; 
        header("Location: afficher.php");
        exit();
    }
  }

  $f1=0;
  $f2=0;

    if (isset($_POST["update_mail"] )) {
      // Récupérer les nouvelles adresses e-mail
      $new_mail = $_POST["adresse-email"];
      $new_mail_confirm = $_POST["adresse-email-confirm"];

        // Vérifier si l'adresse e-mail est déjà utilisée
    $query = "SELECT * FROM compte WHERE mail = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$new_mail]);
    $result = $stmt->fetch();
    if ($result) {
     $messagef1 = "Cette adresse e-mail est déjà utilisée.";
   }
   else 
   {  $f1=1;}

      // Vérifier si les deux adresses e-mail sont identiques
      if ($new_mail !== $new_mail_confirm) {
        // Afficher un message d'erreur si les adresses e-mail ne sont pas identiques
          $messagef2 = "Les deux adresses e-mail doivent être identiques.";}
          else
          {$f2=1;}

          if($f1==1 && $f2==1)
          {
          // Mettre à jour l'adresse e-mail de l'utilisateur dans la base de données
          $sql = "UPDATE compte SET mail = :new_mail WHERE id = :id";
          $stmt = $pdo->prepare($sql);
          $stmt->bindParam(":new_mail", $new_mail);
          $stmt->bindParam(":id", $id);
          $stmt->execute();
  
          // Rediriger l'utilisateur vers la page de gestion de compte
          $_SESSION["id"] = $id ; 
          header("Location: afficher.php");
          exit();
      } 
          
      
    }

    $m1=0;
    $m2=0;
    $m3=0;

if(isset($_POST["update_mp"]))
{
  $old_password = $_POST["mot-de-passe-actuel"];
  $new_password = $_POST["nouveau-mot-de-passe"];
  $confirm_password = $_POST["nouveau-mot-de-passe-confirm"];

  // Vérifier si le mot de passe actuel correspond à celui stocké dans la base de données
  if($old_password !== $user["mp"] )
  {
    $messagem1 = "Le mot de passe actuel est incorrect.";
  }
  else
  {$m1=1;}

    // Vérifier si les deux nouveaux mots de passe sont identiques et répondent aux exigences en matière de complexité
    if($new_password !== $confirm_password )
    {
      $messagem2 = "Les nouveaux mots de passe ne sont pas identiques.";
    }
    else
    {$m2=1;}
    if(!preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*()_+-])[0-9a-zA-Z!@#$%^&*()_+-]{8,}$/", $new_password) )
    {
      $messagem3 = "Le mot de passe doit contenir au moins une lettre majuscule et un caractère spécial..";
    }
    else
    {$m3=1;}

    if ( $m1 ==1 && $m2==1 && $m3==1 )
    {
      // Mettre à jour le mot de passe de l'utilisateur dans la base de données
      //$hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
      $sql = "UPDATE compte SET mp = :mot_de_passe WHERE id = :id";
      $stmt = $pdo->prepare($sql);
      $stmt->bindParam(":mot_de_passe", $new_password);
      $stmt->bindParam(":id", $id);
      $stmt->execute();

      // Rediriger l'utilisateur vers la page de gestion de compte
      $_SESSION["id"] = $id ; 
        header("Location: afficher.php");
      exit();
    }

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
            <li><a href="produitt.php">gallerie</a></li>
            <li><a href="index.php">A Propos</a></li>
            <li><a href="Reclamation.php">Reclamation</a></li>
            <li><a href="livraison.php">Livraison</a></li>
            <li><a href="Panier.php">Panier</a></li>
            <li><a href="afficher.php"><img src="images/1.png" alt="compte" width="20px"></a></li>
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
            <label for="Nom">Nom :</label>
            <input type="text" id="Nom" name="Nom" value="<?php echo $user["Nom"]; ?>" required>
          </div>
          <div class="form-group">
            <label for="prenom">Prénom :</label>
            <input type="text" id="Prenom" name="Prenom" value="<?php echo $user["Prenom"]; ?>" required>
          </div>
          <div class="form-group">
            <label for="adresse">Adresse :</label>
            <input type="text" id="adresse" name="adresse" value="<?php echo $user["adresse"]; ?>" required>
            <span style="color: red; display: block">  <?php if(isset($message1)) { echo "<p>$message1</p>"; } ?> </span>
          </div>
          <div class="form-group">
            <label for="telephone">Numéro de téléphone :</label>
            <input type="tel" id="telephone" name="telephone" value="<?php echo $user["num_tel"]; ?>" required>
            <span style="color: red; display: block">  <?php if(isset($message2)) { echo "<p>$message2</p>"; } ?> </span>
          </div>
          <div class="form-group">
            <label for="mail">Adress Mail :</label>
            <input type="email" id="mail" name="mail" value="<?php echo $user["mail"];  ?>" readonly >
          </div>
          <div class="form-group">
            <label for="date-anniversaire">Date d'anniversaire :</label>
            <input type="date" id="date-anniversaire" name="date-anniversaire" value="<?php echo $user["date_anniversaire"]; ?>" required>
            <span style="color: red; display: block">  <?php if(isset($message4)) { echo "<p>$message4</p>"; } ?> </span>
          </div>
        </div>
        
        <div class="button-container">
          <button type="submit" name="update_nom">Enregistrer les modifications</button> 
        </div>
      </form>


      <div class="separator"></div>

      <h2 class="main-title">Sécurité</h2>
      <h3 class="subsection-title">Changer l'adresse e-mail</h3>
      
      <form form method="post" >
        <div class="form-container">
          <div class="form-group">
            <label for="adresse-email">Nouvelle adresse e-mail :</label>
            <input type="email" id="adresse-email" name="adresse-email" required>
          </div>
          <div class="form-group">
            <label for="adresse-email-confirm">Confirmer la nouvelle adresse e-mail :</label>
            <input type="email" name="adresse-email-confirm" id="adresse-email-confirm" required>
        </div>
        
        <span style="color: red; display: block">  <?php if(isset($messagef1)) { echo "<p>$messagef1</p>"; } ?> </span>
        <span style="color: red; display: block">  <?php if(isset($messagef2)) { echo "<p>$messagef2</p>"; } ?> </span>

        <div class="button-container">
        <button type="submit" name="update_mail" >Enregistrer les modifications</button>
        </div>
        </div>
        </form>
      
      
        <div class="separator"></div>

        <h3 class="subsection-title">Changer le mot de passe</h3>
              
        <form form method="post">
          
        <div class="form-container">
            <div class="form-group">
              <label for="mot-de-passe-actuel">Mot de passe actuel :</label>
              <input type="password" id="mot-de-passe-actuel" name="mot-de-passe-actuel" required>
              <span style="color: red; display: block">  <?php if(isset($messagem1)) { echo "<p>$messagem1</p>"; } ?> </span>
            </div>
            <div class="form-group">
              <label for="nouveau-mot-de-passe">Nouveau mot de passe :</label>
              <input type="password" id="nouveau-mot-de-passe" name="nouveau-mot-de-passe" required>
            </div>
            <div class="form-group">
              <label for="nouveau-mot-de-passe-confirm">Confirmer le nouveau mot de passe :</label>
              <input type="password" id="nouveau-mot-de-passe-confirm" name="nouveau-mot-de-passe-confirm" required>
              <span style="color: red; display: block">  <?php if(isset($messagem2)) { echo "<p>$messagem2</p>"; } ?> </span>
            <span style="color: red; display: block">  <?php if(isset($messagem3)) { echo "<p>$messagem3</p>"; } ?> </span>
            </div>

            
            
            
            <div class="button-container">
              <button type="submit" name="update_mp" >Enregistrer les modifications</button>
            </div>
          </div>

        </form>
      

        <div class="separator"></div>
      </div>
    </body>
    </html>
