<?php
include 'config.php';

$id = $_GET['id'];

// Supprimer l'étudiant avec l'ID correspondant
$sql = "DELETE FROM etudiants WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);

// Rediriger vers la page principale après la suppression
header("Location: index.php");
exit();
?>
