<?php

extract($_POST,EXTR_OVERWRITE);

$readyToSend = true;


if(empty($pseudo) || empty($mdp) || empty($nom) || empty($prenom) || empty(urldecode($email)) || empty(urldecode($date_de_naissance))){
    $readyToSend = false;

    $_SESSION['ErreurCreationUtili'] = "Veuillez remplir tout le formulaire";
}

if ($readyToSend){
    $util = new UtilisateurBD($cnx);

    $utilisateur = $util->AjoutUtilisateur($pseudo,$mdp,$nom,$prenom,$email,$date_de_naissance);

    if ($utilisateur == 0){
        $_SESSION['ErreurCreationUtili'] = "Erreur, Pseudo déjà utilisé";
    } else {
        $_SESSION['user']=1;
        $_SESSION['login_user']=$pseudo;
    }

}

?>

<meta http-equiv="refresh": content="0;URL=index.php?page=accueil.php">


