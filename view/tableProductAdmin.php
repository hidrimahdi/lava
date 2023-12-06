<?PHP
// Inclusion des fichiers et initialisation des données
require 'c:/xampp/htdocs/Project/Dashbord/PHPMailer-master/PHPMailer-master/src/Exception.php';
require 'c:/xampp/htdocs/Project/Dashbord/PHPMailer-master/PHPMailer-master/src/PHPMailer.php';
require 'c:/xampp/htdocs/Project/Dashbord/PHPMailer-master/PHPMailer-master/src/SMTP.php';
include_once ("C:/xampp/htdocs/Project/config.php");
require ("C:/xampp/htdocs/Project/Dashbord/Controller/produitC.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$config = new config();
$conn = $config->getConnexion();

$produit = new produitC();
$listeProduit = $produit->afficherProduit();



if (isset($_POST['submit'])) {
    $listeProduit = $produit->afficherProduit();
}

if (isset($_POST['ajout'])) {
    header('Location:../reclamation/add.php');
}

// Filtrage par catégorie
if (isset($_POST['filterByCategory'])) {
    $categoryFilter = $_POST['categoryFilter'];
    if ($categoryFilter != 'all') {
        $listeProduit = $produit->filterByCategory($categoryFilter, $conn);
    } else {
        $listeProduit = $produit->afficherProduit();
    }
}

// Filtrage par prix
if (isset($_POST['filterByPrice'])) {
    $minPrice = $_POST['minPrice'];
    $maxPrice = $_POST['maxPrice'];

    if (!empty($minPrice) || !empty($maxPrice)) {
        $listeProduit = $produit->filterByPriceRange($minPrice, $maxPrice, $conn);
    } else {
        // Gérer le cas où aucun prix n'est renseigné
        // Par exemple, afficher tous les produits
        $listeProduit = $produit->afficherProduit();
    }
}

if (isset($_POST['confirmButton'])) {
    $confirmProductId = $_POST['confirmProductId'];
    // Mettez à jour le statut du produit dans la base de données
    // ... code pour mettre à jour la confirmation dans la base de données ...

    try {
        // Envoi de l'e-mail de confirmation
        $mail = new PHPMailer(true);

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
        $mail->Subject = 'product added succefully';
        $mail->Body = 'A new product has been added to the system.';

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

} else {
    $error = "Failed to upload image.";
}
if (isset($_POST['addCategoryButton'])) {

    $newCategory = $_POST['newCategory'];
    $newIdCad = $_POST['idCad'];
    $newNomCad = $_POST['nomCad'];

    // Requête SQL d'insertion avec une requête préparée
    $query = "INSERT INTO category (idCad, nomCad) VALUES (:idCad, :nomCad)";
    
    // Préparation de la requête
    $stmt = $conn->prepare($query);
    
    // Liaison des valeurs
    $stmt->bindParam(':idCad', $newIdCad);
    $stmt->bindParam(':nomCad', $newNomCad);
    
    // Exécution de la requête
    if ($stmt->execute()) {
        // La catégorie a été ajoutée avec succès
        echo "Nouvelle catégorie ajoutée avec succès.";
    } else {
        // Erreur lors de l'ajout de la catégorie
        echo "Erreur lors de l'ajout de la catégorie.";
    }
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Admin</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="admin/img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet"> 
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="admin/darkpan-1.0.0/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="admin/darkpan-1.0.0/css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-secondary navbar-dark">
                <a href="index.html" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>Commands</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="./images/user.jpg" alt="" style="width: 50px; height: 50px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">Fourat Rebai</h6>
                        <span>Admin</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <div class="nav-item dropdown">
                    </div>
                    <a href="http://localhost/Project/Dashbord/View/tableProductAdmin.php" class="nav-item nav-link  active "><i class="fa fa-table me-2"></i>Products</a>
                        <a href="http://localhost/Project/Dashbord/View/tableAdminCommand.php" class="nav-item nav-link "><i class="fa fa-table me-2"></i>Commands</a>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
                <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-user-edit"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <div class="navbar-nav align-items-center ms-auto">
                </div>
            </nav>
            <!-- Navbar End -->

<!-- Ajout du formulaire de filtrage -->
<form method="POST" action="">
    <label for="category">Filter by Category:</label>
    <select name="categoryFilter" id="category">
        <option value="all">All Categories</option>
        <?php
        // Récupérer toutes les catégories depuis la base de données
        $query = "SELECT idCad, nomCad FROM category"; // Assurez-vous que le nom du champ dans la table 'category' est 'nomCad'
        $stmt = $conn->query($query);

        // Afficher chaque catégorie comme une option dans le menu déroulant
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $idCad = $row['idCad'];
            $nomCad = $row['nomCad'];
            echo "<option value='$idCad'>$nomCad</option>";
        }
        ?>
    </select>
    <input type="submit" name="filterByCategory" value="Filter">
</form>

<form method="POST" action="">
    <label for="minPrice">Min Price:</label>
    <input type="number" name="minPrice" id="minPrice">
    <label for="maxPrice">Max Price:</label>
    <input type="number" name="maxPrice" id="maxPrice">
    <input type="submit" name="filterByPrice" value="Filter">
</form>

            <!-- Table Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-6">
                            <div class="col-sm-12 col-xl-6">
                                <h6 class="mb-4">List of Products</h6>
                                <table id="myTable" class="table table-striped" >  
                <thead>
                    <th><FONT COLOR="WHITE">ID</FONT></th>
                    <th><FONT COLOR="WHITE">Title</FONT></th>
                    <th><FONT COLOR="WHITE">Description</FONT></th>
                    <th><FONT COLOR="WHITE">Category</FONT></th>
                    <th><FONT COLOR="WHITE">Price</FONT></th>
                    <th><FONT COLOR="WHITE"></FONT></th>
                </thead>
                <tbody>
                    <?PHP
				        foreach($listeProduit as $produit){
			        ?>
                    <tr>
                        <td class="align-img">
                            <FONT COLOR="WHITE"><?PHP echo $produit['id']; ?></FONT>
                        </td>
                        <td class="align-img">
                            <FONT COLOR="WHITE"><?PHP echo $produit['title']; ?></FONT>
                        </td>
                        <td class="align-img">
                            <FONT COLOR="WHITE"><?PHP echo $produit['description']; ?></FONT>
                        </td>
                        <td class="align-img">
                        <?php
    // Récupérer le nom de la catégorie en fonction de l'idcad du produit
    if (isset($produit['idCad'])) { // Vérifiez si le champ ID de catégorie dans le produit est bien 'idCad'
        $idCad = $produit['idCad'];
        $query = "SELECT nomCad FROM category WHERE idCad = :idCad"; // Assurez-vous que le nom du champ dans la table 'category' est 'nomCad'
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':idCad', $idCad);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $nomCad = $row['nomCad'];
            echo "<FONT COLOR='WHITE'>$nomCad</FONT>";
        } else {
            echo "<FONT COLOR='WHITE'>N/A</FONT>";
        }
    } else {
        echo "<FONT COLOR='WHITE'>N/A</FONT>";
    }
    ?>


</td>
                        <td class="align-img">
                            <FONT COLOR="WHITE"><?PHP echo $produit['price']; ?></FONT>
                        </td>
                        <td>
                            <div class="form-group">
                                <form method="POST" action="deleteProductAdmin.php">
                                    <input type="submit" name="Supprimer" value="Supprimer" class="btn btn-primary">
                                    <input type="hidden" value=<?PHP echo $produit['id']; ?> name="id">
                                </form>
                                 <i class="bi bi-trash"></i>
                            </div>
                        </td>
                        <td>
                        <div class="form-group">
    <form method="POST" action="">
        <input type="hidden" value="<?php echo $produit['id']; ?>" name="confirmProductId">
        <button type="submit" name="confirmButton" value="Confirm" class="btn btn-success">Confirm</button>
        <i class="bi bi-check-circle"></i>
    </form>
</div>



                    </tr>
                    <?PHP
				        }
			        ?>
                </tbody>
            </table>
            
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-md-6 col-xl-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Nombre de Tableaux</h5>
                    <?php
                        // Requête SQL pour compter le nombre de tableaux
                        $queryCountProducts = "SELECT COUNT(*) AS total FROM produit";
                        $stmtCountProducts = $conn->query($queryCountProducts);
                        $rowProducts = $stmtCountProducts->fetch(PDO::FETCH_ASSOC);
                        $totalProducts = $rowProducts['total'];
                    ?>
                    <p class="card-text"><strong><FONT COLOR="BLACK">Nombre de Tableaux total</FONT></strong></p>
                    <p class="card-text"><?php echo $totalProducts; ?></p>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-6 col-xl-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Nombre de Catégories</h5>
                    <?php
                        // Requête SQL pour compter le nombre de catégories
                        $queryCountCategories = "SELECT COUNT(*) AS total FROM category";
                        $stmtCountCategories = $conn->query($queryCountCategories);
                        $rowCategories = $stmtCountCategories->fetch(PDO::FETCH_ASSOC);
                        $totalCategories = $rowCategories['total'];
                    ?>
                    <p class="card-text"><strong><FONT COLOR="BLACK">Nombre de Categories au total</FONT></strong></p>
                    <p class="card-text"><?php echo $totalCategories; ?></p>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-6 col-xl-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Somme des Prix</h5>
                    <?php
                        // Requête SQL pour obtenir la somme des prix
                        $queryTotalPrice = "SELECT SUM(price) AS total FROM produit";
                        $stmtTotalPrice = $conn->query($queryTotalPrice);
                        $rowTotalPrice = $stmtTotalPrice->fetch(PDO::FETCH_ASSOC);
                        $totalPrice = $rowTotalPrice['total'];
                    ?>
                    <p class="card-text"><strong><FONT COLOR="BLACK">Chiffre d'affaires</FONT></strong></p>
                    <p class="card-text"><?php echo $totalPrice; ?> €</p>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<form method="POST" action="">
    <label for="newCategory">Add Category id:</label>
    <input type="text" name="idCad" id="idCad">
    <label for="newCategory">Add Category name :</label>
    <input type="text" name="nomCad" id="nomCad">
    <input type="submit" name="addCategoryButton" value="Add">
</form>
            </div>
            <!-- Table End -->
        </div>
        
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="admin/darkpan-1.0.0/js/main.js"></script>
</body>

</html>