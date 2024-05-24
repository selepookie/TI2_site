<?php
header('Content-Type: application/json');

require '../db/dbPgConnect.php';
require '../classes/Connexion.class.php';
require '../classes/Produit.class.php';
require '../classes/ProduitDB.class.php'; // Assurez-vous que la classe ProduitDB est incluse correctement
$cnx = Connexion::getInstance($dsn, $user, $password);

$pd = new ProduitDB($cnx);
$data = $pd->getProduitByMarque($_GET['id_marque']);

// Tableau pour stocker les produits formatés
$formattedProducts = array();

// Formater les produits
foreach ($data as $row) {
    $formattedProduct = array(
        'nom_prod' => $row['nom_prod'],
        'descr_prod' => $row['descr_prod'],
        'nom_marque' => $row['nom_marque'],
        'image' => $row['image'],
    );
    // Ajouter le produit formaté au tableau principal
    $formattedProducts[] = $formattedProduct;
}

// Renvoyer les produits formatés en tant que JSON
echo json_encode($formattedProducts);
?>