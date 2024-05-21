<?php
if (isset($_GET['id_client'])) {
    $clientDB = new ClientDB($cnx);
    $client = $clientDB->getClientById($_GET['id_client']);
    if (!$client) {
        exit('Aucun client trouvé avec cet identifiant');
    }
} else {
    exit('Aucun identifiant de client na été fourni');
}
?>

<h2>Modification Clients</h2>
<link rel="stylesheet" href="./public/css/tout.css">
<div class="container">
    <form id="form_modification" method="get">
        <input type="hidden" name="id_client" value="<?= $client[0]->id_client; ?>" id="id_client">
        <div class="mb-3">
            <label for="nom_cli" class="form-label">Nom Client : </label>
            <input type="text" class="form-control" id="nom_cli" name="nom_cli" value="<?= $client[0]->nom_cli ?? ''; ?>">
        </div>
        <div class="mb-3">
            <label for="prenom_cli" class="form-label">Prénom Client : </label>
            <input type="text" class="form-control" id="prenom_cli" name="prenom_cli" value="<?= $client[0]->prenom_cli ?? ''; ?>">
        </div>
        <div class="mb-3">
            <label for="tel_cli" class="form-label">Téléphone Client : </label>
            <input type="text" class="form-control" id="tel_cli" name="tel_cli" value="<?= $client[0]->tel_cli ?? ''; ?>">
        </div>
        <div class="mb-3">
            <label for="adresse_cli" class="form-label">Adresse Client : </label>
            <input type="text" class="form-control" id="adresse_cli" name="adresse_cli" value="<?= $client[0]->adresse_cli ?? ''; ?>">
        </div>
        <button type="submit" id="texte_bouton_modif" class="btn btn-primary">
            Modifier
        </button>
        <button class="btn btn-primary" type="reset" id="reset">Annuler</button>
    </form>
</div>