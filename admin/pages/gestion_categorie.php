<?php
include ('./lib/php/verifier_connexion.php');

if (isset($_SESSION['admin'])){
    $cat = new CategorieBD($cnx);
    $liste = $cat->getAllCategorie();
    $nbr = count($liste);

    ?>
    <br>
    <h1>Gestion Catégorie</h1>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nom</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php
            for ($i=0;$i<$nbr;$i++){

        ?>
                <tr>
                    <th scope="row">
                        <?php print $liste[$i]->id_categorie; ?>
                    </th>
                    <td>
                        <span contenteditable="true" name="nom_categorie" id="<?php print $liste[$i]->id_categorie;?>">
                            <?php print $liste[$i]->nom_categorie;?>
                        </span>
                    </td>
                    <td>
                        <a class="btn btn-danger" type="button" href="index.php?page=suppression_categorie.php&id=<?php print $liste[$i]->id_categorie;?>"><i class="far fa-trash-alt"></i></a>
                    </td>
                </tr>
                <?php
            }
                ?>
        </tbody>
    </table>
    <br><br>
    <form action="<?php print $_SERVER['PHP_SELF'];?>" method="post">
        <div class="mb-3 w-25">
            <label for="nom_categorie" class="form-label">Nom de catégorie</label>
            <input type="text" class="form-control" id="nom_categorie" name="nom_categorie">
        </div>
        <button type="submit" class="btn btn-primary" id="ajouter_categorie" name="ajouter_categorie">Ajouter</button>
    </form>
    <?php

}
?>


