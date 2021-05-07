<br>


<?php
if (isset($_SESSION['ErreurCreationUtili'])){
    ?>
    <div class="alert alert-danger" role="alert">
        <?php
        print $_SESSION['ErreurCreationUtili'];
        unset($_SESSION['ErreurCreationUtili']);
        ?>
    </div>
    <?php
}
?>
<br>


<div class="container col-md-8">
    <form class="creation-compte" action="?page=creation_compte_user_execution.php" method="POST">
        <h2>S'enregistrer</h2>
        <br>
        <div class="mb-3">
            <label for="pseudo" class="form-label">Pseudo</label>
            <input type="text" class="form-control" id="pseudo" name="pseudo" aria-describedby="pseudo">
        </div>
        <div class="mb-3">
            <label for="mdp" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="mdp" name="mdp" aria-describedby="mdp">
        </div>
        <div class="row no-gutters">
            <div class="col mb-3">
                <label for="prenom" class="form-label">Prénom</label>
                <input type="text" class="form-control" id="prenom" name="prenom" aria-describedby="prenom">
            </div>
            <div class="col mb-3">
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
        <div class="mb-3">
            <br>
            <br>
            <button class="w-100 btn btn-lg btn-success" type="submit" id="creerCompteUser">Créer un compte</button>
        </div>
    </form>
</div>