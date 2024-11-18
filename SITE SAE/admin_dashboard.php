<?php
// admin/admin_dashboard.php
session_start();
if ($_SESSION['role'] != 'administrateur') {
    header("Location: login.php");
    exit();
}

// Connexion à la base de données
require('db_connection.php'); // Assurez-vous que ce fichier existe et est configuré correctement

// Récupération des utilisateurs
$result = $conn->query("SELECT * FROM utilisateurs");
$utilisateurs = $result->fetch_all(MYSQLI_ASSOC);

// Récupération des capteurs
$result = $conn->query("SELECT * FROM capteurs");
$capteurs = $result->fetch_all(MYSQLI_ASSOC);

// Affichage des informations pour l'administrateur
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord Administrateur</title>
    <link rel="stylesheet" href="admin_dashboard.css"> <!-- Lien vers votre CSS -->
</head>
<body>
    <div class="admin-dashboard">
        <h1>Tableau de bord Administrateur</h1>
        <p>Gestion complète des utilisateurs, capteurs, et autres informations de l'hôpital.</p>

        <h2>Liste des Utilisateurs</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom d'utilisateur</th>
                    <th>Rôle</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($utilisateurs as $utilisateur): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($utilisateur['id_utilisateur']); ?></td>
                        <td><?php echo htmlspecialchars($utilisateur['username']); ?></td>
                        <td><?php echo htmlspecialchars($utilisateur['role']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h2>Liste des Capteurs</h2>
        <table>
            <thead>
                <tr>
                    <th>ID Capteur</th>
                    <th>Type de Capteur</th>
                    <th>Valeur</th>
                    <th>Date et Heure</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($capteurs as $capteur): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($capteur['id_capteur']); ?></td>
                        <td><?php echo htmlspecialchars($capteur['type_capteur']); ?></td>
                        <td><?php echo htmlspecialchars($capteur['valeur']); ?></td>
                        <td><?php echo htmlspecialchars($capteur['timestamp']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
                 <a href="logout.php" class="btn-retour">Déconnexion</a>
    </div>
</body>
</html>
