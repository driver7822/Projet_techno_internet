<?php
include ('./lib/php/verifier_connexion.php');

if (isset($_SESSION['admin'])){
    $utilisateur = new UtilisateurBD($cnx);
    $liste = $utilisateur->getAllUtilisateur();
    $nbr = count($liste);

    ?>
    <br>
    <h1>Gestion Utilisateur</h1>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Pseudo</th>
            <th scope="col">Nom</th>
            <th scope="col">Prénom</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php
        for ($i=0;$i<$nbr;$i++){

            ?>
            <tr>
                <th scope="row">
                    <?php print $liste[$i]->id_utilisateur; ?>
                </th>
                <td>
                    <?php print $liste[$i]->pseudo;?>
                </td>
                <td>
                    <?php print $liste[$i]->nom;?>
                </td>
                <td>
                    <?php print $liste[$i]->prenom;?>
                </td>
                <td>
                    <a class="btn btn-danger" name="suppressionUtilisateur" id="suppressionUtilisateur" type="button" href="index.php?page=suppression_utilisateur.php&id=<?php print $liste[$i]->id_utilisateur;?>">Suppression</a>
                </td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
    <p style="text-align: center;font-size: 20px;">La suppression est une action irréversible</p>
    <?php

}
?>


