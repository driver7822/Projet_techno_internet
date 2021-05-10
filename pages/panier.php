<?php

/*unset($_SESSION['panier']);

$panier->AjouterPanier(1);
$panier->AjouterPanier(12);*/

$produit = new ProduitBD($cnx);

if (isset($_SESSION['user'])){
    ?>
    <br><br>
    <div class="container">
        <h3>Mon panier : </h3><br>
        <table class="table">
            <thead>
                <th class="col-1" scope="col"></th>
                <th scope="col">Nom</th>
                <th class="col-2" scope="col">Quantité</th>
                <th class="col-2" scope="col">Prix</th>
                <th class="col-2" scope="col">Prix total</th>
            </thead>
            <tbody>
            <?php
            if (isset($_SESSION['panier'])){
                $somme = 0;
                $quantitier = 0;

                for ($i=0;$i<$panier->TaillePanier();$i++) {
                    $test = $panier->getElement($i);

                    $prod = $produit->getProduitById($test[0]);

                    ?>
                <tr>
                    <td><img src="./admin/images/produits/<?php print $prod->photo ;?>" height="125px" width="125px"></td>
                    <td><?php print $prod->nom; ?></td>
                    <td><span contenteditable="true" class="form-control w-50" name="idProduit" id="<?php print $prod->id_produit; ?>">
                            <?php print $test[1] ;?>
                    </td>
                    <td><?php print $prod->prix;?> €</td>
                    <td><?php
                        $prixQuantiter = $prod->prix*$test[1];
                        print number_format((float)$prixQuantiter, 2,'.', '');
                    ?> €</td>
                </tr>
                    <?php
                    $quantitier = $quantitier+$test[1];
                    $prix = $test[1]*$prod->prix;
                    $somme=$somme+$prix;
                    $prod = null;
                }

            ?></tbody>
            <thead>
            <tr>
                <th colspan="3"></th>
                <th>Quantiter total :</th>
                <th scope="col">Total commande HTVA :</th>
            </tr>
            <tr>
                <td colspan="3"></td>
                <td><?php print $quantitier ?></td>
                <td><?php print number_format((float)$somme, 2,'.', ''); ?> €</td>
            </tr>
            <tr>
                <th colspan="4"></th>
                <th>Total commande TVAC :</th>
            </tr>
            <tr>
                <td colspan="4"></td>
                <td><?php $sommeTVAC = $somme*1.21;
                    print number_format((float)$sommeTVAC, 2,'.', '');
                    ?> €</td>
            </tr>
            </thead>
                <?php
            } else {
                ?>
                    <td colspan="5" style="text-align: center"><h3>Votre panier est actuellement vide</h3></td>
                <?php
            }
                ?>
        </table>
    </div>
    <?php
    if (isset($_SESSION['panier'])){
    ?>
    <div class="d-flex flex-row-reverse">
        <div class="class="mb-auto p-2"">
            <button class="btn btn-primary" id="ViderPanier" name="ViderPanier">Vider le panier</button>
            <button class="btn btn-success" id="Payer" name="Payer">Payer</button>
        </div>
    </div>
    <?php
    }
    ?>


    <?php
}