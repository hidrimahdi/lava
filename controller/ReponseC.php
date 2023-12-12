<?php
include_once("C:/xampp/htdocs/new/config.php");
include_once("C:/xampp/htdocs/new/Model/Reponse.php");

class ReponseC
{
    public function afficherReponse()
    {
        $sql = "select * from Reponse";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            echo 'Erreur: ' . $e->getMessage();
        }
    }

    public function ajouterReponse($Reponse)
    {
        $sql = "INSERT INTO reponse (reponse, id_reclamation) VALUES (:reponse, :id_reclamation);UPDATE `reclamation` SET `etat`=1 WHERE `id` =:id_reclamation ;";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'reponse' => $Reponse->getreponse(),
                'id_reclamation' => $Reponse->getIdReclamation()
            ]);
        } catch (Exception $e) {
            echo 'Erreur: ' . $e->getMessage();
        }
    }

    public function modifier($Reponse, $id)
    {
        $sql = "UPDATE `reponse` SET `reponse`=:reponse WHERE `id` =:id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'reponse' => $Reponse,
                'id' => $id,
            ]);
        } catch (Exception $e) {
            echo 'Erreur: ' . $e->getMessage();
        }
    }


    function supprimer()
    {
        if (isset($_GET['delete'])) {
            $sql = "DELETE FROM reponse WHERE id_reclamation=:id;UPDATE `reclamation` SET `etat`=0 WHERE `id` =:id ;";
            $db = config::getConnexion();
            $req = $db->prepare($sql);
            $req->bindValue(':id', $_GET['delete']);
            try {
                $req->execute();
                header("Location: afficherReclamation.php");
            } catch (Exception $e) {
                die('Erreur:' . $e->getMessage());
            }
        }
    }
    public function findone($id)
    {
        $sql = "SELECT * FROM reponse WHERE `id` = '$id'";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            $f = $liste->fetch();
            return $f;
        } catch (Exception $e) {
            die('Erreur:' . $e->getMessage());
        }
    }
}
