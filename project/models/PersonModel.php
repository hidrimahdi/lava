<?php
include_once '../config.php'; // Inclut le fichier de configuration pour établir la connexion à la base de données.

class PersonModel {
    private $pdo; // Propriété pour stocker la connexion à la base de données.

    public function __construct() {
        $this->pdo = Config::getConnexion(); // Initialise la connexion à la base de données via la classe Config.
    }

    public function getAllPersons() {
        try {
            $stmt = $this->pdo->query("SELECT * FROM commande"); // Exécute une requête pour récupérer toutes les personnes dans la table 'commande'.
            return $stmt->fetchAll(); // Retourne un tableau contenant toutes les personnes récupérées.
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération des personnes : " . $e->getMessage(); // En cas d'erreur, affiche un message.
            return []; // Retourne un tableau vide en cas d'erreur.
        }
    }

    public function addPerson($data) {
        // Filtrer les données pour éviter les attaques d'injection SQL.
        $filteredData = [
            'nom' => filter_var($data['nom'], FILTER_SANITIZE_STRING),
            'prenom' => filter_var($data['prenom'], FILTER_SANITIZE_STRING),
            'email' => filter_var($data['email'], FILTER_SANITIZE_EMAIL),
            'tlf' => filter_var($data['tlf'], FILTER_SANITIZE_STRING),
            'adresse' => filter_var($data['adresse'], FILTER_SANITIZE_STRING),
            'logo' => filter_var($data['logo'], FILTER_SANITIZE_STRING),
        ];

        try {
            // Prépare et exécute une requête pour insérer une nouvelle personne dans la table 'commande'.
            $stmt = $this->pdo->prepare("INSERT INTO commande (nom, prenom, email, tlf, adresse, logo) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([
                $filteredData['nom'],
                $filteredData['prenom'],
                $filteredData['email'],
                $filteredData['tlf'],
                $filteredData['adresse'],
                $filteredData['logo'],
            ]);
        } catch (PDOException $e) {
            echo "Erreur lors de l'ajout de la personne : " . $e->getMessage(); // En cas d'erreur, affiche un message.
        }
    }

    public function deletePerson($id) {
        try {
            // Prépare et exécute une requête pour supprimer une personne de la table 'commande' en utilisant l'identifiant.
            $stmt = $this->pdo->prepare("DELETE FROM commande WHERE id = ?");
            $stmt->execute([$id]);
        } catch (PDOException $e) {
            echo "Erreur lors de la suppression de la personne : " . $e->getMessage(); // En cas d'erreur, affiche un message.
        }
    }

    public function updatePerson($id, $data) {
        // Filtrer les données pour éviter les attaques d'injection SQL.
        $filteredData = [
            'nom' => filter_var($data['nom'], FILTER_SANITIZE_STRING),
            'prenom' => filter_var($data['prenom'], FILTER_SANITIZE_STRING),
            'email' => filter_var($data['email'], FILTER_SANITIZE_EMAIL),
            'tlf' => filter_var($data['tlf'], FILTER_SANITIZE_STRING),
            'adresse' => filter_var($data['adresse'], FILTER_SANITIZE_STRING),
            'logo' => filter_var($data['logo'], FILTER_SANITIZE_STRING),
        ];

        try {
            // Prépare et exécute une requête pour mettre à jour les données d'une personne dans la table 'commande'.
            $stmt = $this->pdo->prepare("UPDATE commande SET nom=?, prenom=?, email=?, tlf=?, adresse=?, logo=? WHERE id = ?");
            $stmt->execute([
                $filteredData['nom'],
                $filteredData['prenom'],
                $filteredData['email'],
                $filteredData['tlf'],
                $filteredData['adresse'],
                $filteredData['logo'],
                $id,
            ]);
        } catch (PDOException $e) {
            echo "Erreur lors de la mise à jour de la personne : " . $e->getMessage(); // En cas d'erreur, affiche un message.
        }
    }
}
?>
