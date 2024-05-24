$(document).ready(function () {
    $('#texte_bouton_modif').click(function (e) {
        e.preventDefault();
        let id_client = $('#id_client').val();
        let nom_cli = $('#nom_cli').val();
        let prenom_cli = $('#prenom_cli').val();
        let tel_cli = $('#tel_cli').val();
        let adresse_cli = $('#adresse_cli').val();

        let param = {
            id_client: id_client,
            nom_cli: nom_cli,
            prenom_cli: prenom_cli,
            tel_cli: tel_cli,
            adresse_cli: adresse_cli
        };
        console.log("param : ", param);

        $.ajax({
            url: './src/php/ajax/AjaxUpdateClient.php',
            type: 'GET',
            dataType: 'json',
            data: param,
            success: function (data) {
                console.log("Success response: ", data);
                if (data && data.error) {
                    console.error('Error dans la modification:', data.error);
                } else {
                    alert("Client modifié avec succès.");
                }
            },
            error: function (xhr, status, error) {
                console.error("Error response: ", xhr.responseText);
                console.log("XHR: ", xhr);
                console.log("Status: ", status);
                console.log("Error: ", error);
            }
        });
    });

    $('#submit_btn').text("Ajouter ou mettre à jour");

    $('#reset').click(function () {
        $('#texte_bouton_submit').text("Ajouter ou mettre à jour");
    });

    $('#texte_bouton_submit').click(function (e) {
        e.preventDefault();
        let nom = $('#nom').val();
        let prenom = $('#prenom').val();
        let telephone = $('#telephone').val();
        let adresse = $('#adresse').val();
        let param = 'nom=' + nom + '&prenom=' + prenom + '&telephone=' + telephone + '&adresse=' + adresse;
        console.log(param);
        $.ajax({
            type: 'GET',
            dataType: 'json',
            data: param,
            url: './src/php/ajax/ajaxAjoutClient.php',
            success: function (data) {
                alert("Le client " + prenom + " " + nom + " a bien été ajouté.");
                window.location.href = 'index_.php?page=gestion_clients.php';
                console.log(data);
            }
        });
    });

    /*
    $('#email').blur(function () {
        let email = $(this).val();
        console.log("email : " + email);
        let parametre = 'email=' + email;
        $.ajax({
            type: 'get',
            dataType: 'json',
            data: parametre,
            url: './src/php/ajax/ajaxRechercheClient.php',
            success: function (data) {//data = retour du # php
                console.log(data);
                $('#nom').val(data[0].nom_client);
                $('#prenom').val(data[0].prenom_client);
                $('#adresse').val(data[0].adresse);
                $('#numero').val(data[0].numero);
                $('#texte_bouton_submit').text("Mettre à jour");
                let nom2 = $('#nom').val();
                if (nom2 === '') {
                    $('#texte_bouton_submit').text("Ajouter");
                }
            }
        })
    });
    */

    $('#bouton_suppr').click(function (e) {
        e.preventDefault();
        let id_client = $('#id_client').val();

        let param = {
            id_client: id_client
        };

        console.log("param : ", param);

        $.ajax({
            url: './src/php/ajax/AjaxDeleteClient.php',
            type: 'GET',
            dataType: 'json',
            data: $.param(param),
            success: function (data) {
                if (data && data.error) {
                    console.error('Erreur dans la suppression:', data.error);
                } else {
                    alert("Client supprime avec succes.");
                }
            },
            error: function (data) {
                console.log(data);
            }
        });
    });
});
