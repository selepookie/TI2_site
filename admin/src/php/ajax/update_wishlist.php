<?php

require '../db/dbPgConnect.php';
require '../classes/Connexion.class.php';
require '../classes/Produit.class.php';
require '../classes/ProduitDB.class.php';

$cnx = Connexion::getInstance($dsn, $user, $password);

$cl = new ProduitDB($cnx);
$data[] = $cl->likeProduit($_GET['id_produit']);
print json_encode($data);