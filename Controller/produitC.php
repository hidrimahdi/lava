<?PHP
	
	include_once ("C:/xampp/htdocs/Project/config.php");
	include ("C:/xampp/htdocs/Project/Dashbord/Model/produit.php");

	class produitC {
		function ajouterProduit($produit) {
			$sql = "INSERT INTO produit (id, title, description, idcad, price, image) 
					VALUES (:id, :title, :description, :idcad, :price, :image)";
			$db = new config();
			$conn = $db->getConnexion();
			
			try {
				$query = $conn->prepare($sql);
				$query->execute([
					'id' => $produit->getID(),
					'title' => $produit->getTitle(),
					'description' => $produit->getDescription(),
					'idcad' => $produit->getCategory(),
					'price' => $produit->getPrice(),
					'image' => $produit->getImage()
				]);         
			} catch (Exception $e) {
				echo 'Erreur: ' . $e->getMessage();
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

		function modifierProduit($produit, $idToUpdate) {
			try {
				$conn = new config();
				$db = $conn->getConnexion();
				$query = $db->prepare(
					"UPDATE produit SET 
					title = :title,
					description = :description,
					idcad = :idcad,
					price = :price
					WHERE id = :id"
				);
	
				// Associer les valeurs des paramètres
				$title = $produit->getTitle();
				$description = $produit->getDescription();
				$idcad = $produit->getCategory(); // Ajout de cette ligne pour déclarer $idcad
				$price = $produit->getPrice();
	
				$query->bindParam(':title', $title);
				$query->bindParam(':description', $description);
				$query->bindParam(':idcad', $idcad); // Utilisation de $idcad
				$query->bindParam(':price', $price);
				$query->bindParam(':id', $idToUpdate);
	
				// Exécuter la requête
				$query->execute();
	
				// Vérifier le nombre de lignes affectées pour confirmer la mise à jour
				echo $query->rowCount() . " records updated successfully <br>";
			} catch (PDOException $e) {
				echo 'Error: ' . $e->getMessage(); // Afficher ou journaliser le message d'erreur
			}
		}
		

		
		function recupererProduit($idd) {
			$sql = "SELECT * FROM produit WHERE id = :id";
			$conn = new config();
			$db = $conn->getConnexion();
			
			try {
				$query = $db->prepare($sql);
				$query->bindParam(':id', $idd);
				$query->execute();
				
				// Fetch the result and create a product object
				$row = $query->fetch(PDO::FETCH_ASSOC);
				
				if ($row) {
					$produit = new produit(
						$row['title'],
						$row['description'],
						$row['idCad'],
						$row['price'],
						$row['image']
					);
					
					return $produit;
				} else {
					return null; // Si aucun produit correspondant à l'ID n'est trouvé
				}
			} catch (PDOException $e) {
				// Gérer l'erreur de manière appropriée, par exemple :
				error_log('Error: ' . $e->getMessage()); // Enregistrer l'erreur dans les logs
				// Vous pouvez également afficher un message d'erreur à l'utilisateur ou faire d'autres actions en cas d'erreur.
				return null; // En cas d'erreur, retourner null ou gérer l'erreur selon vos besoins
			}
		}
		

		
		
		
		
		
function filterByCategory($category, $conn = null) {
	$query = "SELECT * FROM produit WHERE idcad = :idcad"; // Correction ici
	$stmt = $conn->prepare($query);
	$stmt->bindParam(':idcad', $category); // Correction ici
	$stmt->execute();
	
	$filteredProducts = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $filteredProducts;
}
		function filterByPriceRange($minPrice = null, $maxPrice = null, $conn = null) {
			$query = "SELECT * FROM produit WHERE 1 = 1";
		
			if ($minPrice !== null && $maxPrice !== null) {
				$query .= " AND price BETWEEN :minPrice AND :maxPrice";
			} elseif ($minPrice !== null) {
				$query .= " AND price >= :minPrice";
			} elseif ($maxPrice !== null) {
				$query .= " AND price <= :maxPrice";
			}
		
			$stmt = $conn->prepare($query);
		
			if ($minPrice !== null && $maxPrice !== null) {
				$stmt->bindParam(':minPrice', $minPrice);
				$stmt->bindParam(':maxPrice', $maxPrice);
			} elseif ($minPrice !== null) {
				$stmt->bindParam(':minPrice', $minPrice);
			} elseif ($maxPrice !== null) {
				$stmt->bindParam(':maxPrice', $maxPrice);
			}
		
			$stmt->execute();
			$filteredProducts = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
			return $filteredProducts;
		}

		public function modifierCheminImage($produitId, $nouveauCheminImage) {
			try {
				$config = new config();
				$pdo = $config->getConnexion();
				
				// Préparer la requête SQL pour mettre à jour le chemin de l'image
				$requete = $pdo->prepare("UPDATE produit SET image = ? WHERE id = ?");
				$requete->execute([$nouveauCheminImage, $produitId]);
		
				// Vérifier si la mise à jour a été effectuée avec succès
				if ($requete->rowCount() > 0) {
					echo "Chemin de l'image mis à jour avec succès pour le produit ID : " . $produitId;
					// Vous pouvez ajouter d'autres actions ici si nécessaire
				} else {
					echo "Aucune modification effectuée pour le produit ID : " . $produitId;
				}
			} catch(PDOException $e) {
				echo "Erreur : " . $e->getMessage();
			}
		}
		

	

	public function getAllCategories() {
        // Connexion à la base de données ou chargement des données de catégorie depuis un fichier, etc.
        
        // Exemple: récupération des catégories depuis la base de données
        $conn = new config(); // supposons que config est votre classe de connexion à la base de données
        $db = $conn->getConnexion();
        
        $sql = "SELECT * FROM categories"; // Supposons que vos catégories soient stockées dans une table 'categories'
        $query = $db->query($sql);
        
        $categories = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $categories[] = $row;
        }
        
        return $categories;
    }
	}

?>