<?php
include 'test.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    echo "ID de facture manquant.";
    exit;
}

// Supprimer la facture
$stmt = $pdo->prepare("DELETE FROM FACTURES WHERE id_facture = ?");
$stmt->execute([$id]);

// Redirection vers la liste
header("Location: list_factures.php");
exit;
?>
