<?php include 'test.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Liste des clients</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h2>Liste des clients</h2>

<?php
$clients = $pdo->query("SELECT * FROM CLIENTS")->fetchAll();

if (count($clients) === 0) {
    echo "<p class='warning'>Aucun client trouvé.</p>";
} else {
    echo "<table class='table'>";
    echo "<tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Sexe</th>
                <th>Date de naissance</th>
              </tr>";
    foreach ($clients as $client) {
        echo "<tr>
                    <td>{$client['nom']}</td>
                    <td>{$client['prenom']}</td>
                    <td>{$client['sexe']}</td>
                    <td>{$client['date_naissance']}</td>
                  </tr>";
    }
    echo "</table>";
}
?>
</body>
</html>
