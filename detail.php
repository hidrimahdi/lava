<?php
// Récupérer l'ID du produit à partir de l'URL
require_once('confige.php');
$id_produit = $_GET['id_produit'];

// Connexion à la base de données
$pdo = Config::getConnexion();

// Récupérer les détails du produit depuis la base de données
$stmt = $pdo->prepare("SELECT * FROM produits WHERE id_produit = :id_produit");
$stmt->bindParam(":id_produit", $id_produit);
$stmt->execute();
$produit = $stmt->fetch();

// Afficher les détails du produit
if ($produit) {
    echo "<h2>{$produit['Nom']}</h2>";
    echo "<img src='{$produit['Image']}' />";
    echo "<p>{$produit['Description']}</p>";
    echo "<h3>{$produit['Prix']} DT</h3>";
} else {
    echo "<p>Le produit n'existe pas</p>";
}
?>
