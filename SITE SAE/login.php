<?php
// login.php (Page complète)
session_start();
require 'db_connection.php';  // Connexion à la base de données

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Préparer la requête SQL pour récupérer l'utilisateur
    $sql = "SELECT id_utilisateur, password, role FROM utilisateurs WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    // Vérifier si l'utilisateur existe
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id_utilisateur, $hashed_password, $role);
        $stmt->fetch();

        // Vérifier si le mot de passe saisi correspond au mot de passe haché
        if (password_verify($password, $hashed_password)) {
            // Authentification réussie, démarrer la session
            $_SESSION['id_utilisateur'] = $id_utilisateur;
            $_SESSION['role'] = $role;

            // Rediriger l'utilisateur vers la page appropriée en fonction de son rôle
            if ($role == 'administrateur') {
                header("Location: admin_dashboard.php");
            } elseif ($role == 'medecin') {
                header("Location: medecin_dashboard.php");
            } elseif ($role == 'infirmiere') {
                header("Location: infirmiere_dashboard.php");
            }
            exit();
        } else {
            // Mot de passe incorrect
            $error_message = "Mot de passe incorrect.";
        }
    } else {
        // Nom d'utilisateur incorrect
        $error_message = "Nom d'utilisateur incorrect.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="home-container">
    <h2>Bienvenue sur le systeme de gestion médical</h2>

    <?php
    // Afficher un message d'erreur si la connexion a échoué
    if (!empty($error_message)) {
        echo "<p style='color:red;'>$error_message</p>";
    }
    ?>
     <form action="login.php" method="POST">
        <label for="username">Nom d'utilisateur :</label>
        <input type="text" id="username" name="username" required><br>

        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required><br>

        <input type="submit" value="Se connecter">
    </form>

</body>
</html>
