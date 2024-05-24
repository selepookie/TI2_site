<?php
$marqueDB = new MarqueDB($cnx);
$listeMarques = $marqueDB->getAllMarques();
$listeMarques = is_array($listeMarques) ? $listeMarques : [];
$nbrMarques = count($listeMarques);
?>

<style>

    .card-body img {
        width: 80%;
        height: auto;
    }
</style>

<div class="album py-5 bg-body-tertiary">
    <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3" id="products-container">
            <?php foreach ($listeMarques as $marque): ?>
                <div class="col" data-categorie="<?= $marque->id_marque; ?>">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <button><img src="<?= $marque->image ?>" alt="<?= $marque->nom; ?>" class="marque-image" data-marque="<?= $marque->id_marque; ?>"></button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<script>

    // Ajoute un gestionnaire d'événements de clic à chaque image de marque
    document.addEventListener('DOMContentLoaded', function() {
        var marqueImages = document.querySelectorAll('.marque-image');
        marqueImages.forEach(function(image) {
            image.addEventListener('click', function() {
                var id_marque = this.getAttribute('data-marque');
                loadProductsByMarque(id_marque);
            });
        });
    });

    // Fonction pour charger les produits associés à une marque via AJAX
    function loadProductsByMarque(id_marque) {
        // Envoie de la requête AJAX
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Mettre à jour le contenu des produits dans le conteneur
                    document.getElementById('products-container').innerHTML = xhr.responseText;
                } else {
                    // Gérer les erreurs éventuelles
                    console.error('Erreur lors de la requête : ' + xhr.status);
                }
            }
        };
        xhr.open('GET', 'admin/src/php/ajax/ajaxProdMarque.php?id_marque=' + id_marque, true);
        xhr.send();
    }
</script>