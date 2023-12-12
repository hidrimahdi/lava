<?php
// ...
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

include_once '../controller/reclamationC.php';
$ReclamationC = new ReclamationC();
$liste = $ReclamationC->afficherReclamation();
// Ajoutez le code suivant pour exporter la liste des réclamations en Excel
if (isset($_GET['export']) && $_GET['export'] == 'excel') {
    require '../vendor/autoload.php';

    // Création d'une nouvelle feuille de calcul
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // En-têtes de colonne
    $sheet->setCellValue('A1', 'ID');
    $sheet->setCellValue('B1', 'Objet');
    $sheet->setCellValue('C1', 'Commentaire');
    $sheet->setCellValue('D1', 'User');

    // Remplissage des données
    $row = 2;
    foreach ($liste as $co) {
        $sheet->setCellValue('A' . $row, $co['id']);
        $sheet->setCellValue('B' . $row, $co['objet']);
        $sheet->setCellValue('C' . $row, $co['commentaire']);
        $sheet->setCellValue('D' . $row, $co['id_user']);
        $row++;
    }

    // Création du fichier Excel
    $writer = new Xls($spreadsheet);
    $filename = 'liste_reclamations.xls';

    // Envoi du fichier Excel en téléchargement
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="' . $filename . '"');
    header('Cache-Control: max-age=0');

    $writer->save('php://output');
    exit();
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
        <div>
            <input type="text" id="search" class="form-control" placeholder="Search">
            <table border="2px">
                <hr>
                <th>id</th>
                <th>objet</th>
                <th>commentaire</th>
                <th>User</th>
                <th>Etat</th>
                <?php foreach ($liste as $co) { ?>
                    <tr>
                        <td><?php echo $co['id']; ?></td>
                        <td><?php echo $co['objet']; ?></td>
                        <td><?php echo $co['commentaire']; ?></td>
                        <td><?php echo $co['id_user']; ?></td>
                        <td><?php
                            if ($co['etat'])
                                echo ("Reclamation traiter");
                            else
                                echo ("Reclamation en atttente") ?></td>
                        <td><a href="supprimerReclamation.php?id=<?php echo $co['id']; ?>">supprimer</a></td>
                        <td><a href="modifierReclamation.php?id=<?php echo $co['id']; ?>">modifier</a></td>
                        <?php
                        if (!$co['etat']) {
                        ?>
                            <td><a href="ajouterReponse.php?id_reclamation=<?php echo $co['id']; ?>">Répondre</a></td> <!-- Ajouter cette ligne -->
                        <?php
                        }
                        ?>
                    </tr>
                <?php } ?>
            </table>
        </div>
        <div>
            <a href="ajouterReclamation.php"><button>Ajouter</button></a>
            <button id="sortBtn">Trier par Objet</button>
            <a href="?export=excel"><button>Export Excel</button></a>
        </div>


    </section>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $("#search").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("table tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
    $("#sortBtn").on("click", function() {
        var rows = $("table tbody tr").get();

        rows.sort(function(a, b) {
            var objA = $(a).find("td:eq(1)").text().toUpperCase();
            var objB = $(b).find("td:eq(1)").text().toUpperCase();

            return objA.localeCompare(objB);
        });

        $.each(rows, function(index, row) {
            $("table tbody").append(row);
        });
    });
</script>


</html>