<?php
$produitDB = new ProduitDB($cnx);
$listeProduits = $produitDB->getAllProduits();

// Assurez-vous que $listeMaisons est toujours un tableau
$listeProduits = is_array($listeProduits) ? $listeProduits : [];

$nbrProduits = count($listeProduits);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nos produits</title>
</head>
<style>
    body{
        background-image: url('https://i.pinimg.com/736x/4f/9f/bf/4f9fbf0128a80ebab6ef844439599793.jpg');
        background-size: cover;
        background-position: center;
    }
    .card-body img {
        width: 100%; /* occupe toute la largeur de son conteneur */
        height: auto; /* permet de maintenir les proportions de l'image */
    }
    .description {
        display: none; /* masque la description par défaut */
    }
</style>
<body>
<div class="album py-5 bg-body-tertiary">
    <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            <?php foreach ($listeProduits as $produit): ?>
                <div class="col">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <p class="card-text"><?= $produit->nom_prod; ?></p>
                            <p class="card-text"><strong><?= $produit->nom_marque; ?></strong></p>
                            <img src="<?php echo $produit->image ?>" alt="image">
                            <p class="card-text"><?= $produit->prix; ?> €</p>
                            <button class="btn btn-light toggle-description">Description</button>
                            <!-- Description -->
                            <p class="description"><?= $produit->descr_prod; ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

<script>
    // JavaScript pour afficher/masquer la description
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