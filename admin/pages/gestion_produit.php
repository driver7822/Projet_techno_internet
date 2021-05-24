<?php
    include ('./lib/php/verifier_connexion.php');

    if (isset($_SESSION['admin'])){
        $prod = new ProduitBD($cnx);
        $liste = $prod->getAllProduit();
        $nbr = count($liste);

        ?>
        <br>
        <a class="btn btn-primary" type="button" href="index.php?page=ajout_produit.php">Ajouter un nouveau produit</a>
        <br><br>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Description</th>
                    <th scope="col">Stock</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
            <?php
                for($i=0;$i<$nbr;$i++){

            ?>
                    <tr>
                        <th scope="row">
                            <?php print $liste[$i]->id_produit; ?>
                        </th>
                        <td>
                            <?php print $liste[$i]->nom; ?>
                        </td>
                        <td>
                            <?php print $liste[$i]->description; ?>
                        </td>
                        <td>
                            <?php print $liste[$i]->stock; ?>
                        </td>
                        <td>
                            <a class="btn btn-primary" type="button" href="index.php?page=modification_produit.php&id=<?php print $liste[$i]->id_produit;?>"><i class="far fa-edit"></i></a>
                        </td>
                        <td>
                            <a class="btn btn-danger" type="button" href="index.php?page=suppression_produit.php&id=<?php print $liste[$i]->id_produit;?>"><i class="far fa-trash-alt"></i></a>
                        </td>
                    </tr>
                    <?php
                }
                    ?>
            </tbody>
        </table>

<?php

    }