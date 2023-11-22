<?PHP
	class produit{
		private $id;
		private $title;
		private $category;
        private $description;
		private $price;	
		function __construct( $title, $category,$description,$price)
        {
            $this->title = $title;
            $this->category = $category;
            $this->description = $description;
			$this->price = $price;
		}
		
		function getID(){
			return $this->id;
		}
		function getTitle(){
			return $this->title;
		}
		function getDescription(){
			return $this->description;
		}
		
        function getCategory(){
			return $this->category;
		}
		function getPrice(){
			return $this->price;
		}
       
		
		function setTitle($title): void{
			$this->title=$title;
		}
		function setDescription($description): void{
			$this->description=$description;
		}
		
        function setCategory($category): void{
			$this->category=$category;
		}
		function setPrice($price): void{
			$this->price=$price;
		}
       
	}

?>