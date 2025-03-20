<?php
session_start();

if (!isset($_SESSION['username'])) {
    echo "Vous n'êtes pas connecté.";
    exit();
}

echo "Bienvenue, " . htmlspecialchars($_SESSION['username']) . "!";
?>
<a href="logout.php">Déconnexion</a>