<?php
header('Content-Type: application/json');

include ('../pg_connect.php');
include ('../classes/Connexion.class.php');
include ('../classes/Produit.class.php');
include ('../classes/ProduitBD.class.php');

$cnx = Connexion::getInstance($dsn,$user,$password);

$pr = array();
$produit = new ProduitBD($cnx);

extract($_GET,EXTR_OVERWRITE);

$pr[] = $produit->getProduitById2($id_produit);

// conversion du tableau php au format javascript
print json_encode($pr);