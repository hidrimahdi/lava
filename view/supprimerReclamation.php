<?php
	include '../controller/ReclamationC.php';
	$ReclamationC=new ReclamationC();
	$ReclamationC->supprimerReclamation($_GET["id"]);
	header('Location:afficherReclamation.php');
?>