<?php
header('Content-Type: application/json');

include ('../pg_connect.php');
include ('../classes/Connexion.class.php');
include ('../classes/Categorie.class.php');
include ('../classes/CategorieBD.class.php');

$cnx = Connexion::getInstance($dsn,$user,$password);

$cat = array();
$categorie = new CategorieBD($cnx);

extract($_GET,EXTR_OVERWRITE);

$cat[] = $categorie->updateCategorie($champ,$id,$nouveau);

// conversion du tableau php au format javascript
print json_encode($cat);