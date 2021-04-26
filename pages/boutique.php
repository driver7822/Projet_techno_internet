<?php
    $prod = new ProduitBD($cnx);

    $liste = $prod->getAllProduit();

    $nbre = count($liste);
?>

<br>
<div class="test">
    <div class="row no-gutters">
        <div class="col">
            <div class="btn-group" role="group">
                <form action="<?php print $_SERVER['PHP_SELF']; ?>" method="get">
                    <select name="filtre_produit" id="filtre_produit" class="form-select form-select-sm" aria-label=".form-select-sm example">
                        <option selected>Choisir un filtre</option>
                        <option value="ordreCroissant">Ordre Alphabétique croisssant</option>
                        <option value="ordreDecroissant">Ordre Alphabétique décroisssant</option>
                        <option value="prixCroissant">Prix ordre croissant</option>
                        <option value="prixDecroissant">Prix ordre décroissant</option>
                    </select>
                </form>

                <input type="submit" name="submit_id" id="submit_id" value="Chercher">
            </div>
        </div>
        <div class="col">
            <form class="d-flex" action="<?php print $_SERVER['PHP_SELF']; ?>" method="get">
                <input class="form-control me-2" type="text" id="motscles" name="motscles" placeholder="Mots-clés" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Chercher</button>
            </form>
        </div>
    </div>
</div>

<?php


?>

<br>
<br>

<div class="album py-1 bg-light">
    <div class="container">
        <?php
            for($i=0;$i<$nbre;$i++){


        ?>
        <div class="card">
            <div class="row no-gutters">
                <div class="col-auto">
                    <img src="./admin/images/produits/<?php print $liste[$i]->photo; ?>" width="200px" height="200px" class="img-fluid" alt="<?php print $liste[$i]->photo; ?>">
                </div>
                <div class="col titre-et-description">
                    <div class="card-block px-2">
                        <h4 class="card-title titre-produit">
                            <?php
                                print $liste[$i]->nom;
                            ?>
                        </h4>
                        <p class="card-text">
                            <?php
                                print $liste[$i]->description;
                            ?>
                        </p>
                    </div>
                </div>
                <div class="col-sm prix-et-boutton">
                    <p class="affichage-prix">
                        <?php
                            print $liste[$i]->prix;
                        ?> €
                    </p>
                    <a href="index.php?page=detail_produit.php&id=<?php print $liste[$i]->id_produit;?>" class="btn btn-primary bouton-boutique">Détail</a>
                    <a href="#" class="btn btn-primary bouton-boutique">Ajouter au panier</a>
                </div>
            </div>
        </div>
                <br>
        <?php
            }
        ?>
    </div>
</div>