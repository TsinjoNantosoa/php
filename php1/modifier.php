<?php
include 'config.php';

$id = $_GET['id'];

// Récupération des informations de l'étudiant
$stmt = $pdo->prepare("SELECT * FROM etudiants WHERE id = ?");
$stmt->execute([$id]);
$etudiant = $stmt->fetch();

// Récupération des parcours pour le formulaire
$parcours_query = $pdo->query("SELECT * FROM parcours");
$parcours_list = $parcours_query->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $date_naissance = $_POST['date_naissance'];
    $adresse = $_POST['adresse'];
    $sexe = $_POST['sexe'];
    $parcours_id = $_POST['parcours_id'];

    $sql = "UPDATE etudiants SET nom = ?, prenom = ?, date_naissance = ?, adresse = ?, sexe = ?, parcours_id = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nom, $prenom, $date_naissance, $adresse, $sexe, $parcours_id, $id]);

    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier étudiant</title>
</head>
<body>

<h2>Modifier l'étudiant</h2>
<form action="" method="POST">
    <label>Nom :</label><input type="text" name="nom" value="<?= $etudiant['nom'] ?>" required><br>
    <label>Prénom :</label><input type="text" name="prenom" value="<?= $etudiant['prenom'] ?>" required><br>
    <label>Date de naissance :</label><input type="date" name="date_naissance" value="<?= $etudiant['date_naissance'] ?>" required><br>
    <label>Adresse :</label><input type="text" name="adresse" value="<?= $etudiant['adresse'] ?>" required><br>
    <label>Sexe :</label>
    <input type="radio" name="sexe" value="masculin" <?= $etudiant['sexe'] == 'masculin' ? 'checked' : '' ?>> Masculin
    <input type="radio" name="sexe" value="feminin" <?= $etudiant['sexe'] == 'feminin' ? 'checked' : '' ?>> Féminin<br>
    <label>Parcours :</label>
    <select name="parcours_id" required>
        <option value="">Sélectionner un parcours</option>
        <?php foreach ($parcours_list as $parcours): ?>
            <option value="<?= $parcours['id'] ?>" <?= $etudiant['parcours_id'] == $parcours['id'] ? 'selected' : '' ?>><?= $parcours['nom_parcours'] ?></option>
        <?php endforeach; ?>
    </select><br>
    <input type="submit" value="Modifier">
</form>

</body>
</html>
