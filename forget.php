<?php
require_once("config.php");
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $mailAddress = $_POST["mail"];

    // Vérifier si l'adresse e-mail est déjà utilisée
    $query = "SELECT * FROM compte WHERE mail = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$mailAddress]);
    $result = $stmt->fetch();
    if ($result) {
        // Envoyer l'e-mail de réinitialisation
        $token = bin2hex(random_bytes(50)); // Générer un jeton aléatoire
        $query = "UPDATE compte SET reset_token = ? WHERE mail = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$token, $mailAddress]);

        $mail = new PHPMailer(true);
        try {
            //Configurer le serveur SMTP
            $mail->SMTPDebug = SMTP::DEBUG_OFF;                      // Activer la sortie de débogage détaillée
            $mail->isSMTP();                                            // Envoyer en utilisant SMTP
            $mail->Host       = 'smtp.gmail.com';                       // Configurez le serveur SMTP à utiliser
            $mail->SMTPAuth   = true;                                   // Activer l'authentification SMTP
            $mail->Username   = 'hidrihidri2002@gmail.com';         // Nom d'utilisateur SMTP
            $mail->Password   = 'c w j j z b i d n u k x x c e h';                     // Mot de passe SMTP
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Activer le chiffrement TLS; `PHPMailer::ENCRYPTION_SMTPS` également accepté
            $mail->Port       = 587;                                    // Port TCP à utiliser pour la connexion

            // Destinataire
            $mail->setFrom('hidrihidri2002@gmail.com', 'Virtuart');
            $mail->addAddress($mailAddress);

            // Contenu du message
            $mail->isHTML(true);                                  // Définir le format de l'e-mail sur HTML
            $mail->Subject = 'Réinitialisation du mot de passe';
            $mail->Body    = 'Bonjour, <br><br>Cliquez sur le lien suivant pour réinitialiser votre mot de passe : <a href="http://localhost/projet/front/frontoffice/reset.php?token=' . $token . '">Réinitialiser mon mot de passe</a><br><br>Cordialement,<br>Virtuart';

            $mail->send();


//////////////////////////////////////////////used token = 0 //////////////////
  $sql = "UPDATE compte SET  used_token =:used_token WHERE mail = :mail";
  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(":mail", $mailAddress);
  $used_token=0;
	$stmt->bindParam(":used_token", $used_token);
  $stmt->execute();
  $stmt->closeCursor();
//////////////////////////////////////////////////////////////////////////////

            $message = "Mail de réinitialisation envoyé";
        } catch (Exception $e) {
            $message = "Une erreur s'est produite lors de l'envoi de l'e-mail : " . $mail->ErrorInfo;
        }
    } else {
        $message = "Cette adresse e-mail n'existe pas";
    }
}
?>






<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Réinitialisation du mot de passe</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="style.css" />
  
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
  <a href="login.php" class="logo"><i class="fas fa-seedling"></i>Virtuart</a>
  <ul class="menu">
    <li><a href="login.php">Acceuil</a></li>

    <li><a href="login.php"><img src="images/1.png" alt="compte" width="5%"></a></li>
    <li><a href="login.php">login</a></li>
</ul>


   <div class="toggle_menu"></div>
  </header>


    <section id="reset-password">
      <img class="wave" src="images/emna.jpg" />
      <div class="container">
        <div class="img">
          <img src="images/bg.svg" />
        </div>
        <div class="login-content">


          <form method="post" action="#">
  <img src="images/avatar.svg" />
  <h2 class="title">Réinitialisation du mot de passe</h2>
  <div class="input-div one">
    <div class="i">
      <i class="fas fa-envelope"></i>
    </div>
    <div class="div">
    <h5 id="label1">Adresse email</h5>
			  <input type="email" id="mail" name="mail" required class="input" oninput="hideLabel1()">
    </div>
  </div>
  <span style="color: red; display: block; margin-top: -20px;">  <?php if(isset($message)) { echo "<p>$message</p>"; } ?> </span>

  <!-- recaptcha -->
  <div class="g-recaptcha" data-sitekey="6LcQnLAlAAAAAMnpSB2CUpeYuHc9ZWAsAwx-l3bj" data-callback="enableBtn"></div>
		    <br>
			<!-- recaptcha -->

  <input type="submit" class="btn" value="Envoyer" id="submitBtn" disabled style=" background: linear-gradient(to right, #ccc, #ccc);">
</form>




        </div>
      </div>
    </section>
    <script type="text/javascript" src="js/main.js"></script>
  </body>
</html>

<script>
    
	function hideLabel1() {
        document.getElementById("label1").style.display = "none";
    }


</script>