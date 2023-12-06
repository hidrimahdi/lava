<?php
    include "../Entities/client.php";
    include "../Controller/clientC.php";
    
    session_start();

    $clientC =  new clientC();
    $listeclient = $clientC->afficherclient();

    $message = "";

    $v1=0 ;
    $v2=0 ;
    $v3=0 ;
    $v4=0 ;
    $v5_1=0 ;
    $v6=0 ;
    $v7=0 ;
    
    
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
        $pdo = config::getConnexion();
    
    
    
        // Récupérer les valeurs saisies par l'utilisateur

        $id = $_POST["id"];
        $sexe = $_POST["Sexe"];
        $nom = $_POST["Nom"];
        $prenom = $_POST["Prenom"];
        $num_tel = $_POST["num_tel"];
        $mail = $_POST["mail"];
        $adresse = $_POST["adresse"];
        $date_anniversaire = $_POST["date_anniversaire"];
        $mp = $_POST["mp"];
        
        // Vérifier si l'id est déjà utilisée
		$query = "SELECT * FROM compte WHERE id = ?";
		$stmt = $pdo->prepare($query);
		$stmt->execute([$id]);
		$result = $stmt->fetch();
		if ($result) {
		  $message1 = "Cet id est déjà utilisé.";
		}
		else { $v1=1 ;}

    //verif sexe

    if($sexe !=="Homme" && $sexe !=="Femme")
    {
      $message2 = "Veuillez choisir ";
    }
    else
    {$v2=1;}


    // Vérifier si le numéro de téléphone contient 8 chiffres
    if (!preg_match('/^\d{8}$/', $num_tel)) {
			$message3 = "Le numéro de téléphone doit être composé de 8 chiffres.";
		}
		  else
		  {$v3=1;}

      // Vérifier si l'adresse e-mail est déjà utilisée
		$query = "SELECT * FROM compte WHERE mail = ?";
		$stmt = $pdo->prepare($query);
		$stmt->execute([$mail]);
		$result = $stmt->fetch();
		if ($result) {
		  $message4 = "Cette adresse e-mail est déjà utilisée.";
		}
		else { $v4=1 ;}

    //adresse continent minimum 10 caract
    if (strlen($adresse) < 10) {
			$message5 = "L'adresse doit contenir au moins 10 caractères.";
		}
		else
		{$v5=1;}

    // Vérifier si l'utilisateur a plus de 18 ans
    $aujourdhui = new DateTime();
    $date_anniversaire = new DateTime($date_anniversaire);
    $diff = $aujourdhui->diff($date_anniversaire);
    if ($diff->y < 18) {
      $message6 = "Vous devez avoir au moins 18 ans pour vous inscrire.";
    } 
	else { $v6=1;	}

        
      
        
            // Vérifier si le mot de passe contient au moins une lettre majuscule et un caractère spécial
            if (!preg_match('/[A-Z]/', $mp) || !preg_match('/[\W]/', $mp)) {
              $message7 = "Le mot de passe doit contenir au moins une lettre majuscule et un caractère spécial.";
            } 
            else
          {$v7=1;}
        
            if (  $v1==1 && $v2==1 && $v3==1 && $v4==1 && $v5==1 && $v6==1 && $v7==1 )
            {
              
        // Insérer les données dans la table "compte"
    
        $client1=new client($id,$sexe,$nom,$prenom,$num_tel,$mail,$adresse,$date_anniversaire,$mp);

$client1C=new clientC();
$client1C->ajouterclient($client1);
header('Location: ajouterclient.php');
    
    
        
        echo "Inscription réussie !";
        
            }
            echo "Inscription echouée !";
            
        
        
        
            }

































?>
   <html>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Web UI Kit &amp; Dashboard Template based on Bootstrap">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, web ui kit, dashboard template, admin template">

	<link rel="shortcut icon" href="../img/icons/icon-48x48.png" />

	<title>Gestion Clients</title>
    <script src="js/client.js"></script>
	<link href="css/app.css" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
    <nav id="sidebar" class="sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="index.php">
          <span class="align-middle">virtuart Admin</span>
        </a>

				<ul class="sidebar-nav">
					<li class="sidebar-header">
						
					</li>


					<li class="sidebar-item ">
						<a class="sidebar-link" href="ajouteradmine.php">
              <i class="align-middle" data-feather="user"></i> <span class="align-middle"> Gestion Admins </span>
            </a>

			<li class="sidebar-item active" >
						<a href="#ui1" data-toggle="collapse" class="sidebar-link">
                        <i class="align-middle" data-feather="users"></i> <span class="align-middle"> Gestion des clients</span>
            </a>
            <ul id="ui1" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
							<li class="sidebar-item "><a class="sidebar-link" href="afficherclient.php">La liste des Clients : </a></li>
							<li class="sidebar-item active"><a class="sidebar-link" href="ajouterclient.php">Ajouter des clients</a></li>
						</ul>

					</li>

					
					<li class="sidebar-item ">
					<ul id="ui5" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">

					<li class="sidebar-item  "><a class="sidebar-link " href="stat.php"> statistique </a></li>

				</ul>

            					

				
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

<!-- image et mail efface  -->


							<div class="dropdown-menu dropdown-menu-right">
								<a class="dropdown-item" href="deconnexion.php">Log out</a>
							</div>
						</li>
					</ul>
				</div>
			</nav>

      <main class="content">
            <form  method="POST" >
                <div class="container-fluid p-0">

                    <h1 class="h3 mb-3">Ajouter un Client </h1>

                    <div class="card"  style="width:100%">
                        <div class="col-12 col-xl-20" >
                            <div class="card">
                                
                            <table>
                            <div class="card-body card-block">
                                            
                                              <div class="row form-group">
                                                     <div class="col col-md-3"><label for="text-input" class=" form-control-label">id</label><span class="text-danger">*</span></div>
                                                     <div class="col-12 col-md-3"><input type="text" name="id" id="id" class="form-control"><small class="form-text text-muted"></small>
                                                     <span style="color: red; display: block; margin-top: 10px;">  <?php if(isset($message1)) { echo "<p>$message1</p>"; } ?> </span></div>
                                                </div>
                                                
                                                <div class="row form-group">
                                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Sexe</label><span class="text-danger">*</span>
                                                
                                              </div>
                                                <div class="col-12 col-md-3"><select class="form-control"  placeholder="Sexe" name="Sexe" id="Sexe" >
                                                        <option>Choix du Sexe:</option>
                                                        <option>Homme</option>
                                                        <option>Femme</option>
                                                    </select>
                                                    <span style="color: red; display: block; margin-top: 10px;">  <?php if(isset($message2)) { echo "<p>$message2</p>"; } ?> </span>
                                                  </div>

                                                    
                                                </div>


                                             <div class="row form-group">
                                                     <div class="col col-md-3"><label class=" form-control-label">Nom</label><span class="text-danger">*</span></div>
                                                     <div class="col-12 col-md-3"><input type="text" id="Nom" name="Nom"  class="form-control"><small class="form-text text-muted"></small></div>
                                                     </div>       
                                                 

                                                <div class="row form-group">
                                                <div class="col col-md-3"><label class=" form-control-label">Prenom</label><span class="text-danger">*</span></div>
                                                     <div class="col-12 col-md-3"><input type="text" id="Prenom" name="Prenom"  class="form-control"><small class="form-text text-muted"></small></div>
                                                     </div>

                                                 <div class="row form-group">
                                                <div class="col col-md-3"><label class=" form-control-label">Numero Telephone</label><span class="text-danger">*</span></div>
                                                     <div class="col-12 col-md-3"><input type="text" id="num_tel" name="num_tel"  class="form-control"><small class="form-text text-muted"></small>

                                                     <span style="color: red; display: block; margin-top: 10px;">  <?php if(isset($message3)) { echo "<p>$message3</p>"; } ?> </span></div>
                                                     </div>

                                                     <div class="row form-group">
                                                <div class="col col-md-3"><label class=" form-control-label">adresse mail</label><span class="text-danger">*</span></div>
                                                     <div class="col-12 col-md-3"><input type="text" id="mail" name="mail"  class="form-control"><small class="form-text text-muted"></small>

                                                     <span style="color: red; display: block; margin-top: 10px;">  <?php if(isset($message4)) { echo "<p>$message4</p>"; } ?> </span></div>
                                                     </div>


                                                 <div class="row form-group">
                                                <div class="col col-md-3"><label class=" form-control-label">adresse</label><span class="text-danger">*</span></div>
                                                     <div class="col-12 col-md-3"><input type="text" id="adresse" name="adresse"  class="form-control"><small class="form-text text-muted"></small>
                                                     <span style="color: red; display: block; margin-top: 10px;">  <?php if(isset($message5)) { echo "<p>$message5</p>"; } ?> </span></div>
                                                    </div>

                                                 <div class="row form-group">
                                                 <div class="col col-md-3"><label class=" form-control-label">Date de naissance</label><span class="text-danger">*</span></div>
                                                     <div class="col-12 col-md-3"><input type="date" id="date_anniversaire" name="date_anniversaire"  class="form-control"><small class="form-text text-muted"></small>
                                                     <span style="color: red; display: block; margin-top: 10px;">  <?php if(isset($message6)) { echo "<p>$message6</p>"; } ?> </span></div>
                                                     </div>

                                                     <div class="row form-group">
                                                 <div class="col col-md-3"><label class=" form-control-label">Mot de Passe</label><span class="text-danger">*</span></div>
                                                     <div class="col-12 col-md-3"><input type="password" id="mp" name="mp"  class="form-control"><small class="form-text text-muted"></small>
                                                     <span style="color: red; display: block; margin-top: 10px;">  <?php if(isset($message7)) { echo "<p>$message7</p>"; } ?> </span></div>
                                                     </div>

                                                     <div class="card-footer">
                                                        <button type="submit" class="btn btn-primary btn-sm" ></i> Ajouter </button>
                                                    </div>
                                                    <div class="col col-md-4"><label class=" form-control-label"><span class="text-danger">* </span>Cette case est obligatoire</label></div>
                                        </div>
                                        </div>
                                        </div>
                                        </div>
                                        </div>
                                        
        </table>
</form>

        <main class="content">
                <div class="container-fluid p-0">

                <h1 class="h3 mb-3">Afficher liste Client </h1>

<div class="row">
    <div class="col-12 col-xl-15">
        <div class="card">
            
        <table class="table table-bordered">
        <tr>
                                            <th style="width:10%;">id</th>
                                            
											<th style="width:10%">Nom</th>
                                            <th style="width:10%">Prenom</th>
                                            <th style="width:10%;">Sexe</th>
                                            <th class="d-none d-md-table-cell" style="width:10%">Date de naissance</th>
                                            <th style="width:10%">mail</th>
                                            <th style="width:10%">num_tel</th>
                                           
                                            <th style="width:10%">adresse</th>
                        
                                          
                                            <th style="width:10%">Actions</th>

</tr>

<?PHP
foreach($listeclient as $clientC){
?>
<tr>
<td><?PHP echo $clientC['id']; ?></td>
<td><?PHP echo $clientC['nom']; ?></td>
<td><?PHP echo $clientC['prenom']; ?></td>
<td><?PHP echo $clientC['sexe']; ?></td>
<td><?PHP echo $clientC['date_anniversaire']; ?></td>
<td><?PHP echo $clientC['mail']; ?></td>
<td><?PHP echo $clientC['num_tel']; ?></td>
<td><?PHP echo $clientC['adresse']; ?></td>
<td class="table-action">
<a href="modifierclient.php?id=<?= $clientC['id'] ?>"><i class="align-middle" data-feather="edit-2"></i></a>						
<a href="supp-client.php?id=<?= $clientC['id'] ?>"><i class="align-middle" data-feather="trash"></i></a>
                        </td>
    
</tr>
<?PHP
}
?>
</table>
        </div>
    </div>
</main>


<script src="js/vendor.js"></script>
<script src="js/app.js"></script>

</body>

</html>