<?php
session_start(); // Continue la session.

if (!isset($_SESSION['username'])) { // Vérifie si l'utilisateur est connecté.
    echo "Vous n'êtes pas connecté.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link href="../assets/css/style_a.css" rel="stylesheet"> <!-- Lien vers le fichier CSS externe -->
</head>
<body>

    <p>Bienvenue, <?php echo htmlspecialchars($_SESSION['username']); ?> !</p>

    <div class="logout-container">
        <a href="logout.php">Déconnexion</a>
    </div>

</body>
</html>
