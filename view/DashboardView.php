<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Database</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            padding: 20px;
            background-color: #f4f4f4;
        }
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .edit-form {
            display: none;
            background-color: #f9f9f9;
            padding: 10px;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<?php
include "../config.php";
$conn = config::getConnexion();
include "../controller/GlobalCrudController.php";
// Define the $tables array globally
$tables = ["categories", "movies", "ratings", "users"];

function renderEntityForm($attributes, $formAction) {
    echo "<form method='post' action='$formAction' class='form'>";
    echo "<div class='form-row'>";

    foreach ($attributes as $attribute) {
        $fieldName = strtolower(str_replace(' ', '_', $attribute)); // Convert attribute names to lowercase and replace spaces with underscores
        echo "<div class='form-group col-md-6'>";
        echo "<label for='$fieldName'>$attribute</label>";
        echo "<input type='text' class='form-control' id='$fieldName' name='edit_$fieldName' required>";
        echo "</div>";
    }

    echo "</div>";
    echo "<button type='submit' class='btn btn-primary'>Create Entity</button>";
    echo "</form>";
}
function displayTable($conn, $tableName, $stars = true) {
    global $tables;
    $c = new GlobalCrudController();
    $result = $c->getDatafromTable($tableName);
    $rowCount = 0;
    // Assuming $data is your array of data
    $data = $result;
    if ($data) {
        echo "<h2>$tableName Table</h2>";
        echo "<table>";
        echo "<tr>";
    
        // Output table header
        $row = reset($data);
        if ($row) {
            foreach ($row as $key => $value) {
                echo "<th>$key</th>";
            }
            echo "<th>Action</th>";
            echo "</tr>";
    
            // Output table data and edit forms
            $rowCount = 0;
            foreach ($data as $row) {
                $rowCount++;
                echo "<tr>";
                foreach ($row as $key => $value) {
                    echo "<td>";
                    if ($stars && $key === "rate") {
                        echo str_repeat("★", $value);
                    } else {
                        echo $value;
                    }
                    echo "</td>";
                }
                $id=$data[$rowCount-1]['id'];
                //var_dump($row['id'][0]);
                echo "<td><button onclick='showEditForm($rowCount)'>Edit</button></td>";
                echo "<td><button onclick='showDeleteForm($id,\"$tableName\")'>Delete</button></td>";

                echo "</tr>";
    
                // Edit form for each row
                echo "<tr class='edit-form' id='editForm$rowCount'>";
                foreach ($row as $key => $value) {
                    echo "<td>";
                    echo "<input type='text' name='edit_$key' value='$value'>";

                    echo "</td>";
                    
                }
                echo "<td><button onclick='updateRow($rowCount, \"$tableName\")'>Update</button></td>";
                echo "</tr>";
            }
    
            echo "</table>";
            echo "<p>Total Rows: $rowCount</p>";
            echo "<p>Last Updated: " . date("Y-m-d H:i:s") . "</p>";
            echo "<h2>Create New $tableName</h2>";
            renderEntityForm(array_keys($row), "create_entity.php?table_name=$tableName");
        } else {
            echo "Empty result set for $tableName";  // Debugging statement
        }
    } else {
        echo "Error: Data is empty";  // Debugging statement
    }
    
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['selected_table'])) {
    $selectedTable = $_POST['selected_table'];
    if (in_array($selectedTable, $tables)) {
        displayTable($conn, $selectedTable, $selectedTable === "movies");
    } else {
        echo "Invalid table selection";  // Debugging statement
    }
} else {
    if (!isset($_GET['selected_table']))
    echo "No table selected";  // Debugging statement
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['selected_table'])) {
    echo "<script>alert('success!');</script>";

    $selectedTable = $_GET['selected_table'];
    if (in_array($selectedTable, $tables)) {
        displayTable($conn, $selectedTable, $selectedTable === "movies");
    } else {
        echo "Invalid table selection";  // Debugging statement
    }
} else {
    echo "No table selected";  // Debugging statement
}

?>

<div class="container">
    <div class="widget">
        <?php
      
        $c = new GlobalCrudController();
        $resultEvents = $c->getMostRatedMovies();

        // Display most rated events
        echo "<h2>Most Rated Events</h2>";
        echo "<ol>";
        foreach ($resultEvents as $row) {
            echo "<li>" . $row["name"] . " (Rank: " . $row["rating_count"] . ")</li>";
        }
        echo "</ol>";

        // Close the connection
        ?>
    </div>

    <div class="widget">
        <?php
        // Database connection
       
        // Get most used categories
   
        $c = new GlobalCrudController();
        $resultCategories = $c->getMostUsedCategories();

        // Display most used categories
        echo "<h2>Most Used Categories</h2>";
        echo "<ol>";
        
        foreach ($resultCategories as $row) {
            echo "<li>" . $row["name"] . " (Rank: " . $row["movie_count"] . ")</li>";
        }
        
        echo "</ol>";

        ?>
    </div>
</div>
<script>
function showEditForm(rowCount) {
    var editForms = document.getElementsByClassName('edit-form');
    for (var i = 0; i < editForms.length; i++) {
        editForms[i].style.display = 'none';
    }

    var selectedEditForm = document.getElementById('editForm' + rowCount);
    selectedEditForm.style.display = 'table-row';
}
function showDeleteForm(id,tablename) {
    var url = './deleterow.php?table_name=' + encodeURIComponent(tablename) + '&id=' + encodeURIComponent(id);

    console.log(url)
// Redirect to the URL with a GET request
window.location.href = url;
}

function updateRow(rowCount, tableName) {
    var editForm = document.getElementById('editForm' + rowCount);
    var inputs = editForm.getElementsByTagName('input');
    var queryParams = [];

    for (var i = 0; i < inputs.length; i++) {
        queryParams.push(encodeURIComponent(inputs[i].name) + '=' + encodeURIComponent(inputs[i].value));
    }

    var queryString = queryParams.join('&');
    var url = './updaterow.php?' + queryString + '&table_name=' + encodeURIComponent(tableName) + '&row_count=' + encodeURIComponent(rowCount);

    // Redirect to the URL with a GET request
    window.location.href = url;
}

</script>

<form method="post" action="">
    <label for="table_select">Select a Table:</label>
    <select id="table_select" name="selected_table">
        <?php
        foreach ($tables as $table) {
            echo "<option value='$table'>$table</option>";
        }
        ?>
    </select>
    <button type="submit">Show Table</button>
</form>

</body>
</html>
