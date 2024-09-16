<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $date_naissance = $_POST['date_naissance'];
    $adresse = $_POST['adresse'];
    $sexe = $_POST['sexe'];
    $parcours_id = $_POST['parcours_id'];

    $sql = "INSERT INTO etudiants (nom, prenom, date_naissance, adresse, sexe, parcours_id) 
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nom, $prenom, $date_naissance, $adresse, $sexe, $parcours_id]);

    header("Location: index.php");
    exit();
}
?>
