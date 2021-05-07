<?php
    $cat = new CategorieBD($cnx);

    $liste_cat = $cat->getAllCategorie();

    $nbr_cat = count($liste_cat);

?>
<br>
<h2>Nouveau Produit</h2>
<form class="row g-3" action="?page=ajout_produit_execution.php" method="POST" enctype="multipart/form-data">
    <div class="col-md-4">
        <label for="nom" class="form-label">Nom</label>
        <input type="text" class="form-control" id="nom" name="nom">
    </div>
    <div class="col-md-8">
        <label for="description" class="form-label">Description</label>
        <input type="text" class="form-control" id="description" name="description">
    </div>
    <div class="col-md-2">
        <label for="prix" class="form-label">Prix</label>
        <input type="number" step="0.01" class="form-control" id="prix" name="prix">
    </div>
    <div class="col-md-2">
        <label for="stock" class="form-label">Stock</label>
        <input type="number" class="form-control" id="stock" name="stock">
    </div>
    <div class="col-md-2">
        <label for="choix_categorie" class="form-label">Choix catégorie</label>
        <select class="form-select" name="choix_categorie" id="choix_categorie">
            <option id="choix_categorie" value="">Choix</option>
            <?php
            for ($i=0;$i<$nbr_cat;$i++){
                ?>
                <option id="choix_categorie" value="<?php print $liste_cat[$i]->id_categorie;?>">
                    <?php print $liste_cat[$i]->nom_categorie;?>
                </option>
                <?php
            }
            ?>
        </select>
    </div>
    <div class="col-md-3">
        <label for="photo" class="form-label">Photo</label>
        <input type="file" class="form-control" id="photo" name="photo">
    </div>
    <button type="submit" class="btn btn-primary" id="ajout_produit" name="ajout_produit">Ajouter le produit</button>
</form>
<br><br>
<?php
if (isset($_SESSION['ErreurAjout'])){
    ?>
    <div class="alert alert-danger" role="alert">
        <?php
        print $_SESSION['ErreurAjout'];
        unset($_SESSION['ErreurAjout']);
        ?>
    </div>
    <?php
}

if (isset($_SESSION['imageError'])){
    ?>
    <div class="alert alert-danger" role="alert">
        <?php
        print $_SESSION['imageError'];
        unset($_SESSION['imageError']);
        ?>
    </div>
    <?php
}

if (isset($_SESSION['ajoutSucces'])){
    ?>
    <div class="alert alert-success" role="alert">
        <?php
        print $_SESSION['ajoutSucces'];
        unset($_SESSION['ajoutSucces']);
        ?>
    </div>
    <?php
}
?>


