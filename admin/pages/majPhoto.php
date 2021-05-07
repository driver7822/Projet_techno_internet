<?php
    extract($_POST,EXTR_OVERWRITE);

    function verify($t){
        $t = trim($t);
        $t = stripslashes($t);
        $t = htmlspecialchars($t);
        return $t;
    }

    $image = verify($_FILES['NewPhoto']['name']);
    $imagePath = '../admin/images/produits/'.basename($image);
    $imageExtension = pathinfo($imagePath, PATHINFO_EXTENSION);
    $imageExtension = strtolower($imageExtension);
    $imageReady = true;

    if ($imageExtension != "jpg" && $imageExtension != "png" && $imageExtension != "jpeg"){
        $_SESSION['imageError'] = "Les fichiers autorisés sont: .jpg, .jpeg, .png";
        $imageReady = false;
    }

    if ($_FILES['NewPhoto']['size']> 5000000 ){
        $_SESSION['imageError'] = "Le fichier dépasse la limite de 5000 Kb";
        $imageReady = false;
    }

    if ($imageReady){
        if(!move_uploaded_file($_FILES['NewPhoto']['tmp_name'], $imagePath)){
            $_SESSION['imageError'] = "il y'a eu une erreur lors de l'upload";
            $imageReady = false;
        } else {
            $produit = new ProduitBD($cnx);

            $prod = $produit->updatePhotoProduit($image,$id_produit);
        }
    }

    ?>
<br><br>
<div class="alert alert-info" role="alert">
    Chargement ...
</div>

<meta http-equiv="refresh": content="0;URL=index.php?page=modification_produit.php&id=<?php print $id_produit;?>">