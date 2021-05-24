<?php
    if (isset($_GET['montant']) && isset($_SESSION['panier'])){

?>

<div style="margin-top: 10em;">
    <div class="card text-center" style="width: 18rem;">
        <div class="card-body">
            <h4 class="card-title">Montant</h4>
            <?php
            print $_GET['montant'];
            ?> €
            <br><br>

            <a href="https://www.paypal.me/VictorLorfevre/<?php print $_GET['montant'];?>EUR"
               type="button" class="btn btn-warning"
               id="paypal" name="paypal"
               target="popup"
               onclick="window.open('https://www.paypal.me/VictorLorfevre/<?php print $_GET['montant'];?>EUR','popup','width=600,height=600'); return false;">
                <img src="./admin/images/src/PayPal.png" width="150px" height="70px">
            </a>
            <br><br>
            <a href="?page=pdf_facture.php"
               type="button" class="btn btn-primary" id="facture" name="facture"
                target="popup"
                onclick="window.open('?page=pdf_facture.php','popup','width=auto,height=auto'); window.location.replace('?page=accueil.php');">
                Générer une facture</a>
        </div>
    </div>



    </div>
</div>



<?php

    }
    else {
        header("Location: index.php?page=page404.php");
        exit();
    }
