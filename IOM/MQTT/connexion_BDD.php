<?php
require("phpMQTT.php");

$server = '192.168.1.122';     // Adresse IP de votre broker MQTT
$port = 1883;                   // Port de votre broker MQTT
$username = 'test';             // Nom d'utilisateur MQTT
$password = 'test';             // Mot de passe MQTT
$client_id = uniqid();          // Identifiant client unique

$mqtt = new phpMQTT($server, $port, $client_id);

if ($mqtt->connect(true, NULL, $username, $password)) {
    $mqtt->subscribe(['hospital/sensors' => ['qos' => 0, 'function' => 'procMsg']]);
    while ($mqtt->proc()) {
        // Traitement en continu
    }
    $mqtt->close();
} else {
    echo "Échec de la connexion au MQTT";
}

function procMsg($topic, $msg) {
    global $conn; // Assurez-vous que la connexion à la base de données est établie ici
    $data = explode(',', $msg);
    $temperature = $data[0];
    $co2 = $data[1];

    // Insertion dans la base de données
    $stmt = $conn->prepare("INSERT INTO capteurs (type_capteur, valeur, timestamp, id_patient) VALUES (?, ?, NOW(), ?)");
    
    // Exemple d'insertion pour les capteurs
    $stmt->bind_param("sdi", $type_capteur, $valeur, $id_patient);
    
    // Insérer la température
    $type_capteur = 'temp';
    $valeur = $temperature;
    $id_patient = 1; // Remplacez par l'ID patient approprié
    $stmt->execute();

    // Insérer le CO2
    $type_capteur = 'co2';
    $valeur = $co2;
    $stmt->execute();

    echo "Données insérées : Température = $temperature, CO2 = $co2\n";
}
