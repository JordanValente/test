<?php include 'test.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Ajouter un client</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h2>Ajouter un client</h2>
<form method="POST">
    <input type="text" name="nom" placeholder="Nom" required>
    <input type="text" name="prenom" placeholder="Prénom" required>
    <select name="sexe" required>
        <option value="">-- Sexe --</option>
        <option value="H">Homme</option>
        <option value="F">Femme</option>
    </select>
    <input type="date" name="date_naissance" required>
    <button type="submit" class="btn">Enregistrer</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("INSERT INTO CLIENTS (nom, prenom, sexe, date_naissance) VALUES (?, ?, ?, ?)");
    $stmt->execute([
        $_POST['nom'],
        $_POST['prenom'],
        $_POST['sexe'],
        $_POST['date_naissance']
    ]);
    echo "<p class='success'>Client ajouté avec succès !</p>";
}
?>
</body>
</html>
