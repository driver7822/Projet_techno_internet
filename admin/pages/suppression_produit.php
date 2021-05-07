<?php

    $prod = new ProduitBD($cnx);

    if (isset($_GET['id'])){
        $prod->deleteProduit($_GET['id']);
        header("Location: index.php?page=gestion_produit.php");
        exit();
    } else {
        header("Location: index.php?page=page404.php");
        exit();
    }