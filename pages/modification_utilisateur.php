<?php
if (isset($_SESSION['user'])){
    if (isset($_POST['modifierMDP'])) {
        extract($_POST,EXTR_OVERWRITE);


        if ($ConfirmMotDePasse==$newMotDePasse) {
            $util = new UtilisateurBD($cnx);

            $utilisateur = $util->ModifierMDP($pseudo,$oldMotDePasse,$newMotDePasse);

            if ($utilisateur==2) {
                $messageError = "Vous ne pouvez pas indiquer le même mot de passe";
            }

            if ($utilisateur==1){
                $message = "Modification avec succès";
            }
        } else {
            $messageError = "La confirmation ne correspond pas au nouveau mot de passe";
        }
    }

?>

<br>
<h2>Mes informations</h2>
<br>
<div class="container">
    <form>
        <div class="col mb-2">
            <label for="pseudo" class="form-label">Pseudo</label>
            <input type="text" class="form-control" id="pseudo" name="pseudo" aria-describedby="pseudo" value="<?php print $_SESSION['login_user'];?>">
        </div>
        <div class="row">
            <div class="col mb-2">
                <label for="prenom" class="form-label">Prénom</label>
                <input type="text" class="form-control" id="prenom" name="prenom" aria-describedby="prenom">
            </div>
            <div class="col mb-2">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" aria-describedby="nom">
            </div>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Adresse email</label>
            <input type="email" class="form-control" id="email" name="email" aria-describedby="email">
        </div>
        <div class="mb-3">
            <label class="control-label" for="date_de_naissance">Date de naissance</label>
            <input class="form-control" id="date_de_naissance" name="date_de_naissance" placeholder="JJ/MM/YYYY" type="date"/>
        </div>
        <input type="hidden" name="id_utilisateur" id="id_utilisateur">
    </form>
    <button type="submit" class="btn btn-primary" name="modificationUtilisateur" id="modificationUtilisateur">Enregistrer les modifications</button>
</div>
<br>
<h2>Changer de mot de passe</h2>
<?php
if (isset($messageError)){
    ?>
    <br>
    <div class="alert alert-danger" role="alert">
        <?php
        print $messageError;
        ?>

    </div>
    <?php
} else if (isset($message)){
    ?>
    <br>
    <div class="alert alert-success" role="alert">
        <?php
        print $message;
        ?>
    </div>
<?php
}
?>

<br>
<div class="container">
    <form action="<?php print $_SERVER['PHP_SELF'] ?>" method="post">
        <input type="hidden" class="form-control" id="pseudo" name="pseudo" aria-describedby="pseudo" value="<?php print $_SESSION['login_user'];?>">
        <div class="col mb-2">
            <label for="oldMotDePasse" class="form-label">Ancien mot de passe</label>
            <input type="password" class="form-control" id="oldMotDePasse" name="oldMotDePasse" aria-describedby="oldMotDePasse">
        </div>
        <div class="col mb-2">
            <label for="newMotDePasse" class="form-label">Nouveau mot de passe</label>
            <input type="password" class="form-control" id="newMotDePasse" name="newMotDePasse" aria-describedby="newMotDePasse">
        </div>
        <div class="col mb-2">
            <label for="ConfirmMotDePasse" class="form-label">Confirmez le nouveau mot de passe</label>
            <input type="password" class="form-control" id="ConfirmMotDePasse" name="ConfirmMotDePasse" aria-describedby="ConfirmMotDePasse">
        </div>
        <button type="submit" class="btn btn-primary" name="modifierMDP" id="modiferMDP">Enregistrer les modifications</button>
    </form>
</div>
<br>
<?php
} else {
    header("Location: index.php?page=page404.php");
    exit();
}
?>