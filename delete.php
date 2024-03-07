<?php
include 'connectie.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $sql = "DELETE FROM contacten WHERE id = :id";
    $stmt = $conn->prepare($sql);
    
    // Bind the parameter using the correct variable
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    // Execute the statement
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo "Record successfully deleted.";
    } else {
        echo "Error deleting record.";
    }
} else {
    echo "Invalid request.";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <br>
    <a href="index.php">terug naar home page</a>
</body>
</html>
