<?php
include_once '../model/Reponse.php';
include_once '../controller/ReponseC.php';

$ReponseC = new ReponseC();
$id_rep = $_GET['id'];
$r = $ReponseC->findone($id_rep);
if (isset($_POST["sub"])) {
    $ReponseC->modifier($_POST['reponse'], $id_rep);

    // Redirection vers la page d'affichage
    header('Location: afficherReponse.php');
    exit; // Assure que le script se termine ici pour éviter l'exécution du code suivant
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="style.css">
    <title>Reponse</title>
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
                    <h2>Formulaire de Reponse</h2>
                    <div class="inputbox">
                        <ion-icon name="person-outline"></ion-icon>
                        <input name="reponse" value="<?= $r['reponse'] ?>" id="reponse" type="text" size="50">
                        <label for="reponse">reponse</label>
                        <span id="reponser"> </span>
                    </div>
                    <input type="submit" value="Envoyer La réponse" name="sub">
                    <a href="afficherReponse.php" class="btn btn-danger">Anuuler</a>
                </form>
                <script>
                    let myform = document.getElementById('formr');
                    myform.addEventListener('submit', function(e) {
                        let reponse = document.getElementById('reponse');
                        const regex = /^[a-zA-Z-\s]+$/;
                        if (reponse.value === '') {
                            let reponser = document.getElementById('reponser');
                            reponser.innerHTML = "le champs reponse est vide . ";
                            reponser.style.color = 'red';
                            e.preventDefault();
                        } else if (!(regex.test(reponse.value))) {
                            let reponser = document.getElementById('reponser');
                            reponser.innerHTML = "la reponsee doit comporter des lettres,et tirets seulements.";
                            reponser.style.color = 'red';
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