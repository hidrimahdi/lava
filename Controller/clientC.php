<?php 
	include "../config.php";
	
	class clientC
	{

		function connexionUser($login,$password){
            $sql="SELECT * FROM compte  WHERE mail='" . $login . "' and mp = '". $password."'";
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

		
		public function ajouterclient($client)
		{
			$sql="INSERT INTO compte (id, Sexe, Nom, Prenom, num_tel, mail, adresse, date_anniversaire,mp ,type) VALUES (:id,:Sexe,:Nom,:Prenom,:num_tel,:mail,:adresse,:date_anniversaire,:mp , :type);";
			$connexion=config::getConnexion();
			$rep=$connexion->prepare($sql);
			$rep->bindValue(":id",$client->getid());
			$rep->bindValue(":Sexe",$client->getSexe());
			$rep->bindValue(":Nom",$client->getNom());
			$rep->bindValue(":Prenom",$client->getPrenom());
			$rep->bindValue(":num_tel",$client->getnum_tel());
			$rep->bindValue(":mail",$client->getmail());
			$rep->bindValue(":adresse",$client->getadresse());
			$rep->bindValue(":date_anniversaire", $client->getdate_anniversaire()->format('Y-m-d')); // Formatage de la date en chaîne de caractères
			$rep->bindValue(":mp",$client->getmp());
			$rep->bindValue(":type","user");
			$rep->execute();

		}
			

		public function afficherclient()
{
    $sql = 'SELECT * FROM compte WHERE type LIKE "user"';
    $connexion = config::getConnexion();
    $rep = $connexion->query($sql);
    return $rep;
}
		
			public function modifierClient($client,$id)
    		{
      			
       			$sql="UPDATE compte SET Sexe=:Sexe,Nom=:Nom,Prenom=:Prenom,num_tel=:num_tel,mail=:mail,adresse=:adresse,date_anniversaire=:date_anniversaire, mp=:mp WHERE id=:id";
       			$connexion=config::getConnexion();
				$rep=$connexion->prepare($sql);
                $rep->bindValue(":id",$id);
				$rep->bindValue(":Sexe",$client->getSexe());
				$rep->bindValue(":Nom",$client->getNom());
				$rep->bindValue(":Prenom",$client->getPrenom());
				$rep->bindValue(":num_tel",$client->getnum_tel());
				$rep->bindValue(":mail",$client->getmail());
				$rep->bindValue(":adresse",$client->getadresse());
				$rep->bindValue(":date_anniversaire",$client->getdate_anniversaire());
				$rep->bindValue(":mp",$client->getmp());
				$rep->execute();
    		}
	

		public function supprimerclient($id)
			{
				$sql="DELETE FROM compte WHERE id= :id";
				$db =config::getConnexion();
				$req=$db->prepare($sql);
				$req->bindValue(":id",$id);
				try{
				$req->execute();
					}
				catch (Exception $e){
				die('Erreur: '.$e->getMessage());
				}
			}	
	
			

	function calculerClient($Sexe)
	{
		$sql="SELECT * FROM compte WHERE Sexe='$Sexe'";
		$db = config::getConnexion();
		try{
		$liste=$db->query($sql);
		$nombre=$liste->rowCount();
		return $nombre;
		}
		catch (Exception $e){
			die('Erreur: '.$e->getMessage());
		}
	}

	function afficherid($mail){
			
		$sql="SELECT * From compte  WHERE mail= '$mail' ";
		$db = config::getConnexion();
		try{
		$liste=$db->query($sql);
		return $liste;
		}
		catch (Exception $e){
			die('Erreur: '.$e->getMessage());
		}	
	}
	function recupId($id){
		$sql="SELECT * from compte where id='$id' AND type LIKE 'user'";
		$db =config::getConnexion();
		try{
		$liste=$db->query($sql);
		return $liste;
		}
		catch (Exception $e){
			die('Erreur: '.$e->getMessage());
		}
	}

	function recupMail($mail){
		$sql="SELECT * from compte where mail='$mail' AND type LIKE 'user'";
		$db =config::getConnexion();
		try{
		$liste=$db->query($sql);
		return $liste;
		}
		catch (Exception $e){
			die('Erreur: '.$e->getMessage());
		}
	}

	function recupNum_tel($num_tel){
		$sql="SELECT * from compte where num_tel='$num_tel' AND type LIKE 'user'";
		$db =config::getConnexion();
		try{
		$liste=$db->query($sql);
		return $liste;
		}
		catch (Exception $e){
			die('Erreur: '.$e->getMessage());
		}
	}

	function recupNom($Nom){
		$sql="SELECT * from compte where nom='$Nom' AND type LIKE 'user'";
		$db =config::getConnexion();
		try{
		$liste=$db->query($sql);
		return $liste;
		}
		catch (Exception $e){
			die('Erreur: '.$e->getMessage());
		}
	}
	

	function recupPrenom($Prenom){
		$sql="SELECT * from compte where prenom='$Prenom' AND type LIKE 'user'";
		$db =config::getConnexion();
		try{
		$liste=$db->query($sql);
		return $liste;
		}
		catch (Exception $e){
			die('Erreur: '.$e->getMessage());
		}
	}


function recupSexe($sexe){
	$sql="SELECT * from compte where sexe='$sexe' AND type LIKE 'user'";
	$db =config::getConnexion();
	try{
	$liste=$db->query($sql);
	return $liste;
	}
	catch (Exception $e){
		die('Erreur: '.$e->getMessage());
	}
}

function recupAdresse($adresse){
	$sql = "SELECT * FROM compte WHERE adresse='$adresse' AND type LIKE 'user'";
	$db = config::getConnexion();
	try {
		$liste = $db->query($sql);
		return $liste;
	}
	catch (Exception $e) {
		die('Erreur: ' . $e->getMessage());
	}
}





}
?> 