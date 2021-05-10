<?php
session_start();
header('Content-Type: application/json');

include ('../pg_connect.php');
include ('../classes/Connexion.class.php');
include ('../classes/Produit.class.php');
include ('../classes/ProduitBD.class.php');

$cnx = Connexion::getInstance($dsn,$user,$password);

$produit = new ProduitBD($cnx);

extract($_GET,EXTR_OVERWRITE);

$_SESSION['prod'] = serialize($produit->getAllProduitFiltre(urldecode($filtre),urldecode($motcles)));

// conversion du tableau php au format javascript
print json_encode($_SESSION['prod']);