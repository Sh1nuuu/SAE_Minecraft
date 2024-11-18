<?php
// infirmiere_dashboard.php
session_start();
if ($_SESSION['role'] != 'infirmiere') {
    header("Location: login.php");
    exit();
}

// Connexion à la base de données
require('db_connection.php'); // Assurez-vous que ce fichier existe et est configuré correctement

// Récupération des informations des patients
$result = $conn->query("SELECT * FROM patients");
$patients = $result->fetch_all(MYSQLI_ASSOC);

// Récupération des médicaments
$result = $conn->query("SELECT * FROM medicaments");
$medicaments = $result->fetch_all(MYSQLI_ASSOC);

// Récupération des salles
$result = $conn->query("SELECT * FROM salles");
$salles = $result->fetch_all(MYSQLI_ASSOC);

// Affichage des informations spécifiques pour les infirmières
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord Infirmière</title>
    <link rel="stylesheet" href="infirmiere_dashboard.css"> <!-- Lien vers votre CSS -->
</head>
<body>
    <div class="infirmiere-dashboard">
        <h1>Tableau de bord Infirmière</h1>
        <p>Accédez aux informations des patients, médicaments, et salles...</p>

        <h2>Liste des Patients</h2>
        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Date de Naissance</th>
                    <th>Âge</th>
                    <th>Diagnostic</th>
                    <th>Historique Médical</th>
                    <th>Salle Actuelle</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($patients as $patient): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($patient['nom']); ?></td>
                        <td><?php echo htmlspecialchars($patient['prenom']); ?></td>
                        <td><?php echo htmlspecialchars($patient['date_naissance']); ?></td>
                        <td><?php echo htmlspecialchars($patient['age']); ?></td>
                        <td><?php echo htmlspecialchars($patient['diagnostic']); ?></td>
                        <td><?php echo htmlspecialchars($patient['historique_medical']); ?></td>
                        <td><?php echo htmlspecialchars($patient['salle_actuelle']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h2>Liste des Médicaments</h2>
        <table>
            <thead>
                <tr>
                    <th>Nom du Médicament</th>
                    <th>Dosage</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($medicaments as $medicament): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($medicament['nom_medicament']); ?></td>
                        <td><?php echo htmlspecialchars($medicament['dosage']); ?></td>
                        <td><?php echo htmlspecialchars($medicament['description']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h2>Liste des Salles</h2>
        <table>
            <thead>
                <tr>
                    <th>Type de Salle</th>
                    <th>Disponibilité</th>
                    <th>Capacité</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($salles as $salle): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($salle['type_salle']); ?></td>
                        <td><?php echo htmlspecialchars($salle['disponibilite']); ?></td>
                        <td><?php echo htmlspecialchars($salle['capacite']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
                 <a href="logout.php" class="btn-retour">Déconnexion</a>
    </div>
</body>
</html>
