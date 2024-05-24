<?php
header('Content-Type: application/json');
// Inclure les fichiers nécessaires
require '../db/dbPgConnect.php';
require '../classes/Connexion.class.php';
require '../classes/Client.class.php';
require '../classes/ClientDB.class.php';

// Vérifier si l'identifiant du client est passé en paramètre
if (isset($_POST['id_client'])) {
    // Créer une instance de ClientDB
    $cnx = Connexion::getInstance($dsn, $user, $password);
    $cl = new ClientDB($cnx);

    // Supprimer le client et renvoyer la réponse JSON
    $response = $cl->deleteClient($_POST['id_client']);
    echo json_encode($response);
} else {
    // Si l'identifiant du client n'est pas fourni, renvoyer une erreur
    echo json_encode(array('success' => false, 'error' => 'Identifiant du client manquant'));
}
?>