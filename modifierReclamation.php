

<?php
include_once '../controller/ReclamationC.php';
$ReclamationC=new ReclamationC();
$conc=$Reclamation->recupererReclamation($_GET["id"]);

if (
    isset($_POST["id"]) 
) {
   
        $Reclamation = new Reclamation($_POST['id'],$_POST['details'],$_POST['solutionPreferer'],);
        $ReclamationC->modifierReclamation($Reclamation,$_GET["id"]);
        header('Location:afficherReclamation.php');
   
}
foreach($conc as $coc)
{
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>modifirr</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<form action="" method="post">
<table>
<tr><td><label for="">id</label></td><td><input name="id" type="" value="number"<?php echo $coc['id']; ?>"></td></tr>
<tr><td><label for="">details</label></td><td><input name="details" type="text" value="<?php echo $coc['details']; ?>"></td></tr>
<tr><td><label for="">solutionPreferer</label></td><td><input name="solutionPreferer" type="text" value="<?php echo $coc['solutionPreferer']; ?>"></td></tr>
 



<tr><tr><tr><tr><tr><tr></tr></tr></tr></tr></tr></tr>
<tr><td></td><td><input type="submit" value="soumettre" name="sub"></td></tr>






</table>





    </form>
<?php } ?>
</table>    
</body>
</html>