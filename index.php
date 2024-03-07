<?php

include 'connectie.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST['naam']) || empty($_POST['achternaam']) || empty($_POST['geboortedatum']) || empty($_POST['email']) || empty($_POST['telefoonnummer'])) {
        echo "vul alle fields in.";
    } else {
        $sql = "INSERT INTO contacten VALUES (:id, :naam, :email, :adres, :geboortedatum)";
        $stmt = $conn->prepare($sql);

        $data = [
            "id" => null,
            "naam" => $_POST['naam'],
            "achternaam" => $_POST['achternaam'],
            "geboortedatum" => $_POST['geboortedatum'],
            "email" => $_POST['email'],
        ];
        $stmt->execute($data);
        if ($stmt->rowcount() == 0) {
            echo "error niet toegevoegd.";
        } else {
            echo "gelukt";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact List</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>

<body>
    <div class="header">
        <img src="image.png" alt="">
        <a class="new-link" href="add_contact.php">Nieuwe</a>
    </div>

    <table>
        <tr>
            <th>Naam</th>
            <th>Email</th>
            <th>Adres</th>
            <th>Geboortedatum</th>
            <th colspan="2">Acties</th>
        </tr>
        <?php
        $sql = $conn->query("select * from contacten");
        while ($row = $sql->fetch()) { ?>
            <tr>
                <td>
                    <?php echo $row['naam']; ?>
                </td>
                <td>
                    <?php echo $row['email']; ?>
                </td>
                <td>
                    <?php echo $row['adres']; ?>
                </td>
                <td>
                    <?php echo date('d-m-Y', strtotime($row['geboortedatum'])); ?>
                </td>
                <td><a class="edit" href="edit.php?id=<?php echo $row['id']; ?>">✎</a></td>
                <td><a class="delete" href="delete.php?id=<?php echo $row['id']; ?>">🗑</a></td>
            </tr>
        <?php } ?>
    </table>
</body>

</html>