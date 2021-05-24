<?php
session_start();

header('Content-Type: application/json');
/*
 * Inclure les fichiers nécessaire à la communication avec la BD car on ne passe pas par la bd
 * Ce fichier est appelé par fonctions_jquery.js
 */

include ('../pg_connect.php');
include ('../classes/Connexion.class.php');
include ('../classes/Panier.class.php');
include ('../classes/Produit.class.php');
include ('../classes/ProduitBD.class.php');

$cnx = Connexion::getInstance($dsn,$user,$password);

$panier = new Panier();
$produit = new ProduitBD($cnx);

extract($_GET,EXTR_OVERWRITE);

$stock = $produit->getQuantiterById($idProd);

$pa = $panier->ChangerQuantiter($idProd,$nouveau,$stock);

// conversion du tableau php au format javascript
print json_encode($pa);