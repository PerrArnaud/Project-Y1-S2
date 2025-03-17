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
              <input  type="password" name="secret" id="secret" placeholder="Password" minlength="14" required> </br> </br> 
              Confirmer le mot de passe
              <input type="password" name="confirm" id="secret2" placeholder="Confirm password" minlength="14" required> </br> </br> </br>
              <input type="submit" value="Se connecter">
            </form>
        </div>
        <div id="result">
        </div>
    </body>
</html>
<?php
$host="lamp_mysql";
$dbname = "phpsql";
$userroot = "root";
$passroot = "rootpassword";
$PDO = new PDO("mysql:host=$host;dbname=$dbname", $userroot, $passroot);
if (!empty($_POST)) {
    $hashedPassword=password_hash($_POST['secret'], PASSWORD_DEFAULT);
    $user = $_POST['username'];
    if ($_POST['secret'] == $_POST['confirm']){
        $sqlc = $PDO->prepare("INSERT INTO connexion (username,pass) VALUES (?,?)");
        $sqlc->execute([$user,$hashedPassword]);
    }
    else{
        echo("Le mot de passe n'est pas identique");
    }
}
?>