<?PHP
include "../Controller/clientC.php";
$clientC=new clientC();
if (isset($_GET["id"])){
	$clientC->supprimerclient($_GET["id"]);
	header('Location: afficherclient.php');
}

?>