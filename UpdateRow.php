<?php 
include ("../controller/GlobalCrudController.php");
// Instantiate the controller

$crudController = new GlobalCrudController();

// Extract data from the GET parameters
$tableName = $_GET['table_name'];
$rowCount = $_GET['row_count'];

// Remove "edit_" prefix from input names and the table_name
$data = [];
foreach ($_GET as $key => $value) {
    if ($key !== 'table_name' && $key !== 'row_count') {
        $keyWithoutPrefix = preg_replace('/^edit_/', '', $key);
        $data[$keyWithoutPrefix] = $value;
    }
}

// Execute the update
try {
    $crudController->updateRow($tableName, $rowCount, $data);
    echo "<script>alert('entity updated with success!');</script>";
    header("Location: DashboardView.php?selected_table=".$tableName);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Failed to update row: ' . $e->getMessage()]);
}