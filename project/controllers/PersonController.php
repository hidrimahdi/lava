<?php

include_once '../config.php'; // Inclut le fichier de configuration pour établir la connexion à la base de données.
require_once '../models/PersonModel.php'; // Inclut le modèle de personne.

class PersonController {
    private $model; // Propriété pour stocker l'instance du modèle PersonModel.

    public function __construct() {
        $this->model = new PersonModel(); // Initialise une instance du modèle PersonModel.
    }

    public function index() {
        $persons = $this->model->getAllPersons(); // Récupère toutes les personnes à partir du modèle.
        include 'views/index.php'; // Inclut la vue pour afficher les personnes.
    }

    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') { // Vérifie si la requête est de type POST.

            // Récupère les données du formulaire et les filtre pour éviter les attaques d'injection SQL.
            $data = [
                'nom' => filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING),
                'prenom' => filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_STRING),
                'email' => filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL),
                'tlf' => filter_input(INPUT_POST, 'tlf', FILTER_SANITIZE_STRING),
                'adresse' => filter_input(INPUT_POST, 'adresse', FILTER_SANITIZE_STRING),
            ];

            try {
                $this->model->addPerson($data); // Appelle la méthode du modèle pour ajouter une personne.
                header('Location: index.php'); // Redirige vers la page d'accueil après l'ajout.
                exit; // Arrête l'exécution du script après la redirection.
            } catch (Exception $e) {
                echo "Erreur lors de l'ajout de la personne : " . $e->getMessage(); // En cas d'erreur, affiche un message.
            }
        }
    }
}
?>
