<?php
// db_connection.php

$servername = "localhost";
$username = "root";  // Utilisateur MariaDB
$password = "1234";  // Mot de passe MariaDB
$dbname = "hospital_db";  // Nom de la base de données

// Création de la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}
?>
