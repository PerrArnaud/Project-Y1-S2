<?php
session_start();
//Bloc de connexion à la base des jeux de société.
$host = "lamp_mysql";
$dbname = "phpsql";
$userroot = "root";
$passroot = "rootpassword";
$PDO = new PDO("mysql:host=$host;dbname=$dbname", $userroot, $passroot);


?>