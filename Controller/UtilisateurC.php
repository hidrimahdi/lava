<?php
	include_once ("C:/xampp/htdocs/Project/config.php");
	require_once ("c:/xampp/htdocs/Project/Dashbord/View/back/Entities");

	class utilisateurC {

		function ajouterutilisateur($utilisateur){
            $sql = "INSERT INTO admin (id, nom, prenom, role, mail, mp, type) VALUES (:id, :nom, :prenom, :role, :mail, :mp, :type)";
			$connexion = config::getConnexion();
			$rep = $connexion->prepare($sql);
			$rep->bindValue(":id", $utilisateur->getid());
			$rep->bindValue(":nom", $utilisateur->getnom());
			$rep->bindValue(":prenom", $utilisateur->getprenom());
			$rep->bindValue(":role", $utilisateur->getrole());
			$rep->bindValue(":mail", $utilisateur->getmail());
			$rep->bindValue(":mp", $utilisateur->getmp());
			$rep->bindValue(":type", "admin");
			$rep->execute();
		}

		function afficherutilisateurs(){
			try {
                $pdo = config::getConnexion();
                $query = $pdo->prepare('SELECT * FROM admin');
                $query->execute();
                return $query->fetchAll();
            } catch (PDOException $e) {
                $e->getMessage();
            }
		}

		function afficherrole($mail){
			$sql = "SELECT * FROM admin WHERE role = '$mail'";
            $db = config::getConnexion();
            try{
				$liste = $db->query($sql);
				return $liste;
            } catch (Exception $e){
                die('Erreur: ' . $e->getMessage());
            }	
		}

		function supprimerutilisateur($id){
			$sql = "DELETE FROM admin WHERE id = :id";
			$db = config::getConnexion();
			$req = $db->prepare($sql);
			$req->bindValue(':id', $id);
			try{
				$req->execute();
			} catch (Exception $e){
				die('Erreur: ' . $e->getMessage());
			}
		}

		function recuputilisateur($id){
			$sql = "SELECT * FROM admin WHERE id = $id";
			$db = config::getConnexion();
			try{
				$liste = $db->query($sql);
				return $liste;
			} catch (Exception $e){
				die('Erreur: ' . $e->getMessage());
			}
		}

		function recupererutilisateur1($id){
			$sql = "SELECT * FROM admin WHERE id = $id";
			$db = config::getConnexion();
			try{
				$query = $db->prepare($sql);
				$query->execute();
				$user = $query->fetch(PDO::FETCH_OBJ);
				return $user;
			} catch (Exception $e){
				die('Erreur: ' . $e->getMessage());
			}
		}

		public function modifierutilisateur($utilisateur, $id) {
			$sql = "UPDATE admin SET nom=:nom, prenom=:prenom, role=:role, mail=:mail, mp=:mp WHERE id=:id";
			$connexion = config::getConnexion();
			$rep = $connexion->prepare($sql);
			$rep->bindValue(":id", $id);
			$rep->bindValue(":nom", $utilisateur->getNom());
			$rep->bindValue(":prenom", $utilisateur->getPrenom());
			$rep->bindValue(":role", $utilisateur->getrole());
			$rep->bindValue(":mail", $utilisateur->getmail());
			$rep->bindValue(":mp", $utilisateur->getmp());
			$rep->execute();
		}

		function connexionUser($mail, $mp) {
			$sql = "SELECT * FROM admin WHERE mail = '" . $mail . "' AND mp = '" . $mp . "'";
			$db = config::getConnexion();
			try{
				$query = $db->prepare($sql);
				$query->execute();
				$count = $query->rowCount();
				if ($count == 0) {
					$message = "Le pseudo ou le mot de passe est incorrect";
				} else {
					$x = $query->fetch();
				}
			} catch (Exception $e){
				$message = " " . $e->getMessage();
			}
			return $message;
		}
	}
?>
