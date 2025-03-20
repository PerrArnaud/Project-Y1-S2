<?php
session_start(); //Continue la session.

if (!isset($_SESSION['username'])) {//Permet d'empêcher un accès à la page si la personne n'est pas connectée.
    echo "Vous n'êtes pas connecté.";
    exit();
}

echo "Bienvenue, " . htmlspecialchars($_SESSION['username']) . "!"; //Message d'accueil avec le nom d'utilisateur entré.
?>
<a href="logout.php">Déconnexion</a>