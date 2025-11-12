<?php include 'test.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Liste des factures</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h2>Liste des factures</h2>

<div class="actions">
    <a href="AjouterUnClient.php" class="btn btn-primary">Ajouter un client</a>
    <a href="AjouterFacture.php" class="btn btn-warning">Ajouter une facture</a>
    <a href="list_clients.php" class="btn btn-primary">Voir la liste des clients</a>
</div>

<form method="GET" class="filter-form">
    <label for="id_client">Client :</label>
    <select name="id_client" id="id_client">
        <option value="">Tous les clients</option>
        <?php
        $clients = $pdo->query("SELECT id_client, nom, prenom FROM CLIENTS")->fetchAll();
        foreach ($clients as $client) {
            $selected = ($_GET['id_client'] ?? '') == $client['id_client'] ? 'selected' : '';
            echo "<option value='{$client['id_client']}' $selected>{$client['nom']} {$client['prenom']}</option>";
        }
        ?>
    </select>

    <label for="date_debut">Du :</label>
    <input type="date" name="date_debut" id="date_debut" value="<?= $_GET['date_debut'] ?? '' ?>">

    <label for="date_fin">Au :</label>
    <input type="date" name="date_fin" id="date_fin" value="<?= $_GET['date_fin'] ?? '' ?>">

    <button type="submit" class="btn">Rechercher</button>
</form>

<?php
// Construction de la requête SQL avec filtres
$sql = "SELECT F.*, C.nom, C.prenom 
        FROM FACTURES F 
        JOIN CLIENTS C ON F.id_client = C.id_client 
        WHERE 1";
$params = [];

if (!empty($_GET['id_client'])) {
    $sql .= " AND F.id_client = ?";
    $params[] = $_GET['id_client'];
}

if (!empty($_GET['date_debut'])) {
    $sql .= " AND F.date_creation >= ?";
    $params[] = $_GET['date_debut'];
}

if (!empty($_GET['date_fin'])) {
    $sql .= " AND F.date_creation <= ?";
    $params[] = $_GET['date_fin'];
}

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$factures = $stmt->fetchAll();

// Affichage des résultats
if (empty($factures)) {
    echo "<p class='warning'>Aucune facture ne correspond aux critères sélectionnés.</p>";
} else {
    echo "<table class='table'>";
    echo "<thead>
            <tr>
                <th>ID</th>
                <th>Montant (€)</th>
                <th>Produits</th>
                <th>Quantité</th>
                <th>Client</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
          </thead><tbody>";
    foreach ($factures as $facture) {
        echo "<tr>
                <td>{$facture['id_facture']}</td>
                <td>{$facture['montant']}</td>
                <td>{$facture['produits']}</td>
                <td>{$facture['quantite']}</td>
                <td>{$facture['nom']} {$facture['prenom']}</td>
                <td>{$facture['date_creation']}</td>
                <td>
                    <a href='modifierfacture.php?id={$facture['id_facture']}' class='btn btn-sm btn-info'>Modifier</a>
                    <a href='supprimerfacture.php?id={$facture['id_facture']}' class='btn btn-sm btn-danger' onclick=\"return confirm('Voulez-vous vraiment supprimer cette facture ?');\">Supprimer</a>
                </td>
              </tr>";
    }
    echo "</tbody></table>";
}
?>
</body>
</html>
