<?php include 'test.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Créer une facture</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h2>Créer une facture</h2>
<form method="POST">
    <!-- Liste déroulante des clients -->
    <label>Client :</label>
    <select name="id_client" required>
        <option value="">-- Sélectionner --</option>
        <?php
        $clients = $pdo->query("SELECT id_client, nom, prenom FROM CLIENTS")->fetchAll();
        foreach ($clients as $client) {
            echo "<option value='{$client['id_client']}'>{$client['nom']} {$client['prenom']}</option>";
        }
        ?>
    </select>

    <!-- Champs de la facture -->
    <input type="number" step="0.01" name="montant" placeholder="Montant (€)" required>
    <textarea name="produits" placeholder="Description des produits" required></textarea>
    <input type="number" name="quantite" placeholder="Quantité" required>
    <button type="submit" class="btn">Enregistrer la facture</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("INSERT INTO FACTURES (montant, produits, quantite, id_client) VALUES (?, ?, ?, ?)");
    $stmt->execute([
        $_POST['montant'],
        $_POST['produits'],
        $_POST['quantite'],
        $_POST['id_client']
    ]);
    echo "<p class='success'>Facture enregistrée avec succès !</p>";
}
?>
</body>
</html>
