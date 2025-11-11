<?php include 'test.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Liste des clients</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h2>Liste des clients</h2>


<div class="actions">
    <a href="AjouterUnClient.php" class="btn btn-primary">Ajouter un client</a>
    <a href="AjouterFacture.php" class="btn btn-warning">Ajouter une facture</a>
    <a href="list_factures.php" class="btn btn-primary">Voir la liste des factures</a>
</div>

<?php

$clients = $pdo->query("SELECT * FROM CLIENTS")->fetchAll();

if (empty($clients)) {
    echo "<p class='warning'>Aucun client trouvé.</p>";
} else {
    echo "<table class='table'>";
    echo "<thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Sexe</th>
                <th>Date de naissance</th>
            </tr>
          </thead><tbody>";
    foreach ($clients as $client) {
        echo "<tr>
                <td>" . htmlspecialchars($client['nom']) . "</td>
                <td>" . htmlspecialchars($client['prenom']) . "</td>
                <td>" . htmlspecialchars($client['sexe']) . "</td>
                <td>" . htmlspecialchars($client['date_naissance']) . "</td>
              </tr>";
    }
    echo "</tbody></table>";
}
?>
</body>
</html>
