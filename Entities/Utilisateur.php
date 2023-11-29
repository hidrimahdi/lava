<?PHP
	class utilisateur{
		private $id;
		private $nom;
		private $prenom;
		private $role;
		private $mail;
		private $mp;


		function __construct($id ,$nom, $prenom, $role, $mail, $mp){
			
			$this->id=$id;
			$this->nom=$nom;
			$this->prenom=$prenom;
			$this->role=$role;
			$this->mail=$mail;
			$this->mp=$mp;
			// $this->image=$image;

		}

		public function getid (){
            return $this->id ;
        }
		// public function getimage (){
        //     return $this->image ;
        // }

		public function getnom (){
            return $this->nom ;
        }
		public function getprenom (){
            return $this->prenom ;
        }

		public function getrole (){
            return $this->role ;
        }
		public function getmail (){
            return $this->mail ;
        }
		public function getmp (){
            return $this->mp ;
        }


	}
?>