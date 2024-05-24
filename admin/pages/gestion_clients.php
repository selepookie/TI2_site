<h2>Clients Inscrits</h2>

<?php
// Récupération des clients et affichage dans une table Bootstrap
$clients = new ClientDB($cnx);
$liste = $clients->getAllClients();
$nbr = count($liste);

if ($nbr == 0) {
    print "<br>Aucun client encodé<br>";
} else {
    ?>

    <a href="index_.php?page=ajout_client.php"><img src="public/images/add.png"></a>
    <table class="table table-striped" id="clientTable">
        <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Nom</th>
            <th scope="col">Prénom</th>
            <th scope="col">Téléphone</th>
            <th scope="col">Adresse</th>
            <th scope="col">Modifier</th>
            <th scope="col">Supprimer</th>
        </tr>
        </thead>
        <tbody>
        <?php
        // Utilisation d'une boucle pour afficher chaque client dans une ligne du tableau
        for ($i = 0; $i < $nbr; $i++) {
            ?>
            <tr id="row<?= $liste[$i]->id_client; ?>">
                <th><?= $liste[$i]->id_client; ?></th>
                <td class="editable" data-id="<?= $liste[$i]->id_client; ?>" data-field="nom_cli"><?= $liste[$i]->nom_cli; ?></td>
                <td class="editable" data-id="<?= $liste[$i]->id_client; ?>" data-field="prenom_cli"><?= $liste[$i]->prenom_cli; ?></td>
                <td class="editable" data-id="<?= $liste[$i]->id_client; ?>" data-field="tel_cli"><?= $liste[$i]->tel_cli; ?></td>
                <td class="editable" data-id="<?= $liste[$i]->id_client; ?>" data-field="adresse_cli"><?= $liste[$i]->adresse_cli; ?></td>
                <td><a class="imgimg" href="index_.php?page=modifier_client.php&id_client=<?= $liste[$i]->id_client; ?>"><img src="public/images/edit.png" alt="Modifier"></a></td>
                <td><a class="imgimg" href="index_.php?page=delete_client.php&id_client=<?= $liste[$i]->id_client;?>"><img src="public/images/remove.png" alt="Effacer" ></a></td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
    <?php
}
?>