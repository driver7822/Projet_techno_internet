<br>
<div class="text-center col-md-6">
    <main class="form-signin">
        <form>
            <h1 class="h3 mb-3 fw-normal">Connexion</h1>

            <div class="form-floating">
                <input type="text" class="form-control" id="floatingInput" placeholder="Pseudo">
                <label for="floatingInput">Pseudo</label>
            </div>
            <br>
            <div class="form-floating">
                <input type="password" class="form-control" id="floatingPassword" placeholder="Mot de passe">
                <label for="floatingPassword">Mot de passe</label>
            </div>
            <br>
            <button class="w-100 btn btn-lg btn-success" type="submit">Connexion</button>
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