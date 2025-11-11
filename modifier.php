<?php
include 'test.php';

$id = $_GET['id'] ?? null;
if (!$id || !is_numeric($id)) {
    echo "<p class='error'>ID de facture manquant ou invalide.</p>";
    exit;
}


$stmt = $pdo->prepare("
    SELECT F.*, C.nom, C.prenom 
    FROM FACTURES F 
    JOIN CLIENTS C ON F.id_client = C.id_client 
    WHERE id_facture = ?
");
$stmt->execute([$id]);
$facture = $stmt->fetch();

if (!$facture) {
    echo "<p class='error'>Facture introuvable.</p>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("
        UPDATE FACTURES 
        SET montant = ?, produits = ?, quantite = ? 
        WHERE id_facture = ?
    ");
    $stmt->execute([
            $_POST['montant'],
            $_POST['produits'],
            $_POST['quantite'],
            $id
    ]);

    echo "<p class='success'>La facture a été mise à jour avec succès.</p>";





    $stmt = $pdo->prepare("
        SELECT F.*, C.nom, C.prenom 
        FROM FACTURES F 
        JOIN CLIENTS C ON F.id_client = C.id_client 
        WHERE id_facture = ?
    ");
    $stmt->execute([$id]);
    $facture = $stmt->fetch();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Modifier une facture</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h2>Modifier une facture</h2>


<p><strong>Client :</strong> <?= htmlspecialchars($facture['nom'] . ' ' . $facture['prenom']) ?></p>
<p><strong>Date de création :</strong> <?= htmlspecialchars($facture['date_creation']) ?></p>


<form method="POST" class="form-facture">
    <label for="montant">Montant (€) :</label>
    <input type="number" step="0.01" name="montant" id="montant" value="<?= htmlspecialchars($facture['montant']) ?>" required>

    <label for="produits">Produits :</label>
    <textarea name="produits" id="produits" required><?= htmlspecialchars($facture['produits']) ?></textarea>

    <label for="quantite">Quantité :</label>
    <input type="number" name="quantite" id="quantite" value="<?= htmlspecialchars($facture['quantite']) ?>" required>

    <button type="submit" class="btn">Mettre à jour</button>
</form>

<div class="actions">
    <a href="list_factures.php" class="btn btn-primary">Retour à la liste des factures</a>
</div>
</body>
</html>
