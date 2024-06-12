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
                            <img src="<?= $marque->image ?>" alt="<?= $marque->nom; ?>" class="marque-image" data-marque="<?= $marque->id_marque; ?>">
                        </div>
                        <button class="btn btn-light toggle-description">Description</button>
                        <p class="description"><?= $marque->descr_marque; ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<script>
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