<?php 
include('../config.php');
class CategoryC
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = config::getConnexion();
    }
    public function getAllCategories()
    {
        $categorySql = "SELECT * FROM categories";
        $categoryStmt = $this->pdo->query($categorySql);
        $categories = $categoryStmt->fetchAll(PDO::FETCH_ASSOC);
        return $categories;
    }
    public function deleteCategory($categoryId)
    {
        // Use prepared statements to prevent SQL injection
        $sql = "DELETE FROM categories WHERE id = :category_id";

        // Prepare the statement
        $stmt = $this->pdo->prepare($sql);

        // Bind the parameter
        $stmt->bindParam(':category_id', $categoryId, PDO::PARAM_INT);

        try {
            // Execute the query
            $stmt->execute();

            // Return true if the deletion was successful
            return true;
        } catch (PDOException $e) {
            // Handle the exception (log, rethrow, etc.)
            throw new Exception("Error deleting category: " . $e->getMessage());
        }
    }
    public function getMoviesWithCategories()
    {
        // Fetch categories
        $categories = $this->getAllCategories();
        // Fetch movies along with category information
        $sql = "SELECT movies.*, categories.name AS category_name FROM movies 
                LEFT JOIN categories ON movies.category_id = categories.id";
        $stmt = $this->pdo->query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Combine movies and categories
        $moviesWithCategories = [];
        foreach ($result as $movie) {
            $categoryId = $movie['category_id'];
            $category = array_filter($categories, function ($cat) use ($categoryId) {
                return $cat['id'] == $categoryId;
            });

            $movie['category_name'] = reset($category)['name'];
            $moviesWithCategories[] = $movie;
        }

        return $moviesWithCategories;
    }
    public function getMoviesByCategory($category_id)
    {
        // Use prepared statements to prevent SQL injection
        $sql = "SELECT movies.*, categories.name AS category_name 
                FROM movies 
                LEFT JOIN categories ON movies.category_id = categories.id 
                WHERE movies.category_id = :category_id";

        // Prepare the statement
        $stmt = $this->pdo->prepare($sql);

        // Bind the parameter
        $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);

        // Execute the query
        $stmt->execute();

        // Fetch the results as an associative array
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
    public function createCategory($categoryName)
    {
        // Use prepared statements to prevent SQL injection
        $sql = "INSERT INTO categories (name) VALUES (:category_name)";

        // Prepare the statement
        $stmt = $this->pdo->prepare($sql);

        // Bind the parameter
        $stmt->bindParam(':category_name', $categoryName, PDO::PARAM_STR);

        try {
            // Execute the query
            $stmt->execute();

            // Return the ID of the newly inserted category
            return $this->pdo->lastInsertId();
        } catch (PDOException $e) {
            // Handle the exception (log, rethrow, etc.)
            throw new Exception("Error creating category: " . $e->getMessage());
        }
    }
}
