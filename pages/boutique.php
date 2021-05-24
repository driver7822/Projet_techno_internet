<?php
$liste=array();

if (isset($_SESSION['prod'])) {
    $liste = unserialize($_SESSION['prod']);
    unset($_SESSION['prod']);
}


?>
<br>
<div>
    <form id="filtres" name="filtres" action="" method="post">
    <div class="row ">
        <div class="col-lg">
            <div class="btn-group" role="group">
                    <select name="filtre_produit" id="filtre_produit" class="form-select form-select-sm" aria-label=".form-select-sm example">
                        <option selected value="vide">Choisir un filtre</option>
                        <option value="ordreCroissant">Ordre : Alphabétique croissant</option>
                        <option value="ordreDecroissant">Ordre : Alphabétique décroissant</option>
                        <option value="prixCroissant">Prix : ordre croissant</option>
                        <option value="prixDecroissant">Prix : ordre décroissant</option>
                    </select>
            </div>
        </div>
        <div class="col">
                <input class="form-control me-2" type="text" id="motscles" name="motscles" placeholder="Mots-clés">
            <input type="submit" name="submit_filtres" id="submit_filtres" value="Chercher">
        </div>

    </div>
    </form>
</div>

<br>
<br>

<div class="album py-1 bg-light">
    <div class="container" id="toutlesproduits" name="toutlesproduits">
        <?php
        if ($liste){
            $nbre = count($liste);

            for($i=0;$i<$nbre;$i++){

        ?>
        <a class="boutique" href="index.php?page=detail_produit.php&id=<?php print $liste[$i]->id_produit;?>">
        <div class="card card-boutique">
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
                </div>
            </div>
        </div></a><br>
            <?php
            }
        } else {
            ?>
            <div class="card aucun-produit-selection" style="padding: 2em;text-align: center;font-size: 2em;">
                Aucun produit ne correspond à votre sélection
            </div>
        <?php
        }
            ?>
    </div>
</div>