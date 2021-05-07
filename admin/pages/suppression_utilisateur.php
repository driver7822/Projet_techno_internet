<?php
$util = new UtilisateurBD($cnx);

if (isset($_GET['id'])){
    $util->DeleteUtilisateur($_GET['id']);
    header("Location: index.php?page=gestion_categorie.php");
    exit();
} else {
    header("Location: index.php?page=page404.php");
    exit();
}