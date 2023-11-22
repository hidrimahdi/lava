<?php
	include 'C:/xampp/htdocs/Project/Dashbord/Controller/produitC.php';
  	include_once 'C:/xampp/htdocs/Project/Dashbord/Model/produit.php';


	$produitC = new produitC();
	$error = "";
	
	if (
        isset($_POST["title"]) &&
        isset($_POST["description"]) &&
        isset($_POST["category"]) &&
        isset($_POST["price"]) 
        
    ) {
        if (
          !empty($_POST["title"]) &&
          !empty($_POST["description"]) &&
          !empty($_POST["category"]) &&
          !empty($_POST["price"]) 
            
        )
         {
            $produit = new produit(
              $_POST["title"],
              $_POST["description"],
              $_POST["category"],
              $_POST["price"]
            );
			
            $produitC->modifierProduit($produit, $_GET['id']);
            header ('Location:../View/tableRec.php');
        }
        else
        $error = "Missing information";
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
if (isset($_GET['id'])) {
    // Assuming $reclamationC is an instance of your ReclamationC class
    $produit = $produitC->recupererProduit($_GET['id']);
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
                            <li><a href="shop.html">Store</a></li>
                            <li><a href="about.html">About</a></li>
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

    <!-- Reclamation Form Section -->
    <div class="site-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="h3 mb-5 text-black">Update Product</h2>
                </div>
                <div class="col-md-12">

                    <!-- Update Reclamation Form -->
                    <form id="form" name="form" method="post">
                        <div class="p-3 p-lg-5 border">
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="c_fname" class="text-black">title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="title" id="title"
                                        value="<?PHP echo $produit['title']; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="c_email" class="text-black">Description <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="description" name="description"
                                        value="<?PHP echo $produit['description']; ?>" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="c_message" class="text-black">category <span
                                            class="text-danger">*</span></label>
                                    <!-- Place the value inside the textarea tag -->
                                    <textarea name="category" id="category" cols="30" rows="7"
                                        class="form-control"><?PHP echo $produit['category']; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="c_message" class="text-black">price <span
                                            class="text-danger">*</span></label>
                                    <!-- Place the value inside the textarea tag -->
                                    <textarea name="price" id="price" cols="30" rows="7"
                                        class="form-control"><?PHP echo $produit['price']; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <input type="submit" class="btn btn-primary btn-lg btn-block" value="Update">
                                </div>
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
