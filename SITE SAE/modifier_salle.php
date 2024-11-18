<?php
// modifier_salle.php
session_start();
if ($_SESSION['role'] != 'medecin') {
    header("Location: login.php");
    exit();
}

require('db_connection.php');

if (isset($_GET['id'])) {
    $id_salle = intval($_GET['id']);

    // Récupération des informations de la salle
    $stmt = $conn->prepare("SELECT * FROM salles WHERE id_salle = ?");
    $stmt->bind_param("i", $id_salle);
    $stmt->execute();
    $salle = $stmt->get_result()->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mise à jour des informations de la salle
    $type_salle = $_POST['type_salle'];
    $disponibilite = $_POST['disponibilite'];

    $stmt = $conn->prepare("UPDATE salles SET type_salle = ?, disponibilite = ? WHERE id_salle = ?");
    $stmt->bind_param("ssi", $type_salle, $disponibilite, $id_salle);
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
    <title>Modifier Salle</title>
    <link rel="stylesheet" href="modifier_medicament.css"> <!-- Assurez-vous d'utiliser le bon CSS -->
</head>
<body>
    <h1>Modifier Salle</h1>
    <form method="POST">
        <label for="type_salle">Type de Salle:</label>
        <select name="type_salle" required>
            <option value="opération" <?php echo ($salle['type_salle'] == 'opération') ? 'selected' : ''; ?>>Opération</option>
            <option value="consultation" <?php echo ($salle['type_salle'] == 'consultation') ? 'selected' : ''; ?>>Consultation</option>
        </select>

        <label for="disponibilite">Disponibilité:</label>
        <input type="text" name="disponibilite" value="<?php echo htmlspecialchars($salle['disponibilite']); ?>" required>

        <input type="submit" value="Mettre à jour">
    </form>
    <a href="medecin_dashboard.php">Retour</a>
</body>
</html>
