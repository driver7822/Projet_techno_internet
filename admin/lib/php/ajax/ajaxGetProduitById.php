<?php
header('Content-Type: application/json');
/*
 * Inclure les fichiers nécessaire à la communication avec la BD car on ne passe pas par la bd
 * Ce fichier est appelé par fonctions_jquery.js
 */
include ('../pg_connect.php');
include ('../classes/Connexion.class.php');
include ('../classes/Produit.class.php');
include ('../classes/ProduitBD.class.php');

$cnx = Connexion::getInstance($dsn,$user,$password);

$pr = array();
$produit = new ProduitBD($cnx);
// id produit est un parametre de l'url
// ds js : var parametre = "id_produit="+id;

extract($_GET,EXTR_OVERWRITE);

$pr[] = $produit->getProduitById2($id_produit);

// conversion du tableau php au format javascript
print json_encode($pr);