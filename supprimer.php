<?php
include 'test.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    echo "ID de facture manquant.";
    exit;
}

$requete = $pdo->prepare("DELETE FROM FACTURES WHERE id_facture = ?");
$requete->execute([$id]);

header("Location: list_factures.php");
exit;
?>
