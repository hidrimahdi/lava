<?php
require_once("config.php");

$v1 = 0;
$v2 = 0;

// Vérifier que le token a été envoyé via l'URL
if (!isset($_GET['token'])) {
    die("Token invalide.");
}

// Récupérer le token depuis l'URL
$token = $_GET['token'];

// Vérifier que le token existe dans la base de données
$stmt = $pdo->prepare("SELECT * FROM compte WHERE reset_token = ?");
$stmt->execute([$token]);
$tokenData = $stmt->fetch();
$stmt->closeCursor();

if (!$tokenData) {
    die("Token invalide.");
}

// Vérifier que le token n'a pas déjà été utilisé
if ($tokenData['used_token'] == 1) {
    die("Token déjà utilisé.");
}

// Récupérer l'adresse e-mail de l'utilisateur
$mail = $tokenData['mail'];

// Traitement du formulaire de réinitialisation du mot de passe
if (isset($_POST['modifier'])) {

    // Vérifier que les deux mots de passe entrés correspondent
    if ($_POST['new_password'] !== $_POST['confirm_password']) {
        $message1 = "Les mots de passe ne sont pas identiques.";
    } else {
        $v1 = 1;
    }

    if (!preg_match('/[A-Z]/', $_POST['new_password']) || !preg_match('/[\W]/', $_POST['new_password'])) {
        $message2 = "Le mot de passe doit contenir au moins une lettre majuscule et un caractère spécial.";
    } else {
        $v2 = 1;
    }

    if ($v1 == 1 && $v2 == 1) {
        // Hash the new password
        $hashedPassword = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

        // Mettre à jour le mot de passe haché dans la base de données
        // Marquer le token comme utilisé dans la base de données
        $sql = "UPDATE compte SET mp = :mot_de_passe, used_token = :used_token WHERE mail = :mail";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":mot_de_passe", $hashedPassword);
        $stmt->bindParam(":mail", $mail);
        $used_token = 1;
        $stmt->bindParam(":used_token", $used_token);
        $stmt->execute();

        $stmt->closeCursor();

        header('Location: login.php');
        exit;
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Renitialisation du mot de passe</title>
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
      <a href="#" class="logo"><i class="fas fa-seedling"></i>virtuart</a>
	  <ul class="menu">
		<li><a href="login.php">Acceuil</a></li>
		

		<li><a href="login.php"><img src="images/1.png" alt="compte" width="5%"></a></li>
        <li><a href="login.php">login</a></li>
	</ul>


       <div class="toggle_menu"></div>
      </header>


<!-- section Renitialisation du mot de passetion -->
<section id="register"  >
	<img class="wave" src="images/emna.jpg">

	<div class="container1">
	  <div class="img1">
		<img src="images/bg.svg">
	  </div>


	  <div class="login-content">

		<form method="post" action="">


		  <img src="images/avatar.svg">
		  <h2 class="title">Renitialisation du mot de passe</h2>


		
		
		  <div class="input-div one">
			<div class="i">
			  <i class="fas fa-envelope"></i>
			</div>
			<div class="div">
			  <input type="email"  value="<?php echo $mail; ?>" readonly class="input" oninput="hideLabel3() ">
			</div>
		  </div>


		  <div class="input-div pass">
			<div class="i"> 
			  <i class="fas fa-lock"></i>
			</div>
			<div class="div">
			  <h5 id="label4" >Mot de passe</h5>
			  <input type="password" id="new_password" name="new_password" required class="input" oninput="hideLabel4()">
			</div>
		  </div>

		  
		  <div class="input-div pass">
			<div class="i"> 
			  <i class="fas fa-lock"></i>
			</div>
			<div class="div">
			  <h5 id="label5">Confirmer le mot de passe</h5>
			  <input type="password" id="confirm_password" name="confirm_password" required class="input" oninput="hideLabel5()">
			</div>
     
		  </div>

		  
		  <span style="color: red; display: block; margin-top: 0px;">  <?php if(isset($message1)) { echo "<p>$message1</p>"; } ?> </span>
  	  <span style="color: red; display: block; margin-top: 0px;">  <?php if(isset($message2)) { echo "<p>$message2</p>"; } ?> </span>

      
	  <!-- recaptcha -->
	  <div class="g-recaptcha" data-sitekey="6LcQnLAlAAAAAMnpSB2CUpeYuHc9ZWAsAwx-l3bj" data-callback="enableBtn"></div>
		    <br>
			<!-- recaptcha -->
	
      <input type="submit" name="modifier" class="btn" value="Modifier" id="submitBtn" disabled style=" background: linear-gradient(to right, #ccc, #ccc);">

		</div>

		</form>
	</div>

</section>


	</div>
</body>
</html>


<script>
    
	
    
	function hideLabel3() {
        document.getElementById("label3").style.display = "none";
    }
	function hideLabel4() {
        document.getElementById("label4").style.display = "none";
    }
	function hideLabel5() {
        document.getElementById("label5").style.display = "none";
    }


</script>
 