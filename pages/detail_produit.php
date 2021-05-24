<?php
    $prod = new ProduitBD($cnx);
    if (isset($_GET['id'])) {
        $produit = $prod->getProduitById($_GET['id']);

        $av = new AvisBD($cnx);

        $verif = $av->getVerificationSiMessagePourProduit($_GET['id']);
?>
<br>
<br>

    <div class="row no-gutters">
        <div class="col-auto">
            <img src="./admin/images/produits/<?php print $produit->photo; ?>" class="img-fluid" width="400px" height="400px" alt="<?php print $produit->photo; ?>">
        </div>
        <div class="col-md-6 titre-et-description-detail">
            <h4 class="titre-produit-detail">
                <?php

                print $produit->nom;

                ?>
            </h4>
            <p>
                <?php
                    print $produit->description;
                ?>
            </p>
        </div>
        <div class="col-sm justify-content-center prix-et-boutton-detail">
            <p class="affichage-prix">
                <?php
                    print $produit->prix;
                ?>
                €</p>
            <?php
                $quantite = $produit->stock;

                if (isset($_SESSION['user']) && $quantite>0){
            ?>
            <button class="btn btn-lg btn-primary boutton-panier" id="AjouterAuPanier" name="ajoutAuPanier" value="<?php print $_GET['id']; ?>">
                <span class="ajouterAuPanier"> Ajouter au panier </span>
                <span class="message">Élément ajouté </span>
                <span class="produit-ajouter"><i class="fa fa-shopping-cart"></i></span>
            </button>
            <?php
                }

                if (!isset($_SESSION['user']) && $quantite>0){
            ?>
            <a href="?page=connexion.php" button class="btn btn-lg btn-primary">Ajouter au panier</a>
            <?php
                }

                if ($quantite == 0){
            ?>
                    <p>Malheureusement le produit n'est plus en stock pour le moment</p>
            <?php
                }
            ?>
            <br>
            <br>
            <br>
            <p><b>Quantité en stock : </b></p>
            <p>
                <?php
                    print $produit->stock;
                ?>
            </p>
            <br>
            <p><b>Nombre d'avis : </b></p>
            <p>
                <?php
                print $verif;
                ?>
            </p>

        </div>
    </div>

    <br>
    <br>
    <br>

    <h2>Avis clients</h2>
        <?php
            if (isset($_SESSION['user'])){
                ?>
                <a href="#avis" class="btn btn-primary">Ajouter un commentaire</a>
                    <?php
            }

            if ($verif!=0){

                $avis = $av->getAvisByIdProduit($_GET['id']);
                $nbr = count($avis);

                for ($i=0;$i<$nbr;$i++){

        ?>
        <div class="row no-gutters avis">
                <div class="col-md-2 avis-identification">
                    <p>
                        <?php
                            print $avis[$i]->pseudo;
                        ?>
                    </p>
                    <p>Posté le <br>
                        <?php
                            print date('d/m/Y',strtotime($avis[$i]->date_message));
                        ?>
                    </p>
                </div>
                <div class="col-sm-10 avis-message">
                    <p>
                        <?php
                            print $avis[$i]->message;
                        ?>
                    </p>
                </div>
        </div>
<?php
                }
            } else {
                ?>
                <div class="container avis">
                    <div class="row no-gutters">
                        <div class="col-xl col-md-12">
                            <p style="text-align: center">
                                <br>
                                Aucun Avis, Soyez le premier à commenter
                            </p>
                        </div>
                    </div>
                </div>
                <?php
            }
      if (isset($_SESSION['user'])){
          ?>
        <div class="container avis" id="avis">
            <form>
                <input type="hidden" id="id_produit" name="id_produit" value="<?php print $_GET['id']?>">
                <input type="hidden" id="pseudo" name="pseudo" value="<?php print $_SESSION['login_user']?>">
                <input type="hidden" id="date" name="date" value="<?php print date('Y-m-d')?>">
                <div class="form-group">
                    <textarea class="form-control" id="avisMessage" name="avisMessage" rows="3" required></textarea>
                </div>
            </form>
            <br>
            <button class="btn btn-lg btn-primary" id="AjoutAvis" name="ajoutAvis">Ajouter un Avis</button>
        </div>
<?php
      }
?>

<?php

    } else {
        header("Location: index.php?page=page404.php");
        exit();
    }
