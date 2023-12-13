<?PHP
	
	include_once ("C:/xampp/htdocs/Project/config.php");
	include ("C:/xampp/htdocs/Project/Dashbord/Model/commande.php");

	class commandeC {
		function ajouterCommande($commande){
			 $sql="INSERT INTO commande (nom, adresse, num, idProduit) 
			 VALUES (:nom ,:adresse, :num, :idProduit)";
			 $db = new config();
             $conn=$db->getConnexion();
			 try{
			 	$query = $conn->prepare($sql);
			 	$query->execute([
					'nom' => $commande->getNom(),
				'adresse' => $commande->getAdresse(),
				'num' => $commande->getNum(),
		 		'idProduit' => $commande->getIdProduit(),
			]);			
			}
			catch (Exception $e){
			echo 'Erreur: '.$e->getMessage();
			}
		}
		
		function afficherCommande(){
			$sql="SELECT * FROM commande";
			$conn = new config();
            $db=$conn->getConnexion();
			try{
				$liste = $db->query($sql);
				return $liste;
			}
			catch (Exception $e){
				die('Erreur: '.$e->getMessage());
			}	
			
		}


        function supprimerCommande($idd){
			$sql="DELETE FROM commande WHERE id= :id";
			$conn = new config();
            $db=$conn->getConnexion();
			$req=$db->prepare($sql);
			$req->bindValue(':id',$idd);
			try{
				$req->execute();
			}
			catch (Exception $e){
				die('Erreur: '.$e->getMessage());
			}
		}

		function modifierCommande($commande,$idToUpdate){
			try {
				$conn = new config();
				$db = $conn->getConnexion();
				$query = $db->prepare(
					"UPDATE commande SET 
						nom = :nom,
						adresse = :adresse,
						num = :num,
						idProduit = :idProduit
						WHERE id = :id"
				);
		
				// Debugging: Output the SQL query
				echo $query->queryString;
		
				$query->execute([
					'id' => $idToUpdate, // Assuming you have a method like getId() in your commande class
					'nom' => $commande->getNom(),
					'adresse' => $commande->getAdresse(),
					'num' => $commande->getNum(),
					'idProduit' => $commande->getIdProduit()
				]);
		
				// Check the number of affected rows to see if the update was successful
				echo $query->rowCount() . " records updated successfully <br>";
			} catch (PDOException $e) {
				echo 'Error: ' . $e->getMessage(); // Output or log the error message
			}
		}
		
		function recupererCommande($idd){
			$sql = "SELECT * FROM commande WHERE id = :id";
			$conn = new config();
			$db = $conn->getConnexion();
			try {
				$query = $db->prepare($sql);
				$query->bindParam(':id', $idd);
				$query->execute();
		
				$commande = $query->fetch(PDO::FETCH_ASSOC);
				return $commande;
			} catch (PDOException $e) {
				die('Error: ' . $e->getMessage());
			}
		}
		

	}

?>