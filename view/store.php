<?php
include_once("C:/xampp/htdocs/Project/config.php");

// Récupération des produits depuis la base de données
$conn = (new config())->getConnexion();

// Initialisation de la variable $products
$products = array();

// Si une recherche est effectuée
if (isset($_GET['search']) && !empty($_GET['search'])) {
  $search = $_GET['search'];

  // Requête SQL pour filtrer les produits par titre
  $stmt = $conn->prepare("SELECT * FROM produit WHERE title LIKE :search");
  $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
  $stmt->execute();
  $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
  // Si aucune recherche, récupérer tous les produits
  $stmt = $conn->prepare("SELECT * FROM produit");
  $stmt->execute();
  $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
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
              <a href="index.html" class="js-logo-clone">Virtuart</a>
            </div>
          </div>
          <div class="main-nav d-none d-lg-block">
            <nav class="site-navigation text-right text-md-center" role="navigation">
              <ul class="site-menu js-clone-nav d-none d-lg-block">
                <li><a href="index.html">Home</a></li>
                <li class="active"><a href="store.html">Store</a></li>
              
                <li><a href="http://localhost/Project/Dashbord/View/tableRec.php">My Products</a></li>
                <li class=""><a href="http://localhost/Project/Dashbord/View/addCommande.php">Commande</a></li>
                <li class=""><a href="http://localhost/Project/Dashbord/View/add.php">Product</a></li>
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
            <strong class="text-black">Store</strong>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h2 class="h3 mb-5 text-black"> Store</h2>
            <form method="GET" action="store.php">
            <div class="form-group">
              <input type="text" class="form-control" name="search" placeholder="Search by title">
              <input type="submit" value="Search" class="btn btn-primary mt-2">
            </div>
          </form>
            
            <body>

            <div class="container">
        <h1>Produits</h1>
        <div class="row">
            <?php foreach ($products as $product) : ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                    <?php 
            $imagePath = $product['image'];
            // Vérifier le chemin de l'image pour déboguer

            ?>
            <img src="<?php echo $product['image']; ?>" class="card-img-top" alt="Image du Produit">
                        
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $product['title']; ?></h5>
                            <p class="card-text"><?php echo $product['description']; ?></p>
                            <p class="card-text">
                            Catégorie: 
                            <?php 
                                $categoryId = $product['idCad'];
                                $stmt = $conn->prepare("SELECT nomCad FROM category WHERE idCad = :categoryId");
                                $stmt->bindParam(':categoryId', $categoryId);
                                $stmt->execute();
                                $category = $stmt->fetch(PDO::FETCH_ASSOC);
                                echo $category['nomCad'];
                            ?>
                        </p>
                            <p class="card-text">Prix: <?php echo $product['price']; ?></p>
                            <a href="#" class="btn btn-primary">Ajouter au Panier</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

<!-- ... Vos liens vers les fichiers JavaScript, Bootstrap, etc. ... -->

</body>
</div>
<br>
<table id="myTable" class="table table-striped" >
    
<style>
    #myTable {
        background-color: #f2f2f2; /* Gray background color */
        color: black; /* Black text color */
    }

    #myTable th,
    #myTable td {
        border: 1px solid #ddd; /* Add a border to the table cells */
        padding: 8px; /* Add padding to the table cells */
    }

    #myTable th {
        background-color: #333; /* Dark gray background color for table headers */
        color: white; /* White text color for table headers */
    }
</style>

      
                </tbody>
            </table>
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
              <li><a href="#">peinture</a></li>
              <li><a href="#">impression numerique</a></li>
              <li><a href="#">poster &amp; tableau</a></li>
              <li><a href="#">portrait &amp; paysage</a></li>
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