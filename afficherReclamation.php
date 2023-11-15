

<?php
include_once '../controller/reclamationC.php';
$ReclamationC=new ReclamationC();
$liste=$ReclamationC->afficherReclamation();



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    
    <title>AFFICHER</title>
</head>

<body>


<table  border="2px"> 
<hr>
<th><th>id</th></th>
<th><th>details</th></th>
<th><th>solutionPreferer</th></th>
<?php

foreach($liste as $co)
{
?>
<tr><td><?php echo $co['id']; ?></td><td><?php echo $co['details']; ?></td><td><?php echo $co['solutionPreferer']; ?></td> ;
<td><a href="supprimerReclamation.php? id=<?php echo $co['id']; ?>">supprimer</a></td>
<td><a href="modifierReclamation.php? id=<?php echo $co['id']; ?>">modifier</a></td>
</tr>
<?php } ?>
</table  >    
</body>
<img src="art.jpg" alt="" srcset="">

</html>