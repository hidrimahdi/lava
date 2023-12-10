<?php 
var_dump($_GET);
include ("../controller/GlobalCrudController.php");

$id=$_GET['id'];
$tablename=$_GET['table_name'];
$c = new GlobalCrudController();

$c->deleteDataFromTable($tablename,$id);
echo "<script>alert('entity deleted with success!');</script>";
header("Location: DashboardView.php?selected_table=".$tablename);
