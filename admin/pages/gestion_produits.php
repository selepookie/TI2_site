<h2>Liste des produits en vente</h2>

<?php
// Récupération des clients et affichage dans une table Bootstrap
$produits = new ProduitDB($cnx);
$liste = $produits->getAllProduits();
$nbr = count($liste);

if ($nbr == 0) {
    print "<br>Aucun produit encodé<br>";
} else {
    ?>
    <table class="table table-striped" id="prodTable">
        <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Nom</th>
            <th scope="col">Description</th>
            <th scope="col">Prix</th>
            <th scope="col">Id Catégorie</th>
            <th scope="col">Id Marque</th>
            <th scope="col">Nom Marque</th>
            <th scope="col">Stock</th>
        </tr>
        </thead>
        <tbody>
        <?php
        // Utilisation d'une boucle pour afficher chaque client dans une ligne du tableau
        for ($i = 0; $i < $nbr; $i++) {
            ?>
            <tr id="row<?= $liste[$i]->id_produit; ?>">
                <th><?= $liste[$i]->id_produit; ?></th>
                <td contenteditable="true" class="editable" data-id="<?= $liste[$i]->id_produit; ?>" data-field="nom_prod"><?= $liste[$i]->nom_prod; ?></td>
                <td contenteditable="true" class="editable" data-id="<?= $liste[$i]->id_produit; ?>" data-field="descr_prod"><?= $liste[$i]->descr_prod; ?></td>
                <td contenteditable="true" class="editable" data-id="<?= $liste[$i]->id_produit; ?>" data-field="prix"><?= $liste[$i]->prix; ?></td>
                <td contenteditable="true" class="editable" data-id="<?= $liste[$i]->id_produit; ?>" data-field="id_cat"><?= $liste[$i]->id_cat; ?></td>
                <td contenteditable="true" class="editable" data-id="<?= $liste[$i]->id_produit; ?>" data-field="id_marque"><?= $liste[$i]->id_marque; ?></td>
                <td contenteditable="true" class="editable" data-id="<?= $liste[$i]->id_produit; ?>" data-field="nom_marque"><?= $liste[$i]->nom_marque; ?></td>
                <td contenteditable="true" class="editable" data-id="<?= $liste[$i]->id_produit; ?>" data-field="stock"><?= $liste[$i]->stock; ?></td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
    <?php
}
?>