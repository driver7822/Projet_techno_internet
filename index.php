<!doctype html>
<?php
session_start();
?>
<html>
<head>
    <title>Site 2020</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="./admin/lib/css/style.css"/>
    <link rel="stylesheet" href="./admin/lib/css/custom.css"/>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <meta charset="utf-8"/>
</head>
<body>
<div id="page">
    <header class="img_header">

    </header>
    <section id="colGauche">
        <nav>
            <?php
            if (file_exists('./lib/php/public_menu.php')) {
                include('./lib/php/public_menu.php');
            }
            ?>
        </nav>
    </section>
    <section id="contenu">
        <div id="main">
            <?php
            if (!isset($_SESSION['page'])) {
                $_SESSION['page'] = "accueil.php";
            }

            if (isset($_GET['page'])) {
                //si on a un param dans l'url
                $_SESSION['page'] = $_GET['page'];
            }

            $path = "./pages/" . $_SESSION['page'];
            if (file_exists($path)) {
                include($path);
            } else {
                include("./pages/page404.php");
            }
            ?>
        </div>
    </section>

</div>

<footer>Lorfèvre Victor</footer>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
</body>
</html>