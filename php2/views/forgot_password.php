<?php
include '../db/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];

    // Vérifier si l'email existe dans la base de données
    $stmt = $pdo->prepare('SELECT * FROM utilisateurs WHERE email = ?');
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user) {
        // Si l'utilisateur existe, envoyer un email au compte admin
        $admin_email = 'admin@gmail.com';
        $subject = "Récupération de mot de passe";
        $message = "Votre nouveau mot de passe est : 123456";
        $headers = "From: no-reply@exemple.com";

        if (mail($admin_email, $subject, $message, $headers)) {
            $success = "Un email a été envoyé à l'administrateur avec votre nouveau mot de passe.";
        } else {
            $error = "L'envoi de l'email a échoué. Veuillez réessayer plus tard.";
        }
    } else {
        $error = "Cet email n'existe pas dans notre base de données.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mot de passe oublié</title>
    <link rel="stylesheet" href="../css/style2.css">
</head>
<body>
    <h1>Mot de passe oublié</h1>
    <?php if (isset($success)): ?>
        <p style="color:green;"><?= $success ?></p>
    <?php elseif (isset($error)): ?>
        <p style="color:red;"><?= $error ?></p>
    <?php endif; ?>
    <form method="POST">
        <label>Email: <input type="email" name="email" required></label><br>
        <button type="submit">Envoyer</button>
    </form>
    <a href="login.php" class="btn">Retour à la connexion</a>
</body>
</html>















