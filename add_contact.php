<?php
include 'connectie.php';

$warning = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST['naam']) || empty($_POST['email']) || empty($_POST['adres']) || empty($_POST['geboortedatum'])) {
        $warning = "Vul alle velden in.";
    } else {
        $sql = "INSERT INTO contacten VALUES (:contact_id, :naam, :email, :adres, :geboortedatum)";
        $stmt = $conn->prepare($sql);

        $data = [
            "contact_id" => null,
            "naam" => $_POST['naam'],
            "email" => $_POST['email'],
            "adres" => $_POST['adres'],
            "geboortedatum" => $_POST['geboortedatum'],
        ];
        try {
            $stmt->execute($data);
            header("Location: index.php");
            exit;
        } catch (PDOException $e) {
            if ($e->errorInfo[1] == 1062) { // MySQL error code for duplicate entry
                $warning = "Error: Email already exists.";
            } else {
                $warning = "Error: Niet toegevoegd.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles/form.css">
</head>

<body>
    <form name="alfa" method="POST">
        <?php
        if (!empty($warning)) {
            echo '<div style="color: red;">' . $warning . '</div>';
        }
        ?>
        <input type="text" name="naam" placeholder="naam"><br>
        <input type="text" name="email" placeholder="email"><br>
        <input type="text" name="adres" placeholder="adres"><br>
        <input type="date" name="geboortedatum" placeholder="geboortedatum"><br>
        <input type="submit">
        <a href="index.php">Go back to index</a>
    </form>
</body>

</html>
