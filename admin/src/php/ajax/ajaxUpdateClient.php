<?php
require '../db/dbPgConnect.php';
require '../classes/Connexion.class.php';
require '../classes/Client.class.php';
require '../classes/ClientDB.class.php';

try {
    $cnx = Connexion::getInstance($dsn, $user, $password);

    // Vérifie si tous les paramètres sont définis dans $_GET
    if (isset($_GET['id_client'], $_GET['nom_cli'], $_GET['prenom_cli'], $_GET['tel_cli'], $_GET['adresse_cli'])) {
        $id_client = $_GET['id_client'];
        $nom_cli = $_GET['nom_cli'];
        $prenom_cli = $_GET['prenom_cli'];
        $tel_cli = $_GET['tel_cli'];
        $adresse_cli = $_GET['adresse_cli'];

        // Afficher les paramètres pour le débogage
        echo "ID Client: $id_client<br>";
        echo "Nom: $nom_cli<br>";
        echo "Prénom: $prenom_cli<br>";
        echo "Téléphone: $tel_cli<br>";
        echo "Adresse: $adresse_cli<br>";

        $clientDB = new ClientDB($cnx);

        // Effectue la mise à jour du client spécifié
        $clientDB->updateClient($id_client, 'nom_cli', $nom_cli);
        $clientDB->updateClient($id_client, 'prenom_cli', $prenom_cli);
        $clientDB->updateClient($id_client, 'tel_cli', $tel_cli);
        $clientDB->updateClient($id_client, 'adresse_cli', $adresse_cli);

        // Répond avec un message de succès
        $response['success'] = true;
        $response['message'] = "Les informations du client ont été mises à jour avec succès.";
        echo json_encode($response);
    } else {
        throw new Exception("Certains paramètres sont manquants dans l'URL.");
    }
} catch (Exception $e) {
    // Répond avec un message d'erreur en cas d'échec
    $response['success'] = false;
    $response['message'] = $e->getMessage();
    echo json_encode($response);
}
?>