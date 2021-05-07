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
            <img src="./admin/images/produits/<?php print $produit->photo; ?>" width="400px" height="400px" alt="<?php print $produit->photo; ?>">
        </div>
        <div class="col-6 titre-et-description-detail">
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
            <a href="#" class="btn btn-primary">Ajouter au panier</a>
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
        <div class="container avis">
            <div class="row no-gutters">
                <div class="col- col-md-2 avis-identification">
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
                <div class="col-xl col-md-10 avis-message">
                    <p>
                        <?php
                            print $avis[$i]->message;
                        ?>
                    </p>
                </div>
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


    } else {
        header("Location: index.php?page=page404.php");
        exit();
    }
