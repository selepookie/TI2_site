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

<h2>Suppression d'un client</h2>

<input type="hidden" name="id_client" value="<?= $client[0]->id_client; ?>" id="id_client">
<p>Nom : <?= $client[0]->nom_cli ?? ''; ?></p>
<p>Prenom : <?= $client[0]->prenom_cli ?? ''; ?></p>
<p>Telephone : <?= $client[0]->tel_cli ?? ''; ?></p>
<p>Adresse : <?= $client[0]->adresse_cli ?? ''; ?></p>
<p>Souhaitez-vous supprimer ce client ?</p>
<button type="button" id="bouton_suppr" class="btn btn-primary">Supprimer</button>
<a href="index_.php?page=gestion_clients.php" class="btn btn-primary">Annuler</a>

<script>

    document.getElementById('bouton_suppr').addEventListener('click',function () {
        let id_client = $('#id_client').val();
        console.log(id_client)
        let param = 'id_client=' + id_client;
        console.log("param : ", param);
        $.ajax({
            type: 'get',
            dataType: 'json',
            data: param,
            url: './src/php/ajax/ajaxDeleteClient.php',
            success: function (data) {
                console.log(data);
                alert("Le client " + id_client + " a bien été supprimé.");
            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
    });
</script>