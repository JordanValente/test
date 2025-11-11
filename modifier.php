<?php
include 'test.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    echo "ID de facture manquant.";
    exit;
}

// Récupérer les infos de la facture
$stmt = $pdo->prepare("SELECT * FROM FACTURES WHERE id_facture = ?");
$stmt->execute([$id]);
$facture = $stmt->fetch();

if (!$facture) {
    echo "Facture introuvable.";
    exit;
}

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("UPDATE FACTURES SET montant = ?, produits = ?, quantite = ? WHERE id_facture = ?");
    $stmt->execute([
        $_POST['montant'],
        $_POST['produits'],
        $_POST['quantite'],
        $id
    ]);
    echo "<p class='success'>Facture mise à jour avec succès !</p>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Modifier la facture</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h2>Modifier la facture</h2>
<form method="POST">
    <input type="number" step="0.01" name="montant" value="<?= $facture['montant'] ?>" required>
    <textarea name="produits" required><?= $facture['produits'] ?></textarea>
    <input type="number" name="quantite" value="<?= $facture['quantite'] ?>" required>
    <button type="submit" class="btn">Mettre à jour</button>
</form>
</body>
</html>
