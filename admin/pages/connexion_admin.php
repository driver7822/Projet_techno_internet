<?php
    if (isset($_POST['submit'])){
        extract($_POST,EXTR_OVERWRITE);

        $ad = new AdminBD($cnx);

        $admin = $ad->getAdmin($login,$password);

        if ($admin){
            $_SESSION['admin']=1;
            $_SESSION['login_admin']=$login;
            $message = "Connexion avec succès";
        } else {
            $message = "Pseudo ou mot de passe incorrecte";
        }
    }

if (isset($message) && !isset($_SESSION['admin'])){
    ?>
    <br>
    <div class="alert alert-danger" role="alert">
        <?php
        print $message;
        ?>

    </div>
    <?php
} else if (isset($message) && isset($_SESSION['admin'])){
    ?>
    <br>
    <div class="alert alert-success" role="alert">
        <?php
        print $message;
        ?>
        <meta http-equiv="refresh": content="1;URL=./index.php?page=accueil_admin.php">
    </div>
<?php
}
?>

<br>
<div class="text-center col-md-6">
    <main class="form-signin">
        <form action="<?php print $_SERVER['PHP_SELF'];?>" method="POST">
            <h1 class="h3 mb-3 fw-normal">Connexion Admin</h1>

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
    </main>
</div>
