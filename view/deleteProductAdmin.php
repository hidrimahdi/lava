<?PHP
	include "C:/xampp/htdocs/Project/Dashbord/Controller/produitC.php";

	$produitC=new produitC();
	
	if (isset($_POST["id"])){
		$produitC->supprimerProduit($_POST["id"]);
		header ('Location:../View/tableProductAdmin.php');
	}
?>