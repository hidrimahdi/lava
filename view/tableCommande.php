<?PHP
	include ("C:/xampp/htdocs/Project/Dashbord/Controller/commandeC.php");

	$commandeC=new commandeC();
	$listeCommande=$commandeC->afficherCommande();

if(isset($_POST['submit']))
{
    $listeCommande=$commandeC->afficherCommande();
}

if(isset($_POST['ajout']))
{
    header ('Location:../addCommande.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Virtuart<</title>
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
                <li><a href="shop.html">Store</a></li>
              
                <li><a href="about.html">About</a></li>
                <li class="active"><a href="http://localhost/Project/Dashbord/View/addCommande.php">Commande</a></li>
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
            <a href="#">Home</a> <span class="mx-2 mb-0">/</span>
            <strong class="text-black">Commandes</strong>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h2 class="h3 mb-5 text-black">Commandes</h2>
          </div>
                  <a href="addCommande.php">
                    <button type="ajout" name="actualiser" value="Ajouter" class="btn btn-primary btn-lg btn-block">
                        add Command
                    </button>
                </a>
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

                <thead>
                    <th><FONT COLOR="WHITE">ID</FONT></th>
                    <th><FONT COLOR="WHITE">name</FONT></th>
                    <th><FONT COLOR="WHITE">adress</FONT></th>
                    <th><FONT COLOR="WHITE">phone Number</FONT></th>
                    <th><FONT COLOR="WHITE">idProduct</FONT></th>

                    <th><FONT COLOR="WHITE"></FONT></th>
                    <th><FONT COLOR="WHITE"></FONT></th>
                </thead>
                <tbody>
                    <?PHP
				        foreach($listeCommande as $commande){
			        ?>
                    <tr>
                        <td class="align-img">
                            <FONT COLOR="BLACK"><?PHP echo $commande['id']; ?></FONT>
                        </td>
                        <td class="align-img">
                            <FONT COLOR="BLACK"><?PHP echo $commande['nom']; ?></FONT>
                        </td>
                        <td class="align-img">
                            <FONT COLOR="BLACK"><?PHP echo $commande['adresse']; ?></FONT>
                        </td>
                      
                        <td class="align-img">
                            <FONT COLOR="BLACK"><?PHP echo $commande['num']; ?></FONT>
                        </td>
                        <td class="align-img">
                            <FONT COLOR="BLACK"><?PHP echo $commande['idProduit']; ?></FONT>
                        </td>
                        
                        <td>
                            <div class="form-group">
                                <form method="POST" action="deleteCommande.php">
                                    <input type="submit" name="Supprimer" value="Delete" class="btn btn-primary">
                                    <input type="hidden" value=<?PHP echo $commande['id']; ?> name="id">
                                </form>
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <a href="modifyCommand.php?id=<?PHP echo $commande['id']; ?>">
                                    <input type="submit" value="Modify" class="btn btn-primary">
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?PHP
				        }
			        ?>
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