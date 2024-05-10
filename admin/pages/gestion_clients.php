<h2>Gestion des clients</h2>
<a href="index_.php?page=ajout_client.php">Nouveau client</a><br>

<?php
//récupération des clients et affichage dans table bootstrap
$clients = new ClientDB($cnx);
$liste = $clients->getAllClients();
//var_dump($liste);
$nbr = count($liste);

if ($nbr == 0) {
    print "<br>Aucun client encodé<br>";
} else {
    ?>

        <style>
            img{
                width:20px;
                size:auto;
            }
        </style>
    <table class="table table-striped">
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
        for ($i = 0; $i < $nbr; $i++) {
            ?>
            <tr>
                <th><?= $liste[$i]->id_client; ?></th>
                <td contenteditable="true" id="<?= $liste[$i]->id_client; ?>"
                    name="nom_client"><?= $liste[$i]->nom_cli; ?></td>
                <td contenteditable="true" id="<?= $liste[$i]->id_client; ?>"
                    name="prenom_client"><?= $liste[$i]->prenom_cli; ?></td>
                <td contenteditable="true" id="<?= $liste[$i]->id_client; ?>"
                    name="tel_cli"><?= $liste[$i]->tel_cli; ?></td>
                <td contenteditable="true" id="<?= $liste[$i]->id_client; ?>"
                    name="adresse"><?= $liste[$i]->adresse_cli; ?></td>
                <td> <a href="index_.php?page=modifier_client.php&id=<?= $liste[$i]->id_client;?>"><img src="public/images/edit.png" alt="Modifier" ></a></td>
                <td><a href="index_.php?page=delete_client.php&id=<?= $liste[$i]->id_client;?>"><img src="public/images/remove.png" alt="Effacer" ></a></td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
    <?php
//affichage des clients existants
}
?>