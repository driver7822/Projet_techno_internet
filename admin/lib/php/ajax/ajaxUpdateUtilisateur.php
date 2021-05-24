<?php

header('Content-Type: application/json');

include ('../pg_connect.php');
include ('../classes/Connexion.class.php');
include ('../classes/Utilisateur.class.php');
include ('../classes/UtilisateurBD.class.php');

$cnx = Connexion::getInstance($dsn,$user,$password);

$util = array();
$utilisateur = new UtilisateurBD($cnx);
// id produit est un parametre de l'url
// ds js : var parametre = "id_produit="+id;

extract($_GET,EXTR_OVERWRITE);

$util[] = $utilisateur->UpdateUtilisateur($id_utilisateur,urldecode($pseudo),urldecode($prenom),urldecode($nom),urldecode($email),urldecode($date_naissance));

// conversion du tableau php au format javascript
print json_encode($util);