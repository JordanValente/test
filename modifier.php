<?php
include 'test.php';

$id = $_GET['id'] ?? null;
if (!$id || !is_numeric($id)) {
    echo "<p class='error'>ID de client manquant ou invalide.</p>";
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM CLIENTS WHERE id_client = ?");
$stmt->execute([$id]);
$client = $stmt->fetch();

if (!$client) {
    echo "<p class='error'>Client introuvable.</p>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("
        UPDATE CLIENTS 
        SET nom = ?, prenom = ?, sexe = ?, date_naissance = ? 
        WHERE id_client = ?
    ");
    $stmt->execute([
            $_POST['nom'],
            $_POST['prenom'],
            $_POST['sexe'],
            $_POST['date_naissance'],
            $id
    ]);

    echo "<p class='success'>Le client a été mis à jour avec succès.</p>";

    $stmt = $pdo->prepare("SELECT * FROM CLIENTS WHERE id_client = ?");
    $stmt->execute([$id]);
    $client = $stmt->fetch();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Modifier un client</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h2>Modifier un client</h2>

<form method="POST" class="form-client">
    <label for="nom">Nom :</label>
    <input type="text" name="nom" id="nom" value="<?= $client['nom'] ?>" required>

    <label for="prenom">Prénom :</label>
    <input type="text" name="prenom" id="prenom" value="<?= $client['prenom'] ?>" required>

    <label for="sexe">Sexe :</label>
    <select name="sexe" id="sexe" required>
        <option value="H" <?= $client['sexe'] === 'H' ? 'selected' : '' ?>>Homme</option>
        <option value="F" <?= $client['sexe'] === 'F' ? 'selected' : '' ?>>Femme</option>
    </select>

    <label for="date_naissance">Date de naissance :</label>
    <input type="date" name="date_naissance" id="date_naissance" value="<?= $client['date_naissance'] ?>" required>

    <button type="submit" class="btn">Mettre à jour</button>
</form>

<div class="actions">
    <a><br></a>
    <a href="list_clients.php" class="btn btn-primary">Retour à la liste des clients</a>
</div>
</body>
</html>
