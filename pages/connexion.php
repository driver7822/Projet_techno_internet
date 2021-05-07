<?php
    if (isset($_POST['submit'])){
        extract($_POST,EXTR_OVERWRITE);

        $utilisateur = new UtilisateurBD($cnx);

        $user = $utilisateur->getUtilisateur($login,$password);

        if ($user){
            $_SESSION['user']=1;
            $_SESSION['login_user']=$login;
            $message = "Connexion avec succès";
        } else {
            $message = "Pseudo ou mot de passe incorrecte";
        }
    }

?>

<div class="text-center col-md-6" style="padding-top: 10em">
    <?php
    if (isset($message) && !isset($_SESSION['user'])){
    ?>
    <br>
    <div class="alert alert-danger" role="alert">
        <?php
        print $message;
        ?>

    </div>
    <?php
} else if (isset($message) && isset($_SESSION['user'])){
    ?>
    <br>
    <div class="alert alert-success" role="alert">
        <?php
        print $message;
        ?>
        <meta http-equiv="refresh": content="1;URL=./index.php?page=accueil.php">
    </div>
    <?php
    }
    ?>

    <main class="form-signin">
        <form action="<?php print $_SERVER['PHP_SELF'];?>" method="POST">
            <h1 class="h3 mb-3 fw-normal">Connexion</h1>

            <div class="form-floating">
                <input type="text" class="form-control" id="login" name="login" placeholder="Pseudo">
                <label for="login">Pseudo</label>
            </div>
            <br>
            <div class="form-floating">
                <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe">
                <label for="password">Mot de passe</label>
            </div>
            <br>
            <button class="w-100 btn btn-lg btn-success" type="submit" name="submit">Connexion</button>
        </form><br>
        <button type="button" class="btn btn-primary bouton-boutique" data-bs-toggle="modal" data-bs-target="#mot_de_passe_oublie">
            Mot de passe oublié
        </button>
        <a href="index.php?page=creation_compte_user.php" class="btn btn-primary bouton-boutique">Créer un compte</a>
    </main>
</div>

<div class="modal fade" id="mot_de_passe_oublie" tabindex="-1" aria-labelledby="mot_de_passe_oublie" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                Veuillez contacter un administrateur pour récupérer votre mot de passe
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>


<br><br>