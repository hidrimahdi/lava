<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'c:/xampp/htdocs/Project/Dashbord/PHPMailer-master/PHPMailer-master/src/Exception.php';
require 'c:/xampp/htdocs/Project/Dashbord/PHPMailer-master/PHPMailer-master/src/PHPMailer.php';
require 'c:/xampp/htdocs/Project/Dashbord/PHPMailer-master/PHPMailer-master/src/SMTP.php';
require_once 'C:/xampp/htdocs/Project/Dashbord/Controller/produitC.php';
require_once 'C:/xampp/htdocs/Project/Dashbord/Model/produit.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$config = new config(); // Instance de votre classe de configuration
$conn = $config->getConnexion(); // Obtenez la connexion à la base de données

$error = "";
$produitC = new produitC();

// Récupérer les catégories depuis la base de données
$query = "SELECT idcad, nomcad FROM category";
$result = $conn->query($query);

// Générer les options pour la liste déroulante des catégories
$options = '';
if ($result->rowCount() > 0) {
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $idcad = $row['idcad'];
        $nomcad = $row['nomcad'];
        $options .= "<option value='$idcad'>$nomcad</option>";
    }
} else {
    $options = '<option value="">Aucune catégorie trouvée</option>';
}

// Gestion de l'ajout de produit
if (
    isset($_POST["title"]) &&
    isset($_POST["description"]) &&
    isset($_POST["idcad"]) &&
    isset($_POST["price"]) &&
    isset($_FILES["image"]) &&
    !empty($_FILES["image"]["name"])
) {
    $targetDirectory = "./images/";
    $imageFileName = basename($_FILES["image"]["name"]);
    $targetFilePath = $targetDirectory . $imageFileName;

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
        $produit = new produit(
            $_POST["title"],
            $_POST["description"],
            $_POST["idcad"],
            $_POST["price"],
            $targetFilePath
        );

        $produitC->ajouterProduit($produit);
        $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'mohamedfourat.rebai@esprit.tn';                 // SMTP username
        $mail->Password = '191JMT2662';                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to

        //Recipients
        $mail->setFrom('mohamedfourat.rebai@esprit.tn', 'mohamed Fourat Rebai');
        $mail->addAddress('fouratrebaipro@gmail.com');     // Add a recipient

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'New Product will be added when approbation by admin done';
        $mail->Body = 'A new product has been added to the system.';

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
        header('Location: tableRec.php');
    } else {
        $error = "Failed to upload image.";
    }
}

// Code HTML du formulaire avec la liste déroulante des catégories
?>

<!DOCTYPE html>
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
              <a href="#" class="js-logo-clone">Virtuart</a>
            </div>
          </div>
          <div class="main-nav d-none d-lg-block">
            <nav class="site-navigation text-right text-md-center" role="navigation">
              <ul class="site-menu js-clone-nav d-none d-lg-block">
                <li><a href="index.html">Home</a></li>
                <li><a href="store.php">Store</a></li>
              
                <li><a href="http://localhost/Project/Dashbord/View/tableRec.php">My products</a></li>

                <li class=""><a href="http://localhost/Project/Dashbord/View/addCommande.php">Commande</a></li>
                <li class="active"><a href="http://localhost/Project/Dashbord/View/add.php">Product</a></li>


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
            <a href="index.html">Home</a> <span class="mx-2 mb-0">/</span>
            <strong class="text-black">Products</strong>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h2 class="h3 mb-5 text-black">Add Product</h2>
          </div>
          <div class="col-md-12">
    
            <form id="form" name="form" action="#" method="post" enctype="multipart/form-data">
    
              <div class="p-3 p-lg-5 border">
                <div class="form-group row">
                  <div class="col-md-6">
                    <label for="title" class="text-black"> title <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="title" id="title">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="description" class="text-black">description <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="description" name="description" placeholder="">
                  </div>
                </div>
              
    
                <div class="form-group row">
    <div class="col-md-12">
        <label for="idcad" class="text-black">Category <span class="text-danger">*</span></label>
        <select name="idcad" id="idcad" class="form-control">
    <?php echo $options; // Affiche les options générées dynamiquement ?>
</select>
    </div>
</div>
                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="price" class="text-black">price  <span class="text-danger">*</span></label>
                    <textarea name="price" id="price" cols="30" rows="7" class="form-control"></textarea>
                  </div>
                </div>
                <div class="form-group row">
    <div class="col-md-12">
      <label for="image" class="text-black">Image <span class="text-danger">*</span></label>
      <input type="file" class="form-control" id="image" name="image">
    </div>
  </div>
                <div class="form-group row">
                  <div class="col-lg-12">
                    <input type="submit" class="btn btn-primary btn-lg btn-block" value="Add Product">
                  </div>
                </div>
              </div>
            </form>
          </div>
          
        </div>
      </div>
    </div>



    <div class="site-section bg-primary">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <h2 class="text-white mb-4">Offices</h2>
          </div>
          <div class="col-lg-4">
            <div class="p-4 bg-white mb-3 rounded">
              <span class="d-block text-black h6 text-uppercase">New York</span>
              <p class="mb-0">203 Fake St. Mountain View, San Francisco, California, USA</p>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="p-4 bg-white mb-3 rounded">
              <span class="d-block text-black h6 text-uppercase">London</span>
              <p class="mb-0">203 Fake St. Mountain View, San Francisco, California, USA</p>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="p-4 bg-white mb-3 rounded">
              <span class="d-block text-black h6 text-uppercase">Canada</span>
              <p class="mb-0">203 Fake St. Mountain View, San Francisco, California, USA</p>
            </div>
          </div>
        </div>
      </div>
      
    </div>


    <footer class="site-footer">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-lg-3 mb-4 mb-lg-0">

            <div class="block-7">
              <h3 class="footer-heading mb-4">About Us</h3>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius quae reiciendis distinctio voluptates
                sed dolorum excepturi iure eaque, aut unde.</p>
            </div>

          </div>
          <div class="col-lg-3 mx-auto mb-5 mb-lg-0">
            <h3 class="footer-heading mb-4">Quick Links</h3>
            <ul class="list-unstyled">
              <li><a href="#">Supplements</a></li>
              <li><a href="#">Vitamins</a></li>
              <li><a href="#">Diet &amp; Nutrition</a></li>
              <li><a href="#">Tea &amp; Coffee</a></li>
            </ul>
          </div>

          <div class="col-md-6 col-lg-3">
            <div class="block-5 mb-5">
              <h3 class="footer-heading mb-4">Contact Info</h3>
              <ul class="list-unstyled">
                <li class="address">203 Fake St. Mountain View, San Francisco, California, USA</li>
                <li class="phone"><a href="tel://23923929210">+2 392 3929 210</a></li>
                <li class="email">emailaddress@domain.com</li>
              </ul>
            </div>


          </div>
        </div>
        <div class="row pt-5 mt-5 text-center">
          <div class="col-md-12">
            <p>
              <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
              Copyright &copy;
              <script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made
              with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank"
                class="text-primary">Colorlib</a>
              <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            </p>
          </div>

        </div>
      </div>
    </footer>
  </div>

  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>

  <script src="js/main.js"></script>

</body>

</html>