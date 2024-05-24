<?php
if (isset($_POST['submit_login'])) {
    extract($_POST, EXTR_OVERWRITE);
    $ad = new AdminDB($cnx);
    $admin = $ad->getAdmin($login, $password);
    if ($admin) {
        $_SESSION['admin'] = 1;
        ?>
        <meta http-equiv="refresh" content="0;URL=admin/index_.php?page=accueil_admin.php">
        <?php

    } else {
        print "<br>Accès réservé aux administrateurs";
        ?>
        <meta http-equiv="refresh" content="2;URL=index_.php?page=accueil.php">
        <?php
    }
}
?>

<form method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
    <br>
    <h5>Connexion Administrateur</h5><br>
    <div class="input-group flex-nowrap">
        <span class="input-group-text" id="objet_login"><i class="bi bi-person-circle"></i></span>
        <input type="text" class="form-control" placeholder="Login" name="login" id="login">
    </div>
    <br>
    <div class="input-group flex-nowrap">
        <span class="input-group-text" id="objet_password"><i class="bi bi-key-fill"></i></span>
        <input type="password" class="form-control" placeholder="Password" name="password" id="password">
    </div>
    <br>
    <button type="submit" class="btn btn-outline-dark" name="submit_login">Connexion</button>
</form>