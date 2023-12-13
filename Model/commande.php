<?PHP
	class commande{
		private $id;
		private $nom;
		private $adresse;
		private $num;
        private $idProduit;	

		
		function __construct(  $nom , $adresse ,$num,$idProduit)
        {
            $this->nom = $nom;
            $this->adresse = $adresse;
            $this->num = $num;
			$this->idProduit = $idProduit;

		}
		
		function getID(){
			return $this->id;
		}
		function getNom(){
			return $this->nom;
		}
		function getAdresse(){
			return $this->adresse;
		}
		
        function getnum(){
			return $this->num;
		}
		function getIdProduit(){
			return $this->idProduit;
		}
       
		
		function setID($id): void{
			$this->id=$id;
		}
		function setNom($nom): void{
			$this->nom=$nom;
		}
		
        function setAdresse($adresse): void{
			$this->adresse=$adresse;
		}
		function setNum($num): void{
			$this->num=$num;
		}
		function setIdProduit($idProduit): void{
			$this->idProduit=$idProduit;
		}
		
       
	}

?>