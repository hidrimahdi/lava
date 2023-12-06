<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            grid-gap: 20px;
        }
        .widget {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            margin-top: 0;
            margin-bottom: 15px;
            color: #333333;
        }
        ol {
            padding-left: 20px;
            margin: 0;
        }
        li {
            margin-bottom: 5px;
            color: #666666;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="widget">
        <?php
        // Database connection
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "css";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Get most rated events
        $mostRatedEventsQuery = "SELECT m.name, COUNT(r.id) AS rating_count
                                FROM movies m
                                LEFT JOIN ratings r ON m.id = r.movie_id
                                GROUP BY m.name
                                ORDER BY rating_count DESC
                                LIMIT 5"; // Change the limit as needed

        $resultEvents = $conn->query($mostRatedEventsQuery);

        // Display most rated events
        echo "<h2>Most Rated Events</h2>";
        echo "<ol>";
        while ($row = $resultEvents->fetch_assoc()) {
            echo "<li>" . $row["name"] . " (Rank: " . $row["rating_count"] . ")</li>";
        }
        echo "</ol>";

        // Close the connection
        $conn->close();
        ?>
    </div>

    <div class="widget">
        <?php
        // Database connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Get most used categories
        $mostUsedCategoriesQuery = "SELECT c.name, COUNT(m.id) AS movie_count
                                    FROM categories c
                                    LEFT JOIN movies m ON c.id = m.category_id
                                    GROUP BY c.name
                                    ORDER BY movie_count DESC
                                    LIMIT 5"; // Change the limit as needed

        $resultCategories = $conn->query($mostUsedCategoriesQuery);

        // Display most used categories
        echo "<h2>Most Used Categories</h2>";
        echo "<ol>";
        while ($row = $resultCategories->fetch_assoc()) {
            echo "<li>" . $row["name"] . " (Rank: " . $row["movie_count"] . ")</li>";
        }
        echo "</ol>";

        // Close the connection
        $conn->close();
        ?>
    </div>
</div>

</body>
</html>
