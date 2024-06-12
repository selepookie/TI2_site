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


    $(document).on('click', '.heart-btn', function(){
        let id_prod = $(this).data('id');
        var param = 'id_produit=' + id_prod;
        console.log(param);
        $.ajax({
            type: 'POST',
            dataType: 'json',
            data: param,
            url: './src/php/ajax/update_wishlist.php',
            success: function (data) {
                console.log(data);
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });

});
