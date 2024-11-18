<?php
// modifier_medicament.php
session_start();
if ($_SESSION['role'] != 'medecin') {
    header("Location: login.php");
    exit();
}

require('db_connection.php');

if (isset($_GET['id'])) {
    $id_medicament = intval($_GET['id']);

    // Récupération des informations du médicament
    $stmt = $conn->prepare("SELECT * FROM medicaments WHERE id_medicament = ?");
    $stmt->bind_param("i", $id_medicament);
    $stmt->execute();
    $medicament = $stmt->get_result()->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mise à jour des informations du médicament
    $nom_medicament = $_POST['nom_medicament'];
    $description = $_POST['description'];
    $quantite_disponible = intval($_POST['quantite_disponible']); // Assurez-vous que c'est un entier

    $stmt = $conn->prepare("UPDATE medicaments SET nom_medicament = ?, description = ?, quantite_disponible = ? WHERE id_medicament = ?");
    $stmt->bind_param("ssii", $nom_medicament, $description, $quantite_disponible, $id_medicament);
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
    <title>Modifier Médicament</title>
    <link rel="stylesheet" href="modifier_medicament.css">
</head>
<body>
    <h1>Modifier Médicament</h1>
    <form method="POST">
        <label for="nom_medicament">Nom du Médicament:</label>
        <input type="text" name="nom_medicament" value="<?php echo htmlspecialchars($medicament['nom_medicament']); ?>" required>

        <label for="description">Description:</label>
        <textarea name="description" required><?php echo htmlspecialchars($medicament['description']); ?></textarea>

        <label for="quantite_disponible">Quantité Disponible:</label>
        <input type="number" name="quantite_disponible" value="<?php echo htmlspecialchars($medicament['quantite_disponible']); ?>" required>

        <input type="submit" value="Mettre à jour">
    </form>
    <a href="medecin_dashboard.php">Retour</a>
</body>
</html>
