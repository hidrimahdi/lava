<?php

include_once '../config.php';
class GlobalCrudController
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = config::getConnexion();;
    }
    public function GetDatafromTable($tableName)
    {
        $allowedTables = ["categories", "movies", "ratings", "users"];

        if (!in_array($tableName, $allowedTables)) {
            // Handle invalid table name (throw an exception, log an error, etc.)
            echo "Invalid table name";
            return;
        }
    
        // Prepare the statement
        $stmt = $this->pdo->prepare("SELECT * FROM $tableName");
    
        // Check if the preparation was successful
        if ($stmt) {
            // Execute the query
            $stmt->execute();

        // Get the result set
        $stmt->execute();

        // Fetch the results as an associative array
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $rows = [];

        // Fetch data and collect rows in the array
        // Return the array of rows
        return $result;
    }
}

public function createDataInTable($tableName, $data)
{
    $allowedTables = ["categories", "movies", "ratings", "users"];

    if (!in_array($tableName, $allowedTables)) {
        throw new InvalidArgumentException("Invalid table name");
    }

    try {
        $columns = implode(", ", array_keys($data));
        $values = ":" . implode(", :", array_keys($data));

        $stmt = $this->pdo->prepare("INSERT INTO $tableName ($columns) VALUES ($values)");

        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        $stmt->execute();

        return true;
    } catch (PDOException $e) {
        // Handle the exception (log, rethrow, etc.)
        throw new Exception("Error creating data in the table: " . $e->getMessage());
    }
}
public function updateRow($tableName, $id, $data)
{
    $allowedTables = ["categories", "movies", "ratings", "users"];

    if (!in_array($tableName, $allowedTables)) {
        throw new InvalidArgumentException("Invalid table name");
    }

    try {
        $setClause = "";
        foreach ($data as $key => $value) {
            $setClause .= "$key = :$key, ";
        }
        $setClause = rtrim($setClause, ", ");

        $stmt = $this->pdo->prepare("UPDATE $tableName SET $setClause WHERE id = :id");
        $stmt->bindParam(":id", $id);

        foreach ($data as $key => $value) {
            // Remove the "edit_" prefix
            $keyWithoutPrefix = preg_replace('/^edit_/', '', $key);
            $stmt->bindValue(":$keyWithoutPrefix", $value);
        }

        $stmt->execute();

        return true;
    } catch (PDOException $e) {
        // Handle the exception (log, rethrow, etc.)
        throw new Exception("Error updating data in the table: " . $e->getMessage());
    }
}
public function UpdateDataInTable($tableName, $data)
{
    $allowedTables = ["categories", "movies", "ratings", "users"];

    if (!in_array($tableName, $allowedTables)) {
        throw new InvalidArgumentException("Invalid table name");
    }

    try {
        $setClause = "";
        foreach ($data as $key => $value) {
            $setClause .= "$key = :$key, ";
        }
        $setClause = rtrim($setClause, ", ");

        $stmt = $this->pdo->prepare("UPDATE $tableName SET $setClause WHERE id = :id");
        $stmt->bindParam(":id", $id);

        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        $stmt->execute();

        return true;
    } catch (PDOException $e) {
        // Handle the exception (log, rethrow, etc.)
        throw new Exception("Error updating data in the table: " . $e->getMessage());
    }
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

public function deleteDataFromTable($tableName, $id)
{
    $allowedTables = ["categories", "movies", "ratings", "users"];

    if (!in_array($tableName, $allowedTables)) {
        throw new InvalidArgumentException("Invalid table name");
    }

    try {
        $stmt = $this->pdo->prepare("DELETE FROM $tableName WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        return true;
    } catch (PDOException $e) {
        // Handle the exception (log, rethrow, etc.)
        throw new Exception("Error deleting data from the table: " . $e->getMessage());
    }
}
public function getMostRatedMovies()
{
    try {
        // Prepare the statement
        $stmt = $this->pdo->prepare("SELECT m.name, COUNT(r.id) AS rating_count
                                     FROM movies m
                                     LEFT JOIN ratings r ON m.id = r.movie_id
                                     GROUP BY m.name
                                     ORDER BY rating_count DESC
                                     LIMIT 5");

        // Execute the query
        $stmt->execute();

        // Fetch the results as an associative array
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    } catch (PDOException $e) {
        // Handle the exception (log, rethrow, etc.)
        throw new Exception("Error fetching most rated movies: " . $e->getMessage());
    }
}
public function getMostUsedCategories()
{
    try {
        $mostUsedCategoriesQuery = "SELECT c.name, COUNT(m.id) AS movie_count
                                    FROM categories c
                                    LEFT JOIN movies m ON c.id = m.category_id
                                    GROUP BY c.name
                                    ORDER BY movie_count DESC
                                    LIMIT 5";

        $stmt = $this->pdo->prepare($mostUsedCategoriesQuery);
        $stmt->execute();

        // Fetch the results as an associative array
        $resultCategories = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $resultCategories;
    } catch (PDOException $e) {
        // Handle the exception (log, rethrow, etc.)
        throw new Exception("Error fetching most used categories: " . $e->getMessage());
    }
}

}
?>
