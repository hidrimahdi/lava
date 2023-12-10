<?php

$name = $_POST["categoryName"];
include ("../controller/categoryC.php");
$c = new CategoryC();
$c->createCategory($name);
header("Location: CategoryView.php");