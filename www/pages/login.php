<?php
session_start(); // Démarrer la session

$host = "lamp_mysql";
$dbname = "phpsql";
$userroot = "root";
$passroot = "rootpassword";

try {
    $PDO = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $userroot, $passroot);
    $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['username']) && !empty($_POST['secret'])) {
        $user = $_POST['username'];
        $password = $_POST['secret'];

        $stmt = $PDO->prepare("SELECT pass FROM connexion WHERE username = :username");
        $stmt->bindParam(':username', $user);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row && password_verify($password, $row['pass'])) {
            // Stocker l'identifiant en session
            $_SESSION['username'] = $user;

            // Redirection vers la page d'accueil
            header('Location: http://localhost:8080/pages/accueil.php');
            exit();
        } else {
            echo "<div id='result'>Identifiant ou mot de passe incorrect.</div>";
        }
    } else {
        echo "<div id='result'>Veuillez remplir tous les champs.</div>";
    }
}
?>
<html>
    <head>
        <title>Log in</title>
        <link href="../assets/css/style.css" rel="stylesheet">
    </head>
    <body>
        <div id="formulaire">
            <form method="post">
                Identifiant <br>
                <input type="text" name="username" id="username" required placeholder="Username"> <br><br> 
                Mot de passe <br>
                <input type="password" name="secret" id="secret" placeholder="Password" minlength="14" required> <br><br><br>
                <input type="submit" value="Se connecter">
            </form>
        </div>
        <div id="result"></div>
    </body>
</html>