<?php
include_once '../config.php'; // Inclut le fichier de configuration pour établir la connexion à la base de données.

$pdo = Config::getConnexion(); // Initialise la connexion à la base de données.

$message = ''; // Initialise une variable pour stocker les messages à afficher.

// Gestion de l'ajout d'une nouvelle commande
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajouter'])) {
    try {
        // Prépare une requête pour insérer une nouvelle commande dans la base de données
        $insertion = $pdo->prepare("INSERT INTO commande (nom, prenom, email, tlf, adresse) VALUES (?, ?, ?, ?, ?)");

        // Exécute la requête avec les valeurs fournies dans le formulaire
        $success = $insertion->execute([
            $_POST['nom'],
            $_POST['prenom'],
            $_POST['email'],
            $_POST['tlf'],
            $_POST['adresse']
        ]);

        if ($success) {
            header("Location: index.php"); // Redirige vers la page d'accueil après l'ajout
            exit();
        } else {
            $message = "Erreur lors de l'ajout. Aucune ligne n'a été ajoutée."; // Affiche un message d'erreur si l'ajout a échoué
        }
    } catch (PDOException $e) {
        $message = "Erreur lors de l'ajout : " . $e->getMessage(); // Capture et affiche toute erreur PDO survenue lors de l'ajout
    }
}

// Gestion de la modification d'une commande
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['modifier'])) {
    // Récupère l'ID à modifier depuis le formulaire
    $id = isset($_POST['id']) ? $_POST['id'] : '';

    if (!empty($id)) {
        try {
            // Récupère les données de la commande correspondante à l'ID pour affichage dans le formulaire
            $resultat = $pdo->prepare("SELECT * FROM commande WHERE id=?");
            $resultat->execute([$id]);
            $personne = $resultat->fetch();

            // Supprime la commande correspondante à l'ID après avoir récupéré ses données
            $suppression = $pdo->prepare("DELETE FROM commande WHERE id=?");
            $suppression->execute([$id]);

            if ($personne) {
                // Stocke les données de la commande pour affichage dans le formulaire de modification
                $nom = $personne['nom'];
                $prenom = $personne['prenom'];
                $email = $personne['email'];
                $tlf = $personne['tlf'];
                $adresse = $personne['adresse'];
            } else {
                $message = "ID non trouvé."; // Affiche un message si l'ID n'est pas trouvé
            }
        } catch (PDOException $e) {
            $message = "Erreur : " . $e->getMessage(); // Capture et affiche toute erreur PDO survenue lors de la modification
        }
    } else {
        $message = "ID manquant pour la modification."; // Affiche un message si l'ID est manquant
    }
}

// Gestion de la suppression d'une commande
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['supprimer'])) {
    // Récupère l'ID à supprimer depuis le formulaire
    $id = isset($_POST['id']) ? $_POST['id'] : '';

    try {
        // Supprime la commande correspondante à l'ID fourni
        $suppression = $pdo->prepare("DELETE FROM commande WHERE id=?");
        $suppression->execute([$id]);

        header("Location: index.php"); // Redirige vers la page d'accueil après la suppression
        exit();
    } catch (PDOException $e) {
        $message = "Erreur lors de la suppression : " . $e->getMessage(); // Capture et affiche toute erreur PDO survenue lors de la suppression
    }
}

try {
    // Récupère toutes les commandes depuis la base de données
    $resultat = $pdo->query("SELECT * FROM commande");

    // Stocke les résultats dans un tableau associatif
    $rows = ($resultat) ? $resultat->fetchAll() : [];

} catch (PDOException $e) {
    $message = "Erreur PDO : " . $e->getMessage(); // Capture et affiche toute erreur PDO survenue lors de la récupération des commandes
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Commandes</title>
    <link rel="stylesheet" href="../assets/style.css">
    
</head>
<body>

<h2>Liste des Commandes clients</h2>

<form method="post">
    <label for="nom">Nom:</label>
    <input type="text" name="nom" value="<?php echo isset($nom) ? $nom : ''; ?>" required>

    <label for="prenom">Prénom:</label>
    <input type="text" name="prenom" value="<?php echo isset($prenom) ? $prenom : ''; ?>" required>

    <label for="email">Email:</label>
    <input type="email" name="email" value="<?php echo isset($email) ? $email : ''; ?>" required>

    <label for="tlf">Téléphone:</label>
    <input type="text" name="tlf" value="<?php echo isset($tlf) ? $tlf : ''; ?>" required>

    <label for="adresse">Adresse:</label>
    <input type="text" name="adresse" value="<?php echo isset($adresse) ? $adresse : ''; ?>" required>

    <?php if (isset($id)): ?>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <button type="submit" name="ajouter">Modifier</button>
    <?php else: ?>
        <button type="submit" name="ajouter">Ajouter</button>
    <?php endif; ?>
</form>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Téléphone</th>
            <th>Adresse</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($rows as $row): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['nom']; ?></td>
                <td><?php echo $row['prenom']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['tlf']; ?></td>
                <td><?php echo $row['adresse']; ?></td>
                <td class="actions">
                    <form method="post" style="display: inline;">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <button type="submit" name="modifier">Modifier</button>
                    </form>
                    <form method="post" style="display: inline;">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <button type="submit" name="supprimer">Supprimer</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>

