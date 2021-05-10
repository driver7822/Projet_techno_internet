<?php
    extract($_POST, EXTR_OVERWRITE);

    function verify($t){
        $t = trim($t);
        $t = stripslashes($t);
        $t = htmlspecialchars($t);
        return $t;
    }
    $image = verify($_FILES['photo']['name']);
    $imagePath = '../admin/images/produits/'.basename($image);
    $imageExtension = pathinfo($imagePath, PATHINFO_EXTENSION);
    $imageExtension = strtolower($imageExtension);
    $imageReady = true;

    if ($imageExtension != "jpg" && $imageExtension != "png" && $imageExtension != "jpeg"){
        $_SESSION['imageError'] = "Photo : Les fichiers autorisés sont: .jpg, .jpeg, .png";
        $imageReady = false;
    }

    if ($_FILES['photo']['size']> 5000000 ){
        $_SESSION['imageError'] = "Photo : Le fichier dépasse la limite de 5000 Kb";
        $imageReady = false;
    }

    $readyToSend = true;

    if(empty($nom) || empty($description) || empty($prix) || empty($stock) || empty($choix_categorie)){
        $_SESSION['ErreurAjout'] = "Veuillez remplir tout le formulaire";
        $readyToSend = false;
    }

    if ($readyToSend && $imageReady){
        if (!move_uploaded_file($_FILES['photo']['tmp_name'], $imagePath)){
            $_SESSION['imageError'] = "il y'a eu une erreur lors de l'upload";
            $imageReady = false;
        } else{
            $prod = new ProduitBD($cnx);

            $produit = $prod->ajoutProduit($nom,$description,$prix,$stock,$image,$choix_categorie);

            $_SESSION['ajoutSucces'] = "Ajout avec succès";
        }
    }


    ?>


<br><br>
<div class="alert alert-info" role="alert">
    Chargement ...
</div>

<meta http-equiv="refresh": content="0;URL=index.php?page=ajout_produit.php">