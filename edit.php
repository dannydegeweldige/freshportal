<?php
include 'connectie.php';

$warning = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST['naam']) || empty($_POST['email']) || empty($_POST['adres']) || empty($_POST['geboortedatum'])) {
        $warning = "Vul alle velden in.";
    } else {
        $sql = "UPDATE contacten
        SET naam =:naam,  email =:email, adres =:adres, geboortedatum =:geboortedatum
        WHERE id =:id";
        $stmt = $conn->prepare($sql);

        $data = [
            ":id" => $_GET['id'],
            ":naam" => $_POST['naam'],
            ":email" => $_POST['email'],
            ":adres" => $_POST['adres'],
            ":geboortedatum" => $_POST['geboortedatum'],
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