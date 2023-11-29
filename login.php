<?php
require_once("config.php");

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $mail = $_POST["mail"];
    $mp = $_POST["mp"];
	
    
    $sql = "SELECT * FROM compte WHERE mail = :mail";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":mail", $mail);
    $stmt->execute();
    $user = $stmt->fetch();

	$id=$user["id"] ;

    if($user) {
        if($mp == $user["mp"] ) {   // password_verify($mp, $user["mp"] 
            if($user["type"] == "admin") {
                session_start();
                $_SESSION["mail"] = $mail ;       //session
				if ($user["role"] =="admins")
				header("Location: /integration//back/backoffice/ajouteradmine.php");
				else if( ($user["role"] =="produits"))
				header("Location: /integration//back/backoffice/ajouterprod.php");
				else if( ($user["role"] =="fournisseurs"))
				header("Location: /integration//back/backoffice/fournisseurs.php");
				else if( ($user["role"] =="livraisons"))
				header("Location: /integration//back/backoffice/afficherlivraison.php");
				else if( ($user["role"] =="reclamations"))
				header("Location: /validation//back/backoffice/reclamations.php");
				else if( ($user["role"] =="commandes"))
				header("Location: /validation//back/backoffice/commande.php");





            } elseif ($user["type"] == "user") {
                session_start();
                $_SESSION["id"] = $id;   //session
                header("Location: index.php");
            } else {
                $message = "Type de compte invalide.";
            }
            exit();
        } else {
            $message = "Mot de passe incorrect.";
        }
    } else {
        $message = "Adresse email incorrecte.";
    }
}
?>





<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
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

	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>

</head>




<body>

  <!-- conteneur principal -->
	<div class="container">
		<!-- en-tête de la page -->
    <header>
      <a href="#" class="logo"><i class="fas fa-seedling"></i>Virtuart</a>
	  <ul class="menu">

	</ul>


       <div class="toggle_menu"></div>
      </header>


		<section id="login">
			<img class="wave" src="images/emna.jpg">
			<div class="container">
				<div class="img">
					<img src="images/bg.svg">
				</div>

				<div class="login-content">
					<form method="post" action="" >
						<img src="images/avatar.svg">

						<h2 class="title">Bienvenue</h2>
					

						<div class="input-div one">
							<div class="i">
								<i class="fas fa-user"></i>
							</div>

							<div class="div">
								<h5 id="label1">Adresse mail</h5>
								<input type="email" id="mail" name="mail" required class="input"  oninput="hideLabel1()">
							</div>

						</div>

						<div class="input-div pass">
							<div class="i"> 
								<i class="fas fa-lock"></i>
							</div>
							<div class="div">
								<h5 id="label2">Mot de passe</h5>
								<input type="password" id="mp" name="mp" required class="input" oninput="hideLabel2()">
							</div>

						</div>

						<div class="forgot-link">
              <a href="forget.php">Mot de passe oublié?</a>
              <span>ou</span>
              <a href="inscrire.php">Inscrivez-vous</a>

			  <span><?php if(isset($message)) { echo "<p>$message</p>"; } ?> </span>

            </div>

			<!-- recaptcha -->
			<div class="g-recaptcha" data-sitekey="6LcQnLAlAAAAAMnpSB2CUpeYuHc9ZWAsAwx-l3bj" data-callback="enableBtn"></div>
		    <br>
			<!-- recaptcha -->

			<input type="submit" class="btn" value="Se connecter" id="submitBtn" disabled style="background: linear-gradient(to right, #ccc, #ccc);" onclick="redirectToInscrire()">

					
					
					</form>
				</div>
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
	function redirectToInscrire() {
        // Redirect to inscrire.php
        window.location.href = 'inscrire.php';
    }

</script>
 