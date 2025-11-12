<?php
include 'test.php';

$id = $_GET['id'] ?? null;
if (!$id || !is_numeric($id)) {
    echo "<p class='error'>ID de facture manquant ou invalide.</p>";
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM FACTURES WHERE id_facture = ?");
$stmt->execute([$id]);
$facture = $stmt->fetch();

if (!$facture) {
    echo "<p class='error'>Facture introuvable.</p>";
    exit;
}

$stmt = $pdo->prepare("DELETE FROM FACTURES WHERE id_facture = ?");
$stmt->execute([$id]);

echo "<p class='success'>La facture a été supprimée avec succès.</p>";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Supprimer une facture</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h2>Suppression d'une facture</h2>

<div class="actions">
    <a href="list_factures.php" class="btn btn-primary">Retour à la liste des factures</a>
</div>
</body>
</html>
