


<?php
include_once '../model/Reclamation.php';
include_once '../controller/ReclamationC.php';
$ReclamationC= new ReclamationC();
if (
    isset($_POST["sub"]) 
) {
   
        $Reclamation = new Reclamation($_POST['id'],$_POST['details'],$_POST['solutionPreferer'],);
        $ReclamationC->ajouterReclamation($Reclamation);
       //wx header('Location:affichercontact.php');
   
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
   
    <title>formulaire du Reclamation</title>
</head> 
<body>

<img src="art.jpg" alt="" srcset="">
    <form action="" method="post">
    
        <center><legend>formulaire du Reclamation</legend>
    
   <table >

   <tr><tr>
    <td><label for="">id </label></td><tr><td>
        <input name="id"type="number"></td></tr>
    </tr>
</tr>
<tr>
    <td><label for="">details </label></td><tr><td><input name="details" type="text" size="50"><br><br></td></tr>

</tr>
<tr>
    <td><label for="">solutionPreferer </label></td><tr><td><input name="solutionPreferer" type="text" size="50"><br><br></td></tr>

</tr>




</tr>
<tr><tr><tr><tr><tr><tr><tr><tr><tr><tr><tr><tr><tr></tr></tr></tr></tr></tr></tr></tr></tr></tr></tr></tr></tr></tr>
<tr><td></td></tr>

<tr><td><input type="submit" value="Envoyer La reclamation " name="sub"></td></tr>

</table>
</center>
    </form>
    <img src="art.jpg" alt="" sizes="50%" srcset="">
</body>



</html>