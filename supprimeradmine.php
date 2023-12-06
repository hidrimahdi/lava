<?PHP
	include "../controller/UtilisateurC.php";
   
	$utilisateurC=new UtilisateurC();
    $listeutilisateur = $utilisateurC->afficherUtilisateurs();
	
	if (isset($_POST["id"])){
		$utilisateurC->supprimerUtilisateur($_POST["id"]);
		header('Location:ajouteradmine.php');
	}

?>

