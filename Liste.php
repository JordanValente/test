<?php include 'test.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Liste des factures</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h2>Liste des factures</h2>

<?php
$sql = "SELECT F.*, C.nom, C.prenom FROM FACTURES F 
            JOIN CLIENTS C ON F.id_client = C.id_client";
$factures = $pdo->query($sql)->fetchAll();

if (count($factures) === 0) {
    echo "<p class='warning'>Aucune facture trouvée dans la base de données.</p>";
} else {
    echo "<table class='table'>";
    echo "<tr>
                <th>Client</th>
                <th>Montant (€)</th>
                <th>Produits</th>
                <th>Quantité</th>
                <th>Actions</th>
              </tr>";
    foreach ($factures as $facture) {
        echo "<tr>
                    <td>{$facture['nom']} {$facture['prenom']}</td>
                    <td>{$facture['montant']}</td>
                    <td>{$facture['produits']}</td>
                    <td>{$facture['quantite']}</td>
                    <td>
                        <a href='modifier.php?id={$facture['id_facture']}' class='btn'>Modifier</a>
                        <a href='supprimer.php?id={$facture['id_facture']}' class='btn btn-danger'>Supprimer</a>
                    </td>
                  </tr>";
    }
    echo "</table>";
}
?>
</body>
</html>
