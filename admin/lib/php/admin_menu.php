<nav class="navbar navbar-expand-lg navbar-dark navbar_custom">
    <div class="container-fluid">
        <a class="navbar-brand">
            <img src="./images/logo_dunder_mifflin.jpg" alt="" width="100" height="45" class="d-inline-block align-text-top">
        </a>
        <button class="navbar-toggler ml-auto custom_toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=accueil_admin.php">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=gestion_produit.php">Gestion des produits</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=gestion_categorie.php">Gestion catégorie</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=gestion_utilisateur.php">Gestion utilisateur</a>
                </li>
            </ul>
        </div>
        <?php
            if (!isset($_SESSION['admin'])) {

        ?>
        <div class="collapse navbar-collapse bouton-connexion-user" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=connexion_admin.php">Se connecter</a>
                </li>

        <?php
            }

        if(isset($_SESSION['admin'])){
            ?>
        <div class="collapse navbar-collapse bouton-connexion-user" id="navbarNavDropdown">
            <div class="navbar-nav">
            <li class="nav-item dropdown dropstart">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <?php
                        print $_SESSION['login_admin'];
                    ?>
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <!--<li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li><hr class="dropdown-divider"></li>-->
                    <li><a class="dropdown-item" href="index.php?page=deconnexion.php">Déconnexion</a></li>
                </ul>
            </li>
            </div>
        </div>
            <?php
        }
        ?>


    </div>
</nav>