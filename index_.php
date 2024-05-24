<?php
session_start();
require './admin/src/php/utils/liste_includes.php';
?>
<!doctype html>
<html lang="fr">
<head>
    <title>cc</title>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="admin/public/css/tout.css" type="text/css">
    <script src="admin/public/js/fonctions.js"></script>
</head>
<body>
<div class="container">
    <header id="header">
    </header>

    <style>
        img {
                width: 60px;
                size: auto;
            }
        body {
            background-color: #f6ebf0;
        }

    </style>
    <div id="tout">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="admin/public/images/makeup.png" alt="Logo" style="height: 60px;">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#combinedNavbar"
                        aria-controls="combinedNavbar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="combinedNavbar">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index_.php?page=accueil.php">Accueil <i class="bi bi-house"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index_.php?page=produits.php">Nos produits <i class="bi bi-list-ul"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index_.php?page=marques.php">Nos marques <i class="bi bi-telephone"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index_.php?page=contact.php">Wishlist <i class="bi bi-telephone"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index_.php?page=login.php">Connexion admin <i class="bi bi-person-gear"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>



    <div id="contenu">
        <?php
        //si aucune variable de session 'page'
        if (!isset($_SESSION['page'])) {
            $_SESSION['page'] = './pages/accueil.php';
        }
        if (isset($_GET['page'])) {
            //print "<br>paramètre page : ".$_GET['page']."<br>";
            $_SESSION['page'] = 'pages/'.$_GET['page'];
        }
        if (file_exists($_SESSION['page'])) {
            include $_SESSION['page'];
        } else {
            include './pages/page404.php';
        }
        ?>
    </div>
    <footer id="footer">&nbsp;</footer>
</div>
</div>
</body>

</html>