<form method="GET">
    <label>Client :</label>
    <select name="id_client">
        <option value="">Tous</option>
        <?php
        $clients = $pdo->query("SELECT id_client, nom, prenom FROM CLIENTS")->fetchAll();
        foreach ($clients as $client) {
            $selected = ($_GET['id_client'] ?? '') == $client['id_client'] ? 'selected' : '';
            echo "<option value='{$client['id_client']}' $selected>{$client['nom']} {$client['prenom']}</option>";
        }
        ?>
    </select>

    <label>Du :</label>
    <input type="date" name="date_debut" value="<?= $_GET['date_debut'] ?? '' ?>">

    <label>Au :</label>
    <input type="date" name="date_fin" value="<?= $_GET['date_fin'] ?? '' ?>">

    <button type="submit" class="btn">Rechercher</button>
</form>
