<?php
header('Content-Type: application/json');
require '../db/dbPgConnect.php';
require '../classes/Connexion.class.php';
require '../classes/Maison.class.php';
require '../classes/MaisonDB.class.php';

try {
    $cnx = Connexion::getInstance($dsn, $user, $password);

    // Check if id_maison is set in $_GET
    if(isset($_GET['id_client'])) {
        $client = new ClientDB($cnx);
        // Call the deleteMaisonById method
        $data[] = $client->deleteclient($_GET['id_client']);
        print json_encode($data);
    } else {
        throw new Exception("Missing id_client parameter in the URL.");
    }
} catch (Exception $e) {
    print json_encode($e->getMessage());
}