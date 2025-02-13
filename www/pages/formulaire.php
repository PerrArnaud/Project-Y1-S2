<html>
    <head>
        <link href="../assets/css/style.css" rel=stylesheet>
    </head>
    <body>
        <div id="formulaire">
            <form   method="Post">
                Identifiant </br>
              <input type="text" name="username" id="username" required placeholder="Username" > </br> </br> 
              Mot de passe <br>
              <input  type="password" name="secret" id="secret" placeholder="Password" minlength="14" required> </br> </br> </br>
              <input type="submit" id="send" value="Se connecter">
            </form>
        </div>
        <div id="result">
        </div>
    </body>
</html>
<?php
if (!empty($_POST)) {
    $hashedPassword=password_hash($_POST['secret'], PASSWORD_DEFAULT);
    $user = $_POST['username'];
    $host="localhost";
    $dbname = "phpsql";
    $username = "root";
    $password = "rootpassword";
    $PDO = new PDO(dsn: "mysql:host=$host;dbname=$dbname", username: $username, password: $password);
    $sqlc = $PDO->prepare("INSERT INTO connexion (username, pass) VALUES (?,?)");
    $sqlc->execute([$user,$hashedPassword]);
}
?>