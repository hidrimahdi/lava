<?php

function countProduitsByCategorie() {
    // Connexion à la base de données
    $mysqli = new mysqlimysqli('localhost', 'root', '', 'pw');;

    // Vérification des erreurs de connexion
    if ($mysqli->connect_error) {
        die('Erreur de connexion à la base de données (' . $mysqli->connect_errno . ') '
                . $mysqli->connect_error);
    }

    // Requête SQL pour compter le nombre de produits par catégorie
    $query = "SELECT c.nomcat, COUNT(p.id_produit) AS nb_produits FROM categories c LEFT JOIN produits p ON c.idcat = p.idcat GROUP BY c.idcat";

    // Exécution de la requête SQL
    $result = $mysqli->query($query);

    // Récupération des données sous forme de tableau
    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[$row['nomcat']] = $row['nb_produits'];
    }

    // Fermeture de la connexion à la base de données
    $mysqli->close();

    // Retourne les données sous forme de tableau
    return $data;
}
