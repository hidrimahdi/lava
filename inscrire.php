<?php

// Inclure le fichier de configuration pour établir la connexion à la base de données
require_once "config.php";

// Initialiser la variable de message
$message = "";

$v3=0 ;
$v4=0 ;
$v5=0 ;
$v4_1=0 ;
$v5_1=0 ;
$v6=0 ;
$v7=0 ;
$v8=0 ;

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Récupérer les valeurs saisies par l'utilisateur
  $nom = $_POST["nom"];
  $prenom = $_POST["prenom"];
  $mail = $_POST["mail"];
  $mp = $_POST["mp"];
  $mp_confirm = $_POST["mp_confirm"];
  $adresse = $_POST["adresse"];
  $num_tel = $_POST["num_tel"];
  $date_anniversaire = $_POST["date_anniversaire"];

  // Vérifier si l'adresse e-mail est déjà utilisée
  $query = "SELECT * FROM compte WHERE mail = ?";
  $stmt = $pdo->prepare($query);
  $stmt->execute([$mail]);
  $result = $stmt->fetch();
  if ($result) {
    $message3 = "Cette adresse e-mail est déjà utilisée.";
  }
  else { $v3=1 ;}

    // Vérifier si l'utilisateur a plus de 18 ans
    $aujourdhui = new DateTime();
    $date_anniversaire = new DateTime($date_anniversaire);
    $diff = $aujourdhui->diff($date_anniversaire);
    if ($diff->y < 18) {
      $message6 = "Vous devez avoir au moins 18 ans pour vous inscrire.";
    } 
	else { $v6=1;	}


	  if ($mp !== $mp_confirm) {
        $message5 = "Les mots de passe ne correspondent pas.";
		$message4 = "Les mots de passe ne correspondent pas.";
      } 
	  else
	  {$v4=1; $v5=1 ;}

        // Vérifier si le mot de passe contient au moins une lettre majuscule et un caractère spécial
        if (!preg_match('/[A-Z]/', $mp) || !preg_match('/[\W]/', $mp)) {
			$message4_1 = "Le mot de passe doit contenir au moins une lettre majuscule et un caractère spécial.";
			$message5_1 = "Le mot de passe doit contenir au moins une lettre majuscule et un caractère spécial.";
        } 
		else
	  {$v4_1 =1 ; $v5_1=1;}

          // Vérifier si le numéro de téléphone contient 8 chiffres
          if (!preg_match('/^\d{8}$/', $num_tel)) {
			$message8 = "Le numéro de téléphone doit être composé de 8 chiffres.";
		}
		  else
		  {$v8=1;}
		  if (strlen($adresse) < 10) {
			$message7 = "L'adresse doit contenir au moins 10 caractères.";
		}
		else
		{$v7=1;}
		  if (  $v3==1 && $v4 ==1 && $v5==1 &&  $v4_1 ==1 && $v5_1==1 &&$v6==1 && $v7==1 && $v8==1 )
		  {
            // Trouver le nouvel identifiant
            $query = "SELECT MAX(id) as max_id FROM compte";
            $stmt = $pdo->query($query);
            $row = $stmt->fetch();
            $new_id = $row["max_id"] + 1;

// Insérer les données dans la table "compte"
$query = "INSERT INTO compte (id, nom, prenom, mail, mp, adresse, num_tel, date_anniversaire,type) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?)";
$stmt = $pdo->prepare($query);
$stmt->execute([$new_id, $nom, $prenom, $mail, $mp, $adresse, $num_tel, $date_anniversaire->format('Y-m-d') ,'user']);
		  


echo "Inscription réussie !";
header("Location: login.php");

          }
		  echo "Inscription echouée !";
        



		}
?>




<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Inscription</title>
	<!-- lien vers la feuille de style CSS -->
	<link rel="stylesheet" href="style.css">
	<!-- lien vers la police d'icônes -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-HU7zL88M2uYB29shnG4pxw5c5a5Q5C8XlnW+HvZMZbawRoYch0bjk8jK5Ov+e/nNGtpeOJt8X+60UGRZtLdug==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <!-- recaptcha -->
    <script src="https://www.google.com/recaptcha/api.js"></script>
<script>
	function enableBtn() {
		var btn = document.getElementById('submitBtn');
		btn.disabled = false;
		btn.style.background = 'linear-gradient(to right, #32be8f, #38d39f, #32be8f)';
	}
</script>


	<!-- recapcha -->

</head>
<body>

  <!-- conteneur principal -->
	<div class="container">
		<!-- en-tête de la page -->
    <header>
      <a href="#" class="logo"><i class="fas fa-seedling"></i>Virtuart</a>
	  <ul class="menu">
		<li><a href="index.html">Acceuil</a></li>
		<li><a href="produit.html">Produits</a></li>
		<li><a href="#about_us">A Propos</a></li>
		<li><a href="#about_us">Réclamations</a></li>

		<li><a href="login.php"><img src="images/1.png" alt="compte" width="5%"></a></li>
        <li><a href="login.php">login</a></li>
	</ul>


       <div class="toggle_menu"></div>
      </header>


<!-- section d'inscription -->
<section id="register"  >
	<img class="wave" src="images/emna.jpg">

	<div class="container1">
	  <div class="img1">
		<img src="images/bg.svg">
	  </div>


	  <div class="login-content">

		<form method="post" action="">


		  <img src="images/avatar.svg">
		  <h2 class="title">Inscription</h2>

		  <div class="input-div one">
			<div class="i">
			  <i class="fas fa-user"></i>
			</div>
		
			<div class="div">
			  <h5 id="label1">Nom d'utilisateur</h5>
			  <input type="text"id="nom" name="nom" required class="input" oninput="hideLabel1()">
			  <span style="color: red; display: block; margin-top: -20px;">  <?php if(isset($message)) { echo "<p>$message</p>"; } ?> </span>
		
			</div>
		  </div>

		  <div class="input-div one">
			<div class="i">
			  <i class="fas fa-user"></i>
			</div>
		
			<div class="div">
    <h5 id="label2">Prenom d'utilisateur</h5>
    <input type="text" id="prenom" name="prenom" required class="input" oninput="hideLabel2()">
</div>


		  </div>
		
		
		  <div class="input-div one">
			<div class="i">
			  <i class="fas fa-envelope"></i>
			</div>
			<div class="div">
			  <h5 id="label3">Adresse email</h5>
			  <input type="email" id="mail" name="mail" required class="input" oninput="hideLabel3()">
			  <span style="color: red; display: block; margin-top: -20px;">  <?php if(isset($message3)) { echo "<p>$message3</p>"; } ?> </span>
			</div>
		  </div>


		  <div class="input-div pass">
			<div class="i"> 
			  <i class="fas fa-lock"></i>
			</div>
			<div class="div">
			  <h5 id="label4" >Mot de passe</h5>
			  <input type="password" id="mp" name="mp" required class="input" oninput="hideLabel4()">
			  <span style="color: red; display: block; margin-top: -30px;">  <?php if(isset($message4)) { echo "<p>$message4</p>"; } ?> </span>
			  <span style="color: red; display: block; margin-top: 0px;">  <?php if(isset($message4_1)) { echo "<p>$message4_1</p>"; } ?> </span>
			</div>
		  </div>

		  
		  <div class="input-div pass">
			<div class="i"> 
			  <i class="fas fa-lock"></i>
			</div>
			<div class="div">
			  <h5 id="label5">Confirmer le mot de passe</h5>
			  <input type="password" id="mp_confirm" name="mp_confirm" required class="input" oninput="hideLabel5()">
			  <span style="color: red; display: block; margin-top: -30px;">  <?php if(isset($message5)) { echo "<p>$message5</p>"; } ?> </span>
			  <span style="color: red; display: block; margin-top: 0px;">  <?php if(isset($message5_1)) { echo "<p>$message5_1</p>"; } ?> </span>
			</div>
		  </div>

		  
		  <div class="input-div one">
    <div class="i">
        <i class="fas fa-birthday-cake"></i>
    </div>
    <div class="div" style="margin-top: 20px;"> 
        <input type="date" id="date_anniversaire" name="date_anniversaire" required class="input">
        <span style="color: red; display: block; margin-top: -20px;">  <?php if(isset($message6)) { echo "<p>$message6</p>"; } ?> </span>
    </div>
</div>

		  <div class="input-div one">
			<div class="i">
			  <i class="fas fa-envelope"></i>
			</div>
			<div class="div">
			  <h5 id="label6">Adresse</h5>
			  <input type="text" id="adresse" name="adresse" required class="input" oninput="hideLabel6()">
			  <span style="color: red; display: block; margin-top: -20px;">  <?php if(isset($message7)) { echo "<p>$message7</p>"; } ?> </span>
			</div>
		  </div>


		  <div class="input-div one">
			<div class="i">
			  <i class="fas fa-envelope"></i>
			</div>
			<div class="div">
			  <h5  id="label7">Num telephonne</h5>
			  <input type="text" id="num_tel" name="num_tel" required class="input" oninput="hideLabel7()" >
			  <span style="color: red; display: block; margin-top: -20px;">  <?php if(isset($message8)) { echo "<p>$message8</p>"; } ?> </span>
			</div>
		  </div>


		  <!-- recaptcha -->
			<div class="g-recaptcha" data-sitekey="6LcQnLAlAAAAAMnpSB2CUpeYuHc9ZWAsAwx-l3bj" data-callback="enableBtn"></div>
		    <br>
			<!-- recaptcha -->
		
		  <input type="submit" class="btn" value="S'inscrire" id="submitBtn" disabled style=" background: linear-gradient(to right, #ccc, #ccc);">

		</div>

		</form>
	</div>

</section>


	</div>
</body>
</html>


<script>
    
	function hideLabel1() {
        document.getElementById("label1").style.display = "none";
    }
	function hideLabel2() {
        document.getElementById("label2").style.display = "none";
    }
	function hideLabel3() {
        document.getElementById("label3").style.display = "none";
    }
	function hideLabel4() {
        document.getElementById("label4").style.display = "none";
    }
	function hideLabel5() {
        document.getElementById("label5").style.display = "none";
    }
	function hideLabel6() {
        document.getElementById("label6").style.display = "none";
    }
	function hideLabel7() {
        document.getElementById("label7").style.display = "none";
    }

</script>
 