<?php
    $cat = new CategorieBD($cnx);

    if (isset($_GET['id'])){
        $cat->DeleteCategorie($_GET['id']);
        header("Location: index.php?page=gestion_categorie.php");
        exit();
    } else {
        header("Location: index.php?page=page404.php");
        exit();
    }