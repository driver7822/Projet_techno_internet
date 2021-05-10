<nav class="navbar navbar-expand-lg navbar-dark navbar_custom">
    <div class="container-fluid">
        <a class="navbar-brand">
            <img src="admin/images/logo_dunder_mifflin.jpg" alt="logo dunder mifflin" width="100" height="45" class="d-inline-block align-text-top">
        </a>
        <button class="navbar-toggler ml-auto custom_toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=accueil.php">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=boutique.php">Boutique</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=a_propos_de_nous.php">À propos de nous</a>
                </li>
            </ul>
        </div>
        <?php
            if (!isset($_SESSION['user'])){

        ?>
        <div class="collapse navbar-collapse bouton-connexion-user" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=connexion.php">Se connecter</a>
                </li>
            </ul>
        </div>
        <?php
            }
            if (isset($_SESSION['user'])){
            ?>
                <div class="collapse navbar-collapse bouton-connexion-user" id="navbarNavDropdown">
                    <div class="navbar-nav">
                        <li class="nav-item dropdown dropstart">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <?php
                                print $_SESSION['login_user'];
                                ?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="?page=modification_utilisateur.php">Mon compte</a></li>
                                <li><a class="dropdown-item" href="?page=panier.php">Mon panier</a></li>
                                <li><hr class="dropdown-divider"></li>
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