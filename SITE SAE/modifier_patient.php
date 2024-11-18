<?php
// modifier_patient.php
session_start();
if ($_SESSION['role'] != 'medecin') {
    header("Location: login.php");
    exit();
}

require('db_connection.php');

if (isset($_GET['id'])) {
    $id_patient = intval($_GET['id']);

    // Récupération des informations du patient
    $stmt = $conn->prepare("SELECT * FROM patients WHERE id_patient = ?");
    $stmt->bind_param("i", $id_patient);
    $stmt->execute();
    $patient = $stmt->get_result()->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mise à jour des informations du patient
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $date_naissance = $_POST['date_naissance'];
    $diagnostic = $_POST['diagnostic'];
    $historique_medical = $_POST['historique_medical'];
    $salle_actuelle = $_POST['salle_actuelle'];
    $age = $_POST['age'];

    // Préparation de la requête de mise à jour
    $stmt = $conn->prepare("UPDATE patients SET nom = ?, prenom = ?, date_naissance = ?, diagnostic = ?, historique_medical = ?, salle_actuelle = ?, age = ? WHERE id_patient = ?");
    $stmt->bind_param("sssssiis", $nom, $prenom, $date_naissance, $diagnostic, $historique_medical, $salle_actuelle, $age, $id_patient);
    $stmt->execute();

    // Redirection après mise à jour
    header("Location: medecin_dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier Patient</title>
    <link rel="stylesheet" href="modifier_patient.css">
</head>
<body>
    <h1>Modifier Patient</h1>
    <form method="POST">
        <label for="nom">Nom:</label>
        <input type="text" name="nom" value="<?php echo htmlspecialchars($patient['nom']); ?>" required>

        <label for="prenom">Prénom:</label>
        <input type="text" name="prenom" value="<?php echo htmlspecialchars($patient['prenom']); ?>" required>

        <label for="date_naissance">Date de Naissance:</label>
        <input type="date" name="date_naissance" value="<?php echo htmlspecialchars($patient['date_naissance']); ?>" required>

        <label for="diagnostic">Diagnostic:</label>
        <textarea name="diagnostic"><?php echo htmlspecialchars($patient['diagnostic']); ?></textarea>

        <label for="historique_medical">Historique Médical:</label>
        <textarea name="historique_medical"><?php echo htmlspecialchars($patient['historique_medical']); ?></textarea>

        <label for="salle_actuelle">Salle Actuelle:</label>
        <input type="number" name="salle_actuelle" value="<?php echo htmlspecialchars($patient['salle_actuelle']); ?>">

        <label for="age">Âge:</label>
        <input type="number" name="age" value="<?php echo htmlspecialchars($patient['age']); ?>" required>

        <input type="submit" value="Mettre à jour">
    </form>
    <a href="medecin_dashboard.php">Retour</a>
</body>
</html>
