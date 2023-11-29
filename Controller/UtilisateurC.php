<?PHP
	include "../config.php";
	require_once '"C:\xampp\htdocs\projet\model\Utilisateur.php"';

	class utilisateurC {

		function ajouterutilisateur($utilisateur){
            $sql="INSERT INTO compte (id, nom, prenom, role, mail, mp ,type) VALUES (:id, :nom, :prenom, :role, :mail, :mp , :type)";
				$connexion=config::getConnexion();
				$rep=$connexion->prepare($sql);
				$rep->bindValue(":id",$utilisateur->getid());
				$rep->bindValue(":nom",$utilisateur->getnom());
				$rep->bindValue(":prenom",$utilisateur->getprenom());
				$rep->bindValue(":role",$utilisateur->getrole());
                $rep->bindValue(":mail",$utilisateur->getmail());
				$rep->bindValue(":mp",$utilisateur->getmp());
               // $rep->bindValue(":image",$utilisateur->getimage());
				$rep->bindValue(":type","admin");

				
				$rep->execute();

        }


        function afficherutilisateurs(){
			
			try {
                $pdo = config::getConnexion();
                $query = $pdo->prepare(
                    'SELECT * FROM compte where type like "admin"'
                );
                $query->execute();
                return $query->fetchAll();
            } 
			catch (PDOException $e) {
                $e->getMessage();
            }
		}
		// function afficherimage($mail){
			
		// 	$sql="SELECT * From compte  WHERE mail = '$mail' ";
        //     $db = config::getConnexion();
        //     try{
        //     $liste=$db->query($sql);
        //     return $liste;
        //     }
        //     catch (Exception $e){
        //         die('Erreur: '.$e->getMessage());
        //     }	
		// }
		function afficherrole($mail){
			
			$sql="SELECT * From compte  WHERE role = '$mail' ";
            $db = config::getConnexion();
            try{
            $liste=$db->query($sql);
            return $liste;
            }
            catch (Exception $e){
                die('Erreur: '.$e->getMessage());
            }	
		}

		function supprimerutilisateur($id){
			$sql="DELETE FROM compte WHERE id= :id";
			$db =config::getConnexion();
			$req=$db->prepare($sql);
			$req->bindValue(':id',$id);
			try{
				$req->execute();
			}
			catch (Exception $e){
				die('Erreur: '.$e->getMessage());
			}
		}
		function recuputilisateur($id){
			$sql="SELECT * from compte where id=$id";
			$db =config::getConnexion();
			try{
			$liste=$db->query($sql);
			return $liste;
			}
			catch (Exception $e){
				die('Erreur: '.$e->getMessage());
			}
		}


		function recupererutilisateur1($id){
			$sql="SELECT * from compte where id=$id";
			$db =config::getConnexion();
			try{
				$query=$db->prepare($sql);
				$query->execute();
				
				$user = $query->fetch(PDO::FETCH_OBJ);
				return $user;
			}
			catch (Exception $e){
				die('Erreur: '.$e->getMessage());
			}
		}
		
		public function modifierutilisateur($utilisateur,$id)
		{
			  
			   $sql="UPDATE compte SET Nom=:Nom,Prenom=:Prenom,role=:role,mail=:mail, mp=:mp  WHERE id=:id";
			   $connexion=config::getConnexion();
			$rep=$connexion->prepare($sql);
			$rep->bindValue(":id",$id);
			$rep->bindValue(":Nom",$utilisateur->getNom());
			$rep->bindValue(":Prenom",$utilisateur->getPrenom());
			$rep->bindValue(":role",$utilisateur->getrole());
			$rep->bindValue(":mail",$utilisateur->getmail());
			$rep->bindValue(":mp",$utilisateur->getmp());
			$rep->execute();
		}


		function connexionUser($mail,$mp){
            $sql="SELECT * FROM compte WHERE mail='" . $mail . "' and mp = '". $mp."'";
            $db =config::getConnexion();
            try{
                $query=$db->prepare($sql);
                $query->execute();
                $count=$query->rowCount();
                if($count==0) {
                    $message = "pseudo ou le mot de passe est incorrect";
                } else {
                    $x=$query->fetch();
                  
                }
            }
            catch (Exception $e){
                    $message= " ".$e->getMessage();
					
            }
			return  $message;
        }

	}



?>