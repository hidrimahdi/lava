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
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "css";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Define the $tables array globally
$tables = ["categories", "movies", "ratings", "user_art", "user_vis"];

function displayTable($conn, $tableName, $stars = false) {
    global $tables;

    $result = $conn->query("SELECT * FROM $tableName");
    $rowCount = 0;

    if ($result) {
        echo "<h2>$tableName Table</h2>";
        echo "<table>";
        echo "<tr>";

        // Output table header
        $row = $result->fetch_assoc();
        if ($row) {
            foreach ($row as $key => $value) {
                echo "<th>$key</th>";
            }
            echo "<th>Action</th>";
            echo "</tr>";

            // Output table data and edit forms
            do {
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
                echo "<td><button onclick='showEditForm($rowCount)'>Edit</button></td>";
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
            } while ($row = $result->fetch_assoc());

            echo "</table>";
            echo "<p>Total Rows: $rowCount</p>";
            echo "<p>Last Updated: " . date("Y-m-d H:i:s") . "</p>";
        } else {
            echo "Empty result set for $tableName";  // Debugging statement
        }
    } else {
        echo "Error executing query: " . $conn->error;  // Debugging statement
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
    echo "No table selected";  // Debugging statement
}

$conn->close();
?>
<?php
include('dashboard2.php');
?>
<script>
function showEditForm(rowCount) {
    var editForms = document.getElementsByClassName('edit-form');
    for (var i = 0; i < editForms.length; i++) {
        editForms[i].style.display = 'none';
    }

    var selectedEditForm = document.getElementById('editForm' + rowCount);
    selectedEditForm.style.display = 'table-row';
}

function updateRow(rowCount, tableName) {
    var formData = new FormData();
    var editForm = document.getElementById('editForm' + rowCount);
    var inputs = editForm.getElementsByTagName('input');

    for (var i = 0; i < inputs.length; i++) {
        formData.append(inputs[i].name, inputs[i].value);
    }

    formData.append('table_name', tableName);
    formData.append('row_count', rowCount);

    // Send the data to the server using AJAX or form submission
    // You need to implement the server-side logic to update the row in the database

    // Example using Fetch API
    fetch('update_row.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Optional: Update the UI to reflect the changes
            console.log('Row updated successfully');
        } else {
            console.error('Failed to update row');
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}
function deleteRow(rowCount, tableName) {
    if (confirm('Are you sure you want to delete this row?')) {
        // Logic to delete the row
        fetch('delete_row.php', {
            method: 'POST',
            body: JSON.stringify({ row_count: rowCount, table_name: tableName }),
            headers: {
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Optional: Update the UI to reflect the changes
                console.log('Row deleted successfully');
                location.reload(); // Refresh the page after deletion
            } else {
                console.error('Failed to delete row');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
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