<?PHP
	
	include_once ("C:/xampp/htdocs/Project/config.php");
	include ("C:/xampp/htdocs/Project/Dashbord/Model/produit.php");

	class produitC {
		function ajouterProduit($produit){
			 $sql="INSERT INTO produit ( title, category, description, price) 
			 VALUES (:title, :category, :description, :price)";
			 $db = new config();
             $conn=$db->getConnexion();
			 try{
			 	$query = $conn->prepare($sql);
			 	$query->execute([
				'title' => $produit->getTitle(),
				'category' => $produit->getCategory(),
				'description' => $produit->getDescription(),
				'price' => $produit->getPrice()
			]);			
			}
			catch (Exception $e){
			echo 'Erreur: '.$e->getMessage();
			}
		}
		
		function afficherProduit(){
			$sql="SELECT * FROM produit";
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


        function supprimerProduit($idd){
			$sql="DELETE FROM produit WHERE id= :id";
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

		function modifierProduit($produit,$idToUpdate){
			try {
				$conn = new config();
				$db = $conn->getConnexion();
				$query = $db->prepare(
					"UPDATE produit SET 
						title=:title,
						category=:category,
						description=:description,
						price=:price
						WHERE id=:id"
				);
		
				// Debugging: Output the SQL query
				echo $query->queryString;
		
				$query->execute([
					'id' => $idToUpdate, // Assuming you have a method like getId() in your Reclamation class
					'title' => $produit->getTitle(),
					'category' => $produit->getCategory(),
					'description' => $produit->getDescription(),
					'price' => $produit->getPrice()
				]); 
				
		
				// Check the number of affected rows to see if the update was successful
				echo $query->rowCount() . " records updated successfully <br>";
			} catch (PDOException $e) {
				echo 'Error: ' . $e->getMessage(); // Output or log the error message
			}
		}
		
		function recupererProduit($idd){
			$sql = "SELECT * FROM produit WHERE id = :id";
			$conn = new config();
			$db = $conn->getConnexion();
			try {
				$query = $db->prepare($sql);
				$query->bindParam(':id', $idd);
				$query->execute();
		
				$produit = $query->fetch(PDO::FETCH_ASSOC);
				return $produit;
			} catch (PDOException $e) {
				die('Error: ' . $e->getMessage());
			}
		}
		

	}

?>