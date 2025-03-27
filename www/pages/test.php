<?php
    session_start();
    
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
    
    $message = "";
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['register'])) { // Gestion de l'inscription
            if (!empty($_POST['username']) && !empty($_POST['secret']) && !empty($_POST['confirm'])) {
                $user = $_POST['username'];
                $hashedPassword = password_hash($_POST['secret'], PASSWORD_DEFAULT);
                
                if ($_POST['secret'] == $_POST['confirm']) {
                    $sqlc = $PDO->prepare("INSERT INTO connexion (username, pass) VALUES (?, ?)");
                    $sqlc->execute([$user, $hashedPassword]);
                    header('Location: http://localhost:8080/pages/login.php');
                    exit();
                } else {
                    $message = "Le mot de passe n'est pas identique.";
                }
            } else {
                $message = "Veuillez remplir tous les champs.";
            }
        }
        
        if (isset($_POST['login'])) { // Gestion de la connexion
            if (!empty($_POST['username']) && !empty($_POST['secret'])) {
                $user = $_POST['username'];
                $password = $_POST['secret'];
                
                $stmt = $PDO->prepare("SELECT pass FROM connexion WHERE username = :username");
                $stmt->bindParam(':username', $user);
                $stmt->execute();
                
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                
                if ($row && password_verify($password, $row['pass'])) {
                    $_SESSION['username'] = $user;
                    header('Location: http://localhost:8080/pages/accueil.php');
                    exit();
                } else {
                    $message = "Identifiant ou mot de passe incorrect.";
                }
            } else {
                $message = "Veuillez remplir tous les champs.";
            }
        }
    }
?>
<html>
    <head>
        <title>Authentification</title>
        <link href="../assets/css/style.css" rel="stylesheet">
        <script>
            function showForm(formType) {
                document.getElementById('registerForm').style.display = (formType === 'register') ? 'block' : 'none';
                document.getElementById('loginForm').style.display = (formType === 'login') ? 'block' : 'none';
                document.getElementById('buttons').style.display = 'none';
            }

            function toggleForm(currentForm) {
                if (currentForm === 'register') {
                    document.getElementById('registerForm').style.display = 'none';
                    document.getElementById('loginForm').style.display = 'block';
                } else {
                    document.getElementById('loginForm').style.display = 'none';
                    document.getElementById('registerForm').style.display = 'block';
                }
            }
        </script>
    </head>
    <body>
        <div id="buttons">
            <form>
                <input type="submit" value="S'inscrire" onclick="showForm('register'); return false;">
                <input type="submit" value="Se connecter" onclick="showForm('login'); return false;">
            </form>
        </div>
        
        <div id="registerForm" style="display:none;">
            <h2>Inscription</h2>
            <form method="post">
                Identifiant <br>
                <input type="text" name="username" required placeholder="Username"> <br><br>
                Mot de passe <br>
                <input type="password" name="secret" placeholder="Password" minlength="14" required> <br><br>
                Confirmer le mot de passe <br>
                <input type="password" name="confirm" placeholder="Confirm password" minlength="14" required> <br><br>
                <input type="submit" name="register" value="S'inscrire">
                <input type="submit" value="Déjà un compte ? Se connecter" onclick="toggleForm('register'); return false;">
            </form>
        </div>
        
        <div id="loginForm" style="display:none;">
            <h2>Connexion</h2>
            <form method="post">
                Identifiant <br>
                <input type="text" name="username" required placeholder="Username"> <br><br>
                Mot de passe <br>
                <input type="password" name="secret" placeholder="Password" minlength="14" required> <br><br>
                <input type="submit" name="login" value="Se connecter">
                <input type="submit" value="Pas encore inscrit ? S'inscrire" onclick="toggleForm('login'); return false;">
            </form>
        </div>
        
        <div id="result"><?php echo $message; ?></div>
    </body>
</html>