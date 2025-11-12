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
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Sexe</th>
                <th>Date de naissance</th>
                <th>Actions</th>
            </tr>
          </thead><tbody>";
    foreach ($clients as $client) {
        echo "<tr>
                <td>{$client['id_client']}</td>
                <td>{$client['nom']}</td>
                <td>{$client['prenom']}</td>
                <td>{$client['sexe']}</td>
                <td>{$client['date_naissance']}</td>
                <td>
                    <a href='modifier.php?id={$client['id_client']}' class='btn btn-sm btn-info'>Modifier</a>
                    <a href='supprimer.php?id={$client['id_client']}' class='btn btn-sm btn-danger' onclick=\"return confirm('Voulez-vous vraiment supprimer ce client ?');\">Supprimer</a>
                </td>
              </tr>";
    }
    echo "</tbody></table>";
}
?>
</body>
</html>
