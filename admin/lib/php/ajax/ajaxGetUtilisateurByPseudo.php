<?php
header('Content-Type: application/json');

include ('../pg_connect.php');
include ('../classes/Connexion.class.php');
include ('../classes/Utilisateur.class.php.');
include ('../classes/UtilisateurBD.class.php');

$cnx = Connexion::getInstance($dsn,$user,$password);

$util = array();
$utilisateur = new UtilisateurBD($cnx);

extract($_GET,EXTR_OVERWRITE);


$util[] = $utilisateur->getUtilisateurByPseudo($pseudo);


// conversion du tableau php au format javascript
print json_encode($util);