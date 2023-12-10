<?php
require_once('../config.php');

class RatingC
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = config::getConnexion();
    }

    public function addReview($movieId, $username, $comment, $rating)
    {
        try {
            // You might want to add additional validation and error handling here

            // SQL statement to insert a new review
            $sql = "INSERT INTO ratings (movie_id, username, comment, rating) VALUES (:movieId, :username, :comment, :rating)";
            
            // Prepare the statement
            $stmt = $this->pdo->prepare($sql);
            
            // Bind parameters
            $stmt->bindParam(':movieId', $movieId, PDO::PARAM_INT);
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
            $stmt->bindParam(':rating', $rating, PDO::PARAM_INT);

            // Execute the statement
            $stmt->execute();
            echo "<script>alert('Review added successfully!');</script>";
            header("Refresh: 0; URL=EventDetailsView.php?id=".$movieId);

        } catch (PDOException $e) {
            // Handle exceptions or log errors
            echo "Error: " . $e->getMessage();
        }
    }
    public function getMovieRatings($movieId)
{
    $sql = "SELECT * FROM ratings WHERE movie_id = :movieId";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindParam(':movieId', $movieId, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
}
?>
