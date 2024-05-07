<h2>Ajout des clients</h2>
<div class="container">
    <form id="form_ajout" method="get" action="">
        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom">
        </div>
        <div class="mb-3">
            <label for="prenom" class="form-label">Prénom</label>
            <input type="text" class="form-control" id="prenom" name="prenom">
        </div>
        <div class="mb-3">
            <label for="adresse" class="form-label">Adresse</label>
            <input type="text" class="form-control" id="adresse" name="adresse">
        </div>
        <div class="mb-3">
            <label for="tel" class="form-label">Tel</label>
            <input type="text" class="form-control" id="tel" name="tel">
        </div>
        <button type="submit" id="texte_bouton_submit" class="btn btn-primary">
            Ajouter ou Modifier
        </button>
        <button class="btn btn-primary" type="reset" id="reset">Annuler</button>
    </form>
</div>