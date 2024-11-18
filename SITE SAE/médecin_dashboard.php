<?php
session_start();
if ($_SESSION['role'] != 'medecin') {
    header("Location: login.php");
    exit();
}

// Connexion à la base de données
require('db_connection.php');

// Traitement de la suppression d'un patient
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    $stmt = $conn->prepare("DELETE FROM patients WHERE id_patient = ?");
    $stmt->bind_param("i", $delete_id);

    if ($stmt->execute()) {
        header("Location: medecin_dashboard.php?success=patient_deleted");
        exit();
    } else {
        header("Location: medecin_dashboard.php?error=" . urlencode($stmt->error));
        exit();
    }
}

// Traitement de la suppression d'un médicament
if (isset($_GET['delete_medicament_id'])) {
    $delete_medicament_id = $_GET['delete_medicament_id'];

    $stmt = $conn->prepare("DELETE FROM medicaments WHERE id_medicament = ?");
    $stmt->bind_param("i", $delete_medicament_id);

    if ($stmt->execute()) {
        header("Location: medecin_dashboard.php?success=medicament_deleted");
        exit();
    } else {
        header("Location: medecin_dashboard.php?error=" . urlencode($stmt->error));
        exit();
    }
}

// Traitement de la suppression d'une salle
if (isset($_GET['delete_salle_id'])) {
    $delete_salle_id = $_GET['delete_salle_id'];

    $stmt = $conn->prepare("DELETE FROM salles WHERE id_salle = ?");
    $stmt->bind_param("i", $delete_salle_id);

    if ($stmt->execute()) {
        header("Location: medecin_dashboard.php?success=salle_deleted");
        exit();
    } else {
        header("Location: medecin_dashboard.php?error=" . urlencode($stmt->error));
        exit();
    }
}

// Récupération des informations des patients
$result = $conn->query("SELECT * FROM patients");
$patients = $result->fetch_all(MYSQLI_ASSOC);

// Récupération des médicaments
$result = $conn->query("SELECT * FROM medicaments");
$medicaments = $result->fetch_all(MYSQLI_ASSOC);

// Récupération des salles
$result = $conn->query("SELECT * FROM salles");
$salles = $result->fetch_all(MYSQLI_ASSOC);

// Traitement du formulaire d'ajout
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['type_form'])) {
        if ($_POST['type_form'] == 'ajout_patient') {
            $nom = $_POST['nom'] ?? '';
            $prenom = $_POST['prenom'] ?? '';
            $date_naissance = $_POST['date_naissance'] ?? '';
            $diagnostic = $_POST['diagnostic'] ?? null;
            $historique_medical = $_POST['historique_medical'] ?? null;
            $salle_actuelle = $_POST['salle_actuelle'] ?? null;
            $age = $_POST['age'] ?? null;

            $stmt = $conn->prepare("INSERT INTO patients (nom, prenom, date_naissance, diagnostic, historique_medical, salle_actuelle, age) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssii", $nom, $prenom, $date_naissance, $diagnostic, $historique_medical, $salle_actuelle, $age);

            if ($stmt->execute()) {
                header("Location: medecin_dashboard.php?success=patient_added");
                exit();
            } else {
                header("Location: medecin_dashboard.php?error=" . urlencode($stmt->error));
                exit();
            }
        } elseif ($_POST['type_form'] == 'ajout_medicament') {
            $nom_medicament = $_POST['nom_medicament'] ?? '';
            $dosage = $_POST['dosage'] ?? '';

            $stmt = $conn->prepare("INSERT INTO medicaments (nom_medicament, description) VALUES (?, ?)");
            $stmt->bind_param("ss", $nom_medicament, $dosage);

            if ($stmt->execute()) {
                header("Location: medecin_dashboard.php?success=medicament_added");
                exit();
            } else {
                header("Location: medecin_dashboard.php?error=" . urlencode($stmt->error));
                exit();
            }
        } elseif ($_POST['type_form'] == 'ajout_salle') {
            $type_salle = $_POST['type_salle'] ?? '';
            $disponibilite = $_POST['disponibilite'] ?? '';

            $stmt = $conn->prepare("INSERT INTO salles (type_salle, disponibilite) VALUES (?, ?)");
            $stmt->bind_param("ss", $type_salle, $disponibilite);

            if ($stmt->execute()) {
                header("Location: medecin_dashboard.php?success=salle_added");
                exit();
            } else {
                header("Location: medecin_dashboard.php?error=" . urlencode($stmt->error));
                exit();
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord Médecin</title>
    <link rel="stylesheet" href="medecin_dashboard.css"> <!-- Lien vers votre CSS -->
    <style>
        .ajouts-container {
            display: none; /* Cacher tous les formulaires par défaut */
        }
        .ajouts-container.active {
            display: block; /* Afficher le formulaire actif */
        }
        .btn-modifier, .btn-supprimer {
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="medecin-dashboard">
        <h1>Tableau de bord Médecin</h1>
        <div class="menu-dropdown">
            <label for="action-select">Choisissez une action :</label>
            <select id="action-select" onchange="showForm(this.value)">
                <option value="">-- Sélectionnez --</option>
                <option value="ajout_patient">Ajouter un Patient</option>
                <option value="ajout_medicament">Ajouter un Médicament</option>
                <option value="ajout_salle">Ajouter une Salle</option>
            </select>
        </div>

        <div id="ajout_patient" class="ajouts-container">
            <h2>Ajouter un Patient</h2>
            <form action="" method="POST" class="ajout-form">
                <input type="hidden" name="type_form" value="ajout_patient">
                <label for="nom">Nom:</label>
                <input type="text" id="nom" name="nom" required>

                <label for="prenom">Prénom:</label>
                <input type="text" id="prenom" name="prenom" required>

                <label for="date_naissance">Date de Naissance:</label>
                <input type="date" id="date_naissance" name="date_naissance" required>

                <label for="diagnostic">Diagnostic:</label>
                <input type="text" id="diagnostic" name="diagnostic">

                <label for="historique_medical">Historique Médical:</label>
                <input type="text" id="historique_medical" name="historique_medical">

                <label for="salle_actuelle">Salle Actuelle:</label>
                <input type="text" id="salle_actuelle" name="salle_actuelle">

                <label for="age">Âge:</label>
                <input type="number" id="age" name="age">

                <button type="submit">Ajouter Patient</button>
            </form>
        </div>

        <div id="ajout_medicament" class="ajouts-container">
            <h2>Ajouter un Médicament</h2>
            <form action="" method="POST" class="ajout-form">
                <input type="hidden" name="type_form" value="ajout_medicament">
                <label for="nom_medicament">Nom du Médicament:</label>
                <input type="text" id="nom_medicament" name="nom_medicament" required>

                <label for="dosage">Dosage:</label>
                <input type="text" id="dosage" name="dosage" required>

                <button type="submit">Ajouter Médicament</button>
            </form>
        </div>

        <div id="ajout_salle" class="ajouts-container">
            <h2>Ajouter une Salle</h2>
            <form action="" method="POST" class="ajout-form">
                <input type="hidden" name="type_form" value="ajout_salle">
                <label for="type_salle">Type de Salle:</label>
                <select id="type_salle" name="type_salle" required>
                    <option value="opération">Opération</option>
                    <option value="consultation">Consultation</option>
                </select>

                <label for="disponibilite">Disponibilité:</label>
                <input type="text" id="disponibilite" name="disponibilite" required>

                <button type="submit">Ajouter Salle</button>
            </form>
        </div>

        <h2>Patients</h2>
        <table>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Date de Naissance</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($patients as $patient): ?>
            <tr>
                <td><?php echo htmlspecialchars($patient['nom']); ?></td>
                <td><?php echo htmlspecialchars($patient['prenom']); ?></td>
                <td><?php echo htmlspecialchars($patient['date_naissance']); ?></td>
                <td>
                    <a class="btn-modifier" href="modifier_patient.php?id=<?php echo $patient['id_patient']; ?>">Modifier</a>
                    <a class="btn-supprimer" href="medecin_dashboard.php?delete_id=<?php echo $patient['id_patient']; ?>">Supprimer</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>

        <h2>Médicaments</h2>
        <table>
            <tr>
                <th>Nom</th>
                <th>Dosage</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($medicaments as $medicament): ?>
            <tr>
                <td><?php echo htmlspecialchars($medicament['nom_medicament']); ?></td>
                <td><?php echo htmlspecialchars($medicament['description']); ?></td>
                <td>
                    <a class="btn-modifier" href="modifier_medicament.php?id=<?php echo $medicament['id_medicament']; ?>">Modifier</a>
                    <a class="btn-supprimer" href="medecin_dashboard.php?delete_medicament_id=<?php echo $medicament['id_medicament']; ?>">Supprimer</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>

        <h2>Salles</h2>
        <table>
            <tr>
                <th>Type de Salle</th>
                <th>Disponibilité</th>
                <th>Actions</th>
            </tr>
        <tbody>
            <?php foreach ($salles as $salle): ?>
            <tr>
                <td><?php echo htmlspecialchars($salle['type_salle']); ?></td>
                <td><?php echo htmlspecialchars($salle['disponibilite']); ?></td>
                <td>
                    <a class="btn-modifier" href="modifier_salle.php?id=<?php echo $salle['id_salle']; ?>">Modifier</a>
                    <a class="btn-supprimer" href="medecin_dashboard.php?delete_salle_id=<?php echo $salle['id_salle']; ?>">Supprimer</a>
                </td>
            </tr>
            <?php endforeach; ?>
                </tbody>
        </table>
                <a href="logout.php" class="btn-retour">Déconnexion</a>
        </div>
        <script>
            function showForm(value) {
                // Cacher tous les formulaires
                const forms = document.querySelectorAll('.ajouts-container');
                forms.forEach(form => {
                    form.style.display = 'none'; // Masquer le formulaire
                });

                // Afficher le formulaire correspondant à l'option choisie
                if (value) {
                    document.getElementById(value).style.display = 'block'; // Afficher le formulaire
                }
            }
        </script>
    </div>
</body>
</html>
