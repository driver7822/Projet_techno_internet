<?php
header('Content-Type: application/json');

include ('../pg_connect.php');
include ('../classes/Connexion.class.php');
include ('../classes/Avis.class.php');
include ('../classes/AvisBD.class.php');

$cnx = Connexion::getInstance($dsn,$user,$password);

$av = array();
$avis = new AvisBD($cnx);

extract($_GET,EXTR_OVERWRITE);

$av[] = $avis->AjoutAvis(urldecode($pseudo),urldecode($date),urldecode($message),$id_produit);

// conversion du tableau php au format javascript
print json_encode($cat);