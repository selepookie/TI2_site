<?php
$produitDB = new ProduitDB($cnx);
$listeProduits = $produitDB->getAllProduits();
$listeProduits = is_array($listeProduits) ? $listeProduits : [];
$nbrProduits = count($listeProduits);

// Charger les catégories
$CategorieDB = $produitDB->getAllCategories(); // Assurez-vous que cette méthode existe et récupère toutes les catégories
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nos produits</title>
</head>
<style>
    .card-body img {
        width: 100%;
        height: auto;
    }

    .description {
        display: none;
    }

    .product-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .product-header .product-info {
        flex-grow: 1;
    }

    .product-header .coeur {
        width: 50px;
        height: auto;
        cursor: pointer;
        margin-left: 10px;
    }
</style>
<body>
<br>
<div class="container">
    <div class="row">
        <div class="col-12 mb-3">
            <select id="categorieSelect" class="form-control">
                <option value="">Toutes les catégories</option>
                <?php foreach ($CategorieDB as $cat): ?>
                    <option value="<?= $cat->id_cat; ?>"><?= $cat->nom_cat; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
</div>

<div class="album py-5 bg-body-tertiary">
    <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            <?php foreach ($listeProduits as $produit): ?>
                <div class="col" data-categorie="<?= $produit->id_cat; ?>">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="product-header">
                                <div class="product-info">
                                    <p class="card-text"><?= $produit->nom_prod; ?></p>
                                    <p class="card-text"><strong><?= $produit->nom_marque; ?></strong></p>
                                </div>
                                <div class="coeur">
                                    <img src="./admin/public/images/heart.png" alt="wishlist">
                                </div>
                            </div>
                            <img src="<?= $produit->image ?>" alt="image">
                            <p class="card-text"><?= $produit->prix; ?> €</p>
                            <button class="btn btn-light toggle-description">Description</button>
                            <p class="description"><?= $produit->descr_prod; ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<script>
    document.getElementById('categorieSelect').addEventListener('change', function() {
        var selectedCat = this.value;
        document.querySelectorAll('.col[data-categorie]').forEach(function(card) {
            if (selectedCat === '' || card.getAttribute('data-categorie') === selectedCat) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    });

    document.querySelectorAll('.toggle-description').forEach(btn => {
        btn.addEventListener('click', () => {
            const description = btn.nextElementSibling;
            if (description.style.display === "none" || description.style.display === "") {
                description.style.display = "block";
            } else {
                description.style.display = "none";
            }
        });
    });
</script>
</body>
</html>
