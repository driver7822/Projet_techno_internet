<?php
header('Content-Type: application/json');
/*
 * Inclure les fichiers nécessaire à la communication avec la BD car on ne passe pas par la bd
 * Ce fichier est appelé par fonctions_jquery.js
 */
include ('../pg_connect.php');
include ('../classes/Connexion.class.php');
include ('../classes/Categorie.class.php');
include ('../classes/CategorieBD.class.php');

$cnx = Connexion::getInstance($dsn,$user,$password);

$cat = array();
$categorie = new CategorieBD($cnx);
// id produit est un parametre de l'url
// ds js : var parametre = "id_produit="+id;

extract($_GET,EXTR_OVERWRITE);

$cat[] = $categorie->AjoutCategorie($nom_categorie);

// conversion du tableau php au format javascript
print json_encode($cat);