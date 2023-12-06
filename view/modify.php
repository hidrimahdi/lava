<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'C:/xampp/htdocs/Project/Dashbord/Controller/produitC.php';
require_once 'C:/xampp/htdocs/Project/Dashbord/Model/produit.php';


$produitC = new produitC();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $produit = $produitC->recupererProduit($id);



if (isset($_POST['update'])) {
    // Mettre à jour les détails du produit avec les nouvelles valeurs
    $produit->setTitle($_POST['title']);
    $produit->setDescription($_POST['description']);
    $produit->setPrice($_POST['price']);

    $uploadOk = 1;
    $targetDirectory = "./images/";
    // Gestion de la nouvelle image
    if (isset($_FILES['new_image']) && $_FILES['new_image']['size'] > 0) {
        $targetFile = $targetDirectory . basename($_FILES['new_image']['name']);

        if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES['new_image']['tmp_name'], $targetFile)) {
                echo "Le fichier " . htmlspecialchars(basename($_FILES['new_image']['name'])) . " a été téléchargé.";

                $ancienCheminImage = $produit->getImage(); // Récupérer le chemin de l'ancienne image
                $produit->setImage($targetFile); // Mettre à jour le chemin de l'image dans l'objet produit

                // Supprimer l'ancienne image du serveur si elle existe
                if (file_exists($ancienCheminImage)) {
                    unlink($ancienCheminImage);
                }

                // Mettre à jour le produit dans la base de données avec le nouveau chemin de l'image
                $produitC->modifierCheminImage($id, $targetFile);
                $produitC->modifierProduit($produit, $id); // Mettre à jour le produit dans la base de données
                // Redirection vers la page de liste des produits après la mise à jour
                header('Location: tableRec.php');
                exit();
            } else {
                echo "Désolé, une erreur s'est produite lors du téléchargement du fichier.";
            }
        }
    }
}
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

<?php
// Check if 'id' is set in the URL parameters
if (isset($_GET['id']) && isset($produit)) {
?>
<div class="site-wrap">

    <!-- Navigation Bar -->
    <div class="site-navbar py-2">
        <div class="search-wrap">
            <div class="container">
                <a href="#" class="search-close js-search-close"><span class="icon-close2"></span></a>
                <!-- Add the form directly inside the navigation bar -->
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
                            <li><a href="store.php">Store</a></li>
                            <li><a href="http://localhost/Project/Dashbord/View/tableRec.php">My Products</a></li>
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

    <!-- Breadcrumb -->
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

    <!-- Section de mise à jour du produit -->
    <div class="site-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="h3 mb-5 text-black">Update Product</h2>
                    </div>
                    <div class="col-md-12">
                    <form id="form" name="form" method="post" enctype="multipart/form-data">
                            <div class="p-3 p-lg-5 border">
                                <!-- Autres champs du formulaire -->
                                <!-- Title -->
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="title" class="text-black">Title <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="title" id="title" value="<?php echo $produit->getTitle(); ?>">
                                    </div>
                                </div>
                                <!-- Description -->
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label for="description" class="text-black">Description <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="description" name="description" value="<?php echo $produit->getDescription(); ?>">
                                    </div>
                                </div>
                                
                <!-- Price -->
                <div class="form-group row">
                    <div class="col-md-12">
                        <label for="price" class="text-black">Price <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="price" name="price" value="<?php echo htmlspecialchars($produit->getPrice()); ?>">
                    </div>
                </div>
                <!-- New Image -->
                <div class="form-group row">
    <div class="col-md-12">
        <label class="text-black">Current Image</label>
        <?php
        // Récupérer le chemin de l'image actuelle depuis l'objet produit
        $ancienneImage = $produit->getImage();

        // Vérifier si une image existe
        if (!empty($ancienneImage)) {
            // Afficher l'image actuelle
            echo '<img src="' . $ancienneImage . '" alt="Current Image" class="img-fluid">';
            // Bouton pour modifier l'image
            echo '<div>';
            echo '<label for="new_image" class="text-black">Change Image</label>';
            echo '<input type="file" class="form-control" id="new_image" name="new_image">';
            echo '</div>';
        } else {
            echo '<p>No image available</p>';
        }
        ?>
    </div>
</div>
                <!-- Submit Button -->
                <div class="form-group row">
    <div class="col-lg-12">
        <input type="submit" class="btn btn-primary btn-lg btn-block" name="update" value="Update">
    </div>
</div>
        </form>
    </div>
                </div>
            </div>
        </div>

    <!-- Offices Section -->
    <div class="site-section bg-primary">
        <div class="container">
            <div class="row">
                <!-- Offices Content -->
            </div>
        </div>
    </div>

    <!-- Footer Section -->
    <footer class="site-footer">
        <div class="container">
            <div class="row">
                <!-- Footer Content -->
            </div>
        </div>
    </footer>

</div>

<!-- Script Includes -->
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/jquery.magnific-popup.min.js"></script>
<script src="js/aos.js"></script>
<script src="js/main.js"></script>

<?php
}
?>

</body>

</html>
