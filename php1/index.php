<?php
include 'config.php';

// Récupération des parcours pour le formulaire
$parcours_query = $pdo->query("SELECT * FROM parcours");
$parcours_list = $parcours_query->fetchAll(PDO::FETCH_ASSOC);

// Récupération des étudiants pour affichage dans la liste
$etudiants_query = $pdo->query("SELECT e.*, p.nom_parcours FROM etudiants e LEFT JOIN parcours p ON e.parcours_id = p.id");
$etudiants = $etudiants_query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des étudiants</title>
    <link rel="stylesheet" href="./style.css">
    
</head>
<body>

<h2>Formulaire de gestion des étudiants</h2>
<form action="ajouter.php" method="POST">
    <label>Nom :</label><input type="text" name="nom" required><br>
    <label>Prénom :</label><input type="text" name="prenom" required><br>
    <label>Date de naissance :</label><input type="date" name="date_naissance" required><br>
    <label>Adresse :</label><input type="text" name="adresse" required><br>
    <label>Sexe :</label>
    <input type="radio" name="sexe" value="masculin" required> Masculin
    <input type="radio" name="sexe" value="feminin" required> Féminin<br>
    <label>Parcours :</label>
    <select name="parcours_id" required>
        <option value="">Sélectionner un parcours</option>
        <?php foreach ($parcours_list as $parcours): ?>
            <option value="<?= $parcours['id'] ?>"><?= $parcours['nom_parcours'] ?></option>
        <?php endforeach; ?>
    </select><br>
    <input type="submit" value="Ajouter">
</form>

<h2>Liste des étudiants</h2>
<table border="1">
    <thead>
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Date de naissance</th>
            <th>Adresse</th>
            <th>Sexe</th>
            <th>Parcours</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($etudiants as $etudiant): ?>
            <tr>
                <td><?= $etudiant['nom'] ?></td>
                <td><?= $etudiant['prenom'] ?></td>
                <td><?= $etudiant['date_naissance'] ?></td>
                <td><?= $etudiant['adresse'] ?></td>
                <td><?= $etudiant['sexe'] ?></td>
                <td><?= $etudiant['nom_parcours'] ?></td>
                <td>
                    <a href="modifier.php?id=<?= $etudiant['id'] ?>">Modifier</a>
                    <a href="supprimer.php?id=<?= $etudiant['id'] ?>" onclick="return confirm('Êtes-vous sûr ?')">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>
