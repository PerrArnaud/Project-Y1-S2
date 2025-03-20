<?php
session_start();
session_destroy(); // Supprime toutes les variables de session
header("Location: http://localhost:8080/pages/login.php");
exit();
?>