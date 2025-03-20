<?php
session_start();//Continue la session.
session_destroy(); //Retire la session puis renvoie vers le formulaire de connexion.
header("Location: http://localhost:8080/pages/login.php"); 
exit();
?>