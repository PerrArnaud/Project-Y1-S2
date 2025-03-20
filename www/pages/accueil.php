<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['username'])) {
    header("Location: http://localhost:8080/pages/login.php");
    exit();
}

// Afficher le message de bienvenue
echo "Bienvenue, " . htmlspecialchars($_SESSION['username']) . " (ID: " . $_SESSION['user_id'] . ") !";
?>

<a href="logout.php">Se déconnecter</a>