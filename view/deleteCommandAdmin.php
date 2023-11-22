<?PHP
	include "C:/xampp/htdocs/Project/Dashbord/Controller/commandeC.php";

	$commandeC=new commandeC();
	
	if (isset($_POST["id"])){
		$commandeC->supprimerCommande($_POST["id"]);
		header ('Location:../View/tableAdminCommand.php');
	}
?>