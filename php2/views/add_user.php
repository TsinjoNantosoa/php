<?php
include '../db/db.php';

if (isset($_GET['id'])) {
    $stmt = $pdo->prepare('SELECT * FROM utilisateurs WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $user = $stmt->fetch();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $stmt = $pdo->prepare('UPDATE utilisateurs SET nom = ?, prenom = ?, email = ?, mot_de_passe = ? WHERE id = ?');
        $stmt->execute([$nom, $prenom, $email, $password, $id]);
    } else {
        $stmt = $pdo->prepare('INSERT INTO utilisateurs (nom, prenom, email, mot_de_passe) VALUES (?, ?, ?, ?)');
        $stmt->execute([$nom, $prenom, $email, $password]);
    }
    header('Location: list_users.php');
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($_GET['id']) ? 'Modifier' : 'Ajouter' ?> un utilisateur</title>
    <link rel="stylesheet" href="../css/style1.css">
</head>
<body>
    <div class="container">
        <h1><?= isset($_GET['id']) ? 'Modifier' : 'Ajouter' ?> un utilisateur</h1>
        <form method="POST">
            <label>Nom: <input type="text" name="nom" required value="<?= isset($user) ? htmlspecialchars($user['nom']) : '' ?>"></label><br>
            <label>Prénom: <input type="text" name="prenom" required value="<?= isset($user) ? htmlspecialchars($user['prenom']) : '' ?>"></label><br>
            <label>Email: <input type="email" name="email" required value="<?= isset($user) ? htmlspecialchars($user['email']) : '' ?>"></label><br>
            <label>Mot de passe: <input type="password" name="password" required></label><br>
            <input type="hidden" name="id" value="<?= isset($user) ? $user['id'] : '' ?>">
            <button type="submit"><?= isset($user) ? 'Modifier' : 'Ajouter' ?></button>
        </form>
        <a href="list_users.php" class="btn">Retour</a>
    </div>
</body>
</html>
