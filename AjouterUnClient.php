<?php include 'test.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Ajouter un client</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h2>Ajouter un client</h2>

<!-- Formulaire d'ajout de client -->
<form method="POST" class="form-client">
    <label for="nom">Nom :</label>
    <input type="text" name="nom" id="nom" placeholder="Nom" required>

    <label for="prenom">Prénom :</label>
    <input type="text" name="prenom" id="prenom" placeholder="Prénom" required>

    <label for="sexe">Sexe :</label>
    <select name="sexe" id="sexe" required>
        <option value="">-- Sélectionner --</option>
        <option value="H">Homme</option>
        <option value="F">Femme</option>
    </select>

    <label for="date_naissance">Date de naissance :</label>
    <input type="date" name="date_naissance" id="date_naissance" required>

    <button type="submit" class="btn">Enregistrer</button>
</form>

<!-- Lien vers la liste des clients -->
<div class="actions">
    <a><br></a>
    <a href="list_clients.php" class="btn btn-primary">Voir la liste des clients</a>
</div>

<?php
// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("
        INSERT INTO CLIENTS (nom, prenom, sexe, date_naissance) 
        VALUES (?, ?, ?, ?)
    ");
    $stmt->execute([
            $_POST['nom'],
            $_POST['prenom'],
            $_POST['sexe'],
            $_POST['date_naissance']
    ]);

    echo "<p class='success'>Le client a été ajouté avec succès.</p>";
}
?>
</body>
</html>
