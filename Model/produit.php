<?PHP
	class produit {
		private $id;
		private $title;
		private $description;
		private $category;
		private $price;
		private $image;
	
		function __construct($title, $description, $category, $price, $image) {
			$this->title = $title;
			$this->description = $description;
			$this->category = $category;
			$this->price = $price;
			$this->image = $image;
		}
	
		function getID() {
			return $this->id;
		}
	
		function getTitle() {
			return $this->title;
		}
	
		function getDescription() {
			return $this->description;
		}
	
		function getCategory() {
			return $this->category;
		}
	
		function getPrice() {
			return $this->price;
		}
	
		public function getImage() {
			return $this->image;
		}
	
		function setTitle($title): void {
			$this->title = $title;
		}
	
		function setDescription($description): void {
			$this->description = $description;
		}
	
		function setCategory($category): void {
			$this->category = $category;
		}
	
		function setPrice($price): void {
			$this->price = $price;
		}
	
		function setImage($imagePath) {
			$this->image = $imagePath;
		}
	}
	
	

?>