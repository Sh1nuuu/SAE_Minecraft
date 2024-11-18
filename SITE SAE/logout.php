<?php
session_start();

// Détruire toutes les données de session
$_SESSION = []; // Vide le tableau de session
session_destroy(); // Détruit la session

// Redirection vers la page de connexion
header("Location: login.php");
exit();
?>
