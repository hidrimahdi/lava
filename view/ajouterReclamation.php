<?php
include_once '../model/Reclamation.php';
include_once '../controller/ReclamationC.php';

$ReclamationC = new ReclamationC();
$id_user = $_POST['id_user'] ?? 15;

if (isset($_POST["sub"])) {
    $objet = $_POST['objet'];
    $commentaire = $_POST['commentaire'];

    // Vérification des champs vides
    if (empty($objet) || empty($commentaire)) {
        $warning = "Veuillez remplir tous les champs.";
    } else {
        $Reclamation = new Reclamation(1, $objet, $commentaire, $id_user);
        $ReclamationC->ajouterReclamation($Reclamation);
        // Redirection vers la page d'affichage
        header('Location: afficherReclamation.php');
        exit; // Assure que le script se termine ici pour éviter l'exécution du code suivant
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="style.css">
    <title>Reclamation</title>
    <style>
        body {
            margin: 0;
            /* Remove default margin on the body */
            font-family: Arial, sans-serif;
            /* Optional: Set a preferred font */
        }

        nav {
            background-color: #333;
            padding: 10px;
            width: 100%;
            /* Make the navigation bar full width */
            position: fixed;
            /* Position the navigation bar fixed at the top */
            top: 0;
            /* Align the top of the navigation bar to the top of the viewport */
        }

        ul {
            list-style-type: none;
            /* Remove default list styles */
            margin: 0;
            /* Remove default margin on the unordered list */
            padding: 0;
            /* Remove default padding on the unordered list */
        }

        li {
            display: inline-block;
            margin-right: 10px;
        }

        a {
            text-decoration: none;
            color: white;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <section>
        <nav>
            <li>
                <a href="afficherReclamation.php">Liste reclamaition</a>
            </li>
            <li>
                <a href="afficherReponse.php">Liste reponse</a>
            </li>
            <li>
                <a href="ajouterReclamation.php">Ajouter reclamaition</a>
            </li>
        </nav>
        <div class="form-box">
            <div class="form-value">
                <form action="" id="formr" method="post">
                    <h2>Formulaire de Reclamation</h2>
                    <div class="inputbox">
                        <ion-icon name="person-outline"></ion-icon>
                        <input name="objet" id="Objet" type="text" size="50">
                        <label for="objet">Objet</label>
                        <span id="Objetr"> </span>
                    </div>
                    <div class="inputbox">
                        <ion-icon name="person-outline"></ion-icon>
                        <input name="commentaire" id="commentaire" type="text" size="50">
                        <label for="commentaire">Commentaire</label>
                        <span id="commentairer"> </span>
                    </div>
                    <input type="submit" value="Envoyer La réclamation" name="sub">
                </form>
                <script>
                    let myform = document.getElementById('formr');
                    myform.addEventListener('submit', function(e) {
                        let commentaire = document.getElementById('commentaire');
                        let Objet = document.getElementById('Objet');
                        const regex = /^[a-zA-Z-\s]+$/;
                        if (commentaire.value === '') {
                            let commentairer = document.getElementById('commentairer');
                            commentairer.innerHTML = "le champs commentaire est vide . ";
                            commentairer.style.color = 'red';
                            e.preventDefault();
                        } else if (!(regex.test(commentaire[0]))) {
                            let commentairer = document.getElementById('commentairer');
                            commentairer.innerHTML = "Le premier caractère ne peut pas être un chiffre.";
                            commentairer.style.color = 'red';
                            e.preventDefault();
                        }
                        if (Objet.value === '') {
                            let nameer = document.getElementById('Objetr');
                            nameer.innerHTML = "le champs Objet est vide . ";
                            nameer.style.color = 'red';
                            e.preventDefault();
                        } else if (!(regex.test(Objet.value))) {
                            let nameer = document.getElementById('Objetr');
                            nameer.innerHTML = "la Objet doit comporter des lettres,et tirets seulements.";
                            nameer.style.color = 'red';
                            e.preventDefault();
                        }
                    });
                </script>
            </div>
        </div>
    </section>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>