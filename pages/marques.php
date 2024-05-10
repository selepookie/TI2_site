<?php
$marqueDB = new MarqueDB($cnx);
$listeMarques = $marqueDB->getAllMarques();
$listeMarques = is_array($listeMarques) ? $listeMarques : [];
$nbrMarques = count($listeMarques);
?>

<style>

    .card-body img {
        width: 100%;
        height: auto;
    }
</style>

<div class="album py-5 bg-body-tertiary">
    <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            <?php foreach ($listeMarques as $marque): ?>
                <div class="col" data-categorie="<?= $marque->id_marque; ?>">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <img src="<?= $marque->image ?>" alt="image">
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
