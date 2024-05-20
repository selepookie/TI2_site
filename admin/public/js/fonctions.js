

$(document).ready(function () {
    // Gestion du clic sur le bouton "Modifier"
    $('.updateBtn').click(function () {
        var id = $(this).data('id');
        var nom = $('#nom_' + id).text().trim();
        var prenom = $('#prenom_' + id).text().trim();
        var tel = $('#tel_' + id).text().trim();
        var adresse = $('#adresse_' + id).text().trim();

        // Envoi des données modifiées au serveur via AJAX
        $.ajax({
            type: 'POST',
            url: './src/php/ajax/ajaxUpdateClient.php',
            data: {
                id: id,
                nom_cli: nom,
                prenom_cli: prenom,
                tel_cli: tel,
                adresse_cli: adresse
            },
            success: function(response) {
                if (response.success) {
                    // Affichage d'un message de succès
                    alert('Client mis à jour avec succès.');
                    // Rechargement de la page pour afficher les modifications
                    location.reload();
                } else {
                    // Affichage d'un message d'erreur
                    alert('Erreur lors de la mise à jour du client : ' + response.message);
                }
            }
        });
    });
});



    $('#submit_btn').text("Ajouter ou mettre à jour");

    $('#reset').click(function () {
        $('#texte_bouton_submit').text("Ajouter ou mettre à jour");
    });

$(document).ready(function () {
    $('#texte_bouton_submit').click(function (e) {
        e.preventDefault();
        let nom = $('#nom').val();
        let prenom = $('#prenom').val();
        let telephone = $('#telephone').val();
        let adresse = $('#adresse').val();
        let param = 'nom=' + nom + '&prenom=' + prenom + '&telephone=' + telephone + '&adresse=' + adresse;
        console.log(param);
        let retour = $.ajax({
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
});


/*
$('#email').blur(function () {
    let email = $(this).val();
    console.log("email : " + email);
    let parametre = 'email=' + email;
    let retour = $.ajax({
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
})

*/

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
            if (data && data.error) {
                console.error('Error dans la modification:', data.error);
            } else {
                alert("Client modifié avec succès.");
            }
        },
        error: function (data) {
            console.log(data);
        }
    });
});