<?php
    $prod = new ProduitBD($cnx);

        if (isset($_GET['id'])){
            extract($_GET,EXTR_OVERWRITE);

            $cat = new CategorieBD($cnx);

            $liste_cat = $cat->getAllCategorie();

            $nbr_cat = count($liste_cat);

            $produit=$prod->getProduitById($id);

            $av = new AvisBD($cnx);

            $verif = $av->getVerificationSiMessagePourProduit($_GET['id']);

            ?>
<br><br>
                <div class="col-auto">
                    <img src="./images/produits/<?php print $produit->photo; ?>" width="200px" height="200px" alt="photo">

                    <?php
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
                    ?>
                    <br><br><h2>Photo</h2>
                <form action="?page=majPhoto.php" method="POST" enctype="multipart/form-data">
                    <div class="input-group">
                        <input type="hidden" id="id_produit" name="id_produit" value="<?php print $id; ?>">
                        <input type="file" class="form-control" id="NewPhoto" name="NewPhoto">
                        <button type="submit" class="btn btn-primary" id="majPhoto" name="majPhoto">Mettre à jour la photo</button>
                    </div><br>
                </form>
                    <br><br>
                    <h2>Informations</h2>
                </div><br>
                <div class="col-auto">
                    <form class="row g-3" action="?page=modification_produit.php&id=<?php print $id; ?>" method="GET">
                        <input type="hidden" id="id_produit" name="id_produit" value="<?php print $id; ?>">
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
                    </form>
                    <br>
                    <button type="submit" class="btn btn-primary" id="editer" name="editer">Mettre à jour</button>
                </div>

            <br><br>

            <h2>Avis clients</h2>
            <?php

            if ($verif!=0){

                $avis = $av->getAvisByIdProduit($_GET['id']);
                $nbr = count($avis);

                for ($i=0;$i<$nbr;$i++){

                    ?>
                    <br>
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
                                    print $avis[$i]->date_message;
                                    ?>
                                </p>
                                <a class="btn btn-danger" type="button" href="index.php?page=suppression_avis.php&id=<?php print $avis[$i]->id_avis;?>&idProd=<?php print $id; ?>">Supprimer</a>
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
                                Aucun Avis
                            </p>
                        </div>
                    </div>
                </div>
                <?php
            }

        } else {
            header("Location: index.php?page=page404.php");
            exit();
        }