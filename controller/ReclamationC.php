/<?php
    require_once("C:/xampp/htdocs/new/vendor/autoload.php");
    include_once("C:/xampp/htdocs/new/config.php");
    include_once("C:/xampp/htdocs/new/Model/Reclamation.php");

    use Twilio\Rest\Client;

    class ReclamationC
    { //nom du class
        function supprimerReclamation($id)
        {
            $sql = "DELETE FROM Reclamation WHERE id=:id";
            $db = config::getConnexion();
            $req = $db->prepare($sql);
            $req->bindValue(':id', $id);
            try {
                $req->execute();
            } catch (Exception $e) {
                die('Erreur:' . $e->getMessage());
            }
        }
        function afficherReclamation()
        {
            $sql = "select * from Reclamation";
            $db = config::getConnexion();
            try {
                $liste = $db->query($sql);
                return $liste;
            } catch (Exception $e) {
                echo 'Erreur: ' . $e->getMessage();
            }
        }
        function recupererReclamation($id)
        {
            $sql = "select * from Reclamation where id=" . $id;
            $db = config::getConnexion();
            try {
                $liste = $db->query($sql);
                return $liste;
            } catch (Exception $e) {
                echo 'Erreur: ' . $e->getMessage();
            }
        }

        public function ajouterReclamation($Reclamation)
        {
            $sql = "INSERT INTO `reclamation`( `objet`, `commentaire`, `id_user`) VALUES  (:objet, :commentaire,:id_user)";
            $db = config::getConnexion();
            $sid = 'AC8056576998a2d8828be6cddb30ab3fe6';
            $token = '6f21e6601e3e8358e58873f2c37dcbf4';
            $twilio = new Client($sid, $token);
            try {
                $query = $db->prepare($sql);
                $query->execute([
                    'objet' => $Reclamation->getobjet(),
                    'commentaire' => $Reclamation->getcommentaire(),
                    'id_user' => $Reclamation->getidUser(),
                ]);

                // Envoie du SMS avec Twilio après l'ajout
                $message = $twilio->messages
                    ->create(
                        "+21629263039", // to
                        [
                            "body" => " Merci d'avoir soumis votre réclamation (ID : " . $Reclamation->getid() . "). Nous avons bien reçu votre demande et nous la traiterons dans les plus brefs délais. Votre satisfaction est notre priorité. Merci de votre compréhension. ",
                            "from" => "+18584139173"
                        ]
                    );

                print($message->sid);
            } catch (Exception $e) {
                echo 'Erreur Twilio: ' . $e->getMessage();
                echo 'Erreur: ' . $e->getMessage();
            }
        }



        public function modifierReclamation($Reclamation, $id)
        {
            $sql = "UPDATE Reclamation SET id=:id, objet=:objet	, commentaire=:commentaire,id_user=:id_user WHERE id=:reclamation_id";
            $db = config::getConnexion();
            try {
                $query = $db->prepare($sql);
                $query->execute([
                    'id' => $Reclamation->getid(),
                    'objet' => $Reclamation->getobjet(),
                    'commentaire' => $Reclamation->getcommentaire(),
                    'id_user' => $Reclamation->getidUser(),
                    'reclamation_id' => $id,
                ]);
            } catch (Exception $e) {
                echo 'Erreur: ' . $e->getMessage();
            }
        }
    }

    ?>