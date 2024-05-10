$(document).ready(function () {

    // quand une balise contient des attributs, cette balise est un tableau
    $('td[id]').click(function () {
        // trim : supprimer les blancs avant et après
        let valeur1 = $.trim($(this).text());
        let id = $(this).attr('id');
        let name = $(this).attr('name');
        console.log(valeur1 + " id : " + id + " name : " + name);
        $(this).blur(function () {
            let valeur2 = $.trim($(this).text());
            if (valeur1 != valeur2) {
                let parametre = "id=" + id + "&name=" + name + "&valeur=" + valeur2;
                let retour = $.ajax({
                    type: 'get',
                    dataType: 'json',
                    data: parametre,
                    url: './src/php/ajax/ajaxUpdateClient.php',
                    success: function (data) {
                        console.log(data);
                    }
                })
            }
        })
    });

    $('#submit_btn').text("Ajouter ou mettre à jour");

    $('#reset').click(function () {
        $('#texte_bouton_submit').text("Ajouter ou mettre à jour");
    });

    $('#submit_btn').click(function(e) {
        e.preventDefault();

        let nom_cli = $('#nom_cli').val();
        let prenom_cli = $('#prenom_cli').val();
        let tel_cli = $('#tel_cli').val();
        let adresse_cli = $('#adresse_cli').val();

        console.log(nom_cli);

        let param ='nom_cli='+nom_cli+'&prenom_cli='+prenom_cli+'&tel_cli='+tel_cli+'&adresse_cli='+adresse_cli;

        let retour = $.ajax({
            type: 'get',
            dataType: 'json',
            data: param,
            url: './src/php/ajax/ajaxAjoutClient.php',
            success: function(data) {
                console.log(data);
                alert('Client ajouté avec succès !');
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                alert('Une erreur s\'est produite lors de l\'ajout du client.');
            }
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

});