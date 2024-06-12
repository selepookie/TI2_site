<div id="titrecontact">
    <h2>Nos contacts</h2>
</div>
<img src="./admin/public/images/telephone.gif" class="imgclic" data-target="num"> <div id="num">0491/xxx xxx</div>
<img src="./admin/public/images/message.gif" class="imgclic" data-target="mail"> <div id="mail">selena@makeup.com</div>
<img src="./admin/public/images/google-maps.gif" class="imgclic" data-target="carte">
<div id="carte">
    <iframe src="https://www.google.com/maps/embed?pb=..."
            width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>

<script>

    $('#num').hide();
    $('#mail').hide();
    $('#carte').hide();

    $('.imgclic').click(function () {
        var targetId = $(this).data('target');

        $('#' + targetId).slideDown('slow');
    });
</script>