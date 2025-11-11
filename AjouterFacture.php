<?php include 'test.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Créer une facture</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h2>Créer une facture</h2>

<form method="POST" class="form-facture">
    <label for="id_client">Client :</label>
    <select name="id_client" id="id_client" required>
        <option value="">-- Sélectionner un client --</option>
        <?php
        $clients = $pdo->query("SELECT id_client, nom, prenom FROM CLIENTS")->fetchAll();
        foreach ($clients as $client) {
            echo "<option value='{$client['id_client']}'>{$client['nom']} {$client['prenom']}</option>";
        }
        ?>
    </select>

    <label for="montant">Montant (€) :</label>
    <input type="number" step="0.01" name="montant" id="montant" placeholder="Montant en euros" required>

    <label for="produits">Produits :</label>
    <textarea name="produits" id="produits" placeholder="Description des produits" required></textarea>

    <label for="quantite">Quantité :</label>
    <input type="number" name="quantite" id="quantite" placeholder="Quantité" required>

    <button type="submit" class="btn">Enregistrer la facture</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("
                INSERT INTO FACTURES (montant, produits, quantite, id_client) 
                VALUES (?, ?, ?, ?)
            ");
    $stmt->execute([
            $_POST['montant'],
            $_POST['produits'],
            $_POST['quantite'],
            $_POST['id_client']
    ]);

    echo "<p class='success'>La facture a été enregistrée avec succès.</p>";
}
?>

<div class="actions">
    <a><br></a>
    <a href="list_factures.php" class="btn btn-primary">Voir la liste des factures</a>
</div>
</body>
</html>
