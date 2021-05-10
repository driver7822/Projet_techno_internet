<?php
session_start();

header('Content-Type: application/json');
/*
 * Inclure les fichiers nécessaire à la communication avec la BD car on ne passe pas par la bd
 * Ce fichier est appelé par fonctions_jquery.js
 */

include ('../classes/Panier.class.php');

$panier = new Panier();

$pa = $panier->ViderPanier();

// conversion du tableau php au format javascript
print json_encode($pa);