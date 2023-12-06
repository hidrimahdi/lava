<?php
    require_once '../Controller/UtilisateurC.php';
	require_once '../Entities/Utilisateur.php';
	 
    session_start();
    
	$utilisateurC =  new UtilisateurC();
	$listeutilisateur = $utilisateurC->afficherUtilisateurs();


	$message = "";

$v1=0 ;
$v2=0 ;
$v3=0 ;


	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		$pdo = config::getConnexion();



		// Récupérer les valeurs saisies par l'utilisateur
		$id = $_POST["id"];
		$nom = $_POST["nom"];
		$prenom = $_POST["prenom"];
		$mail = $_POST["mail"];
		$role = $_POST["role"];
		$mp = $_POST["mp"];
	  
		// Vérifier si l'adresse e-mail est déjà utilisée
		$query = "SELECT * FROM compte WHERE mail = ?";
		$stmt = $pdo->prepare($query);
		$stmt->execute([$mail]);
		$result = $stmt->fetch();
		if ($result) {
		  $message1 = "Cette adresse e-mail est déjà utilisée.";
		}
		else { $v1=1 ;}

		// Vérifier si l'id est déjà utilisée
		$query = "SELECT * FROM compte WHERE id = ?";
		$stmt = $pdo->prepare($query);
		$stmt->execute([$id]);
		$result = $stmt->fetch();
		if ($result) {
		  $message3 = "Cet id est déjà utilisé.";
		}
		else { $v3=1 ;}

		
	  
	
	  
			  // Vérifier si le mot de passe contient au moins une lettre majuscule et un caractère spécial
			  if (!preg_match('/[A-Z]/', $mp) || !preg_match('/[\W]/', $mp)) {
				  $message2 = "Le mot de passe doit contenir au moins une lettre majuscule et un caractère spécial.";
			  } 
			  else
			{$v2=1;}
	  
				if (  $v1==1 && $v2==1 && $v3==1)
				{
				  // Trouver le nouvel identifiant
				  $query = "SELECT MAX(id) as max_id FROM compte";
				  $stmt = $pdo->query($query);
				  $row = $stmt->fetch();
				  $new_id = $row["max_id"] + 1;
	  
	  // Insérer les données dans la table "compte"

	  $utilisateur = new Utilisateur($_POST['id'] , $_POST['nom'], $_POST['prenom'], $_POST['role'], $_POST['mail'], $_POST['mp'] );

	  $utilisateurC =  new UtilisateurC();
	  $utilisateurC->ajouterUtilisateur($utilisateur);
				


	  header('Location: ajouteradmine.php');
	  echo "Inscription réussie !";
	  
				}
				echo "Inscription echouée !";
			  
	  
	  
	  
			  }
	  ?>




	
    



<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Web UI Kit &amp; Dashboard Template based on Bootstrap">
    <meta name="author" content="AdminKit">
    <meta name="keywords" content="adminkit, bootstrap, web ui kit, dashboard template, admin template">

    <link rel="shortcut icon" href="img/icons/icon-48x48.png" />

    <title>Tables | AdminKit Demo</title>

    <link href="css/app.css" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
    <nav id="sidebar" class="sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="index.php">
          <span class="align-middle">virturat Admin</span>
        </a>

				<ul class="sidebar-nav">
					<li class="sidebar-header">
						
					</li>


					<li class="sidebar-item active ">
						<a class="sidebar-link" href="ajouteradmine.php">
              <i class="align-middle" data-feather="user"></i> <span class="align-middle"> Gestion Admins </span>
            </a>

			<li class="sidebar-item " >
						<a href="#ui1" data-toggle="collapse" class="sidebar-link">
                        <i class="align-middle" data-feather="users"></i> <span class="align-middle"> Gestion des clients</span>
            </a>
            <ul id="ui1" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
							<li class="sidebar-item "><a class="sidebar-link" href="afficherclient.php">La liste des Clients : </a></li>
							<li class="sidebar-item "><a class="sidebar-link" href="ajouterclient.php">Ajouter des clients</a></li>
						</ul>

					</li>
						






					


           

					
                    
                   		

				
			</div>
		</nav>

		<div class="main">
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle d-flex">
          <i class="hamburger align-self-center"></i>
        </a>

				

				<div class="navbar-collapse collapse">
					<ul class="navbar-nav navbar-align">
						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown" data-toggle="dropdown">
								
						
						</li>
						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle" href="#" id="messagesDropdown" data-toggle="dropdown">
								
							</a>
							<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right py-0" aria-labelledby="messagesDropdown">
								<div class="dropdown-menu-header">
									
								</div>
								<div class="list-group">
									<a href="#" class="list-group-item">
										<div class="row no-gutters align-items-center">
											<div class="col-2">
												<img src="img/avatars/avatar-5.jpg" class="avatar img-fluid rounded-circle" alt="Vanessa Tucker">
											</div>
											
										</div>
									</a>
									
									</a>
									<a href="#" class="list-group-item">
										<div class="row no-gutters align-items-center">
											
											
										</div>
									</a>
									
								</div>
								<div class="dropdown-menu-footer">
									
								</div>
							</div>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-toggle="dropdown">
                <i class="align-middle" data-feather="settings"></i>
              </a>

<!-- mail et image efface -->
							<div class="dropdown-menu dropdown-menu-right">
								<a class="dropdown-item" href="deconnexion.php">Log out</a>
							</div>
						</li>
					</ul>
				</div>
			</nav>
			</main>
			<main class="content">
            
			<div class="container-fluid p-0">

				<h1 class="h3 mb-3">Ajouter un Admin </h1>

				<div class="row">
					
							
					   <div class="col-12 col-xl-6">
						<div class="card">
							<div class="card-header">
						
							</div>
							<div class="card-body">
								<form  method="POST" >
									<div class="form-group row">
										<label class="col-form-label col-sm-2 text-sm-right">id</label>
										<div class="col-sm-10">
											<input type="text" id="id" name="id" class="form-control" placeholder="text">
											<span style="color: red; display: block; margin-top: 20px;">  <?php if(isset($message3)) { echo "<p>$message3</p>"; } ?> </span>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-form-label col-sm-2 text-sm-right">Nom</label>
										<div class="col-sm-10">
											<input type="text" id="nom" name="nom" class="form-control" placeholder="text">
											
										</div>
									</div>
									<div class="form-group row">
										<label class="col-form-label col-sm-2 text-sm-right">Prenom</label>
										<div class="col-sm-10">
											<input type="text" id="prenom" name="prenom" class="form-control" placeholder="text">
											
										</div>
									</div>
									<div class="form-group row">
										<label class="col-form-label col-sm-2 text-sm-right">Role</label>
										<div class="col-sm-10">
											<input type="text" id="role" name="role"class="form-control" placeholder="text">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-form-label col-sm-2 text-sm-right">mail</label>
										<div class="col-sm-10">
											<input type="text" id="mail" name="mail"class="form-control" placeholder="text">
											<span style="color: red; display: block; margin-top: 20px;">  <?php if(isset($message1)) { echo "<p>$message1</p>"; } ?> </span>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-form-label col-sm-2 text-sm-right">mot de passe</label>
										<div class="col-sm-10">
											<input type="password" id="mp" name="mp"class="form-control" placeholder="text">
											<span style="color: red; display: block; margin-top: 20px;">  <?php if(isset($message2)) { echo "<p>$message2</p>"; } ?> </span>
										</div>
									</div>

								
									<div class="form-group row">
										<div class="col-sm-10 ml-sm-auto">
											<button type="submit" class="btn btn-primary">ajouter</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
        <main class="content">
                <div class="container-fluid p-0">

                    <h1 class="h3 mb-3">La liste des Admins : </h1>

                    <div class="row">
					<div class="col-12 col-xl-6">
                            <div class="card">
                                
                            <table class="table" border=1 align = 'center'>
            <tr>
			    <th>id</th>
                <th>nom</th>
                <th>prenom</th>
                <th>role</th>
                <th>mail</th>
                <!-- <th>image</th> -->
                <th>supprimer</th>
				<th>modifier</th>
                
            </tr>

            <?PHP
                foreach($listeutilisateur as $utilisateurC){
            ?>
                <tr>
				    <td><?PHP echo $utilisateurC['id']; ?></td>
                    <td><?PHP echo $utilisateurC['nom']; ?></td>
                    <td><?PHP echo $utilisateurC['prenom']; ?></td>
                    <td><?PHP echo $utilisateurC['role']; ?></td>
                    <td><?PHP echo $utilisateurC['mail']; ?></td>
                    <!-- <td><?PHP echo $utilisateurC['image']; ?></td> -->
                    <td>
                        <form method="POST" action="supprimeradmine.php">
                        <input type="submit" name="supprimer" value="supprimer">
                        <input type="hidden" value=<?PHP echo $utilisateurC['id']; ?> name="id">
                        </form>
                    </td>
<td>
					<a href="modifieradmin.php?id=<?= $utilisateurC['id'] ?>"><i class="align-middle" data-feather="edit-2"></i></a>

					</td>
					
				</tr>
                    
            <?PHP
                }
            ?>
        </table>
                            </div>
                        </div>

             
        </div>
    </div>
    </main>

    <script src="js/vendor.js"></script>
    <script src="js/app.js"></script>

</body>

</html>