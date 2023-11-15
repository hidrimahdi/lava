<?php
include_once'../config.php';
// Connexion à la base de données
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "event";

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("La connexion a échoué : " . $conn->connect_error);
}
// Récupérer tous les événements
public function affiche(){
$sql = "SELECT * FROM events";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $events = array();
    while($row = $result->fetch_assoc()) {
        $events[] = $row;
    }
    echo json_encode($events);
} else {
    echo "Aucun événement trouvé";
}
}
// Créer un nouvel événement
public function create(){
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $eventName = $_POST['eventName'];
    $eventDate = $_POST['eventDate'];
    $eventPlace = $_POST['eventPlace'];
    $eventMaxDiscount = $_POST['eventMaxDiscount'];

    $sql = "INSERT INTO events (eventName, eventDate, eventPlace, eventMaxDiscount)
            VALUES ('$eventName', '$eventDate', '$eventPlace', '$eventMaxDiscount')";

    if ($conn->query($sql) === TRUE) {
        echo "Nouvel événement créé avec succès";
    } else {
        echo "Erreur : " . $sql . "<br>" . $conn->error;
    }
}
}
// Mettre à jour un événement par ID
public function modifier(){
if ($_SERVER["REQUEST_METHOD"] == "PUT") {
    parse_str(file_get_contents("php://input"), $_PUT);
    $eventId = $_PUT['id'];
    $eventName = $_PUT['eventName'];
    $eventDate = $_PUT['eventDate'];
    $eventPlace = $_PUT['eventPlace'];
    $eventMaxDiscount = $_PUT['eventMaxDiscount'];

    $sql = "UPDATE events SET eventName='$eventName', eventDate='$eventDate', eventPlace='$eventPlace', eventMaxDiscount='$eventMaxDiscount' WHERE id=$eventId";

    if ($conn->query($sql) === TRUE) {
        echo "Événement mis à jour avec succès";
    } else {
        echo "Erreur : " . $sql . "<br>" . $conn->error;
    }
}
}
// Supprimer un événement par ID
^public function delete(){
if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
    $eventId = $_GET['id'];

    $sql = "DELETE FROM events WHERE id=$eventId";

    if ($conn->query($sql) === TRUE) {
        echo "Événement supprimé avec succès";
    } else {
        echo "Erreur : " . $sql . "<br>" . $conn->error;
    }
}
}
?>