<?php
$avis = new AvisBD($cnx);

if (isset($_GET['id'])){
    $avis->DeleteAvisById($_GET['id']);
    $idprod = $_GET['idProd'];
    header("Location: index.php?page=modification_produit.php&id=$idprod");
    exit();
} else {
    header("Location: index.php?page=page404.php");
    exit();
}