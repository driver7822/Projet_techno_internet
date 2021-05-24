<?php

class ProduitBD extends Produit {

    private $_db; //recevoir la valeur de $cnx lors de la connexion à la BD dans index
    private $_data = array();
    private $_resultset;

    public function __construct($cnx){ // $cnx envoyé depuis la page qui instancie
        $this->_db = $cnx;
    }

    public function getAllProduit(){
        $query = "SELECT * FROM produit ORDER BY id_produit";
        $_resultset = $this->_db->prepare($query);
        $_resultset->execute();

        while ($d = $_resultset->fetch()){
            $_data[] = new Produit($d);
        }

        return $_data;
    }

    public function getAllProduitFiltre($filtre,$motcles){
        $f="";

        if ($filtre=="vide" && $motcles=="vide"){
            $f = "ORDER BY id_produit";
        }

        if ($filtre=="ordreCroissant") {
            $f = "ORDER BY nom ASC";
        }

        if ($filtre=="ordreDecroissant"){
            $f = "ORDER BY nom DESC";
        }

        if ($filtre=="prixCroissant") {
            $f = "ORDER BY prix ASC";
        }

        if ($filtre=="prixDecroissant"){
            $f = "ORDER BY prix DESC";
        }

        $m="";

        if ($motcles!="vide"){
            $m = "WHERE LOWER(nom) LIKE LOWER('%".$motcles."%')";
        }

        $query = "SELECT * FROM produit ".$m.$f;

        $_resultset = $this->_db->prepare($query);
        $_resultset->execute();

        while ($d = $_resultset->fetch()){
            $_data[] = new Produit($d);
        }

        return $_data;
    }

    public function getProduitById($id){
        //$this->_db->beginTransaction();
        $query = "SELECT * FROM produit WHERE id_produit=:id";
        $_resultset = $this->_db->prepare($query);
        $_resultset->bindValue(':id',$id);
        $_resultset->execute();
        $_data = $_resultset->fetch(PDO::FETCH_OBJ);

        return $_data;
        //$this->_db->commit();
    }

    public function getProduitById2($id){
        $query = "SELECT * FROM produit WHERE id_produit=:id";
        $_resultset = $this->_db->prepare($query);
        $_resultset->bindValue(':id',$id);
        $_resultset->execute();

        $data = $_resultset->fetch();
        return $data;
    }

    public function getMessageAvisByProduit($id_prod){
        $this->_db->beginTransaction();
        $query="SELECT * FROM vue_produit_user_avis WHERE id_produit=:id_prod";
        $_resultset = $this->_db->prepare($query);
        $_resultset->bindValue(":id_prod",$id_prod);
        $_resultset->execute();
        $_data = $_resultset->fetch(PDO::FETCH_OBJ);

        return $_data;
        $this->_db->commit();
    }

    public function updateProduit($id_produit,$nom,$desc,$prix,$stock,$id_categorie){
        try {
            $query = "SELECT updateProduit(:id_produit,:nom,:desc,:prix,:stock,:id_categorie) as retour";
            $_resultset = $this->_db->prepare($query);
            $_resultset->bindValue(":id_produit",$id_produit);
            $_resultset->bindValue(":nom",$nom);
            $_resultset->bindValue(":desc",$desc);
            $_resultset->bindValue(":prix",$prix);
            $_resultset->bindValue(":stock",$stock);
            $_resultset->bindValue(":id_categorie",$id_categorie);
            $_resultset->execute();
            $retour = $_resultset->fetchColumn(0);

            return $retour;
        } catch (PDOException $e){
            print "Echec de la requête : ".$e->getMessage();
        }
    }

    public function updatePhotoProduit($photo,$id_produit){
        try{
            $query = "UPDATE produit SET photo=:photo WHERE id_produit = :id";
            $_resultset = $this->_db->prepare($query);
            $_resultset->bindValue(":photo",$photo);
            $_resultset->bindValue(":id",$id_produit);
            $_resultset->execute();
        } catch (PDOException $e){
            print "Echec de la requête : ".$e->getMessage();
        }
    }

    public function deleteProduit($id){
        try {
            $query = "DELETE FROM produit WHERE id_produit=:id";
            $_resultset = $this->_db->prepare($query);
            $_resultset->bindValue(":id",$id);
            $_resultset->execute();
        } catch (PDOException $e){
            print "Echec de la requête : ".$e->getMessage();
        }
    }

    public function ajoutProduit($nom,$description,$prix,$stock,$photo,$id_categorie){
        try {
            $query = "SELECT ajoutproduit(:nom,:description,:prix,:stock,:photo,:id_categorie) as retour";
            $_resultset = $this->_db->prepare($query);
            $_resultset->bindValue(":nom",$nom);
            $_resultset->bindValue(":description",$description);
            $_resultset->bindValue(":prix",$prix);
            $_resultset->bindValue(":stock",$stock);
            $_resultset->bindValue(":photo",$photo);
            $_resultset->bindValue(":id_categorie",$id_categorie);
            $_resultset->execute();
            $retour = $_resultset->fetchColumn(0);
            return $retour;
        } catch (PDOException $e){
            print "Echec de la requête : ".$e->getMessage();
        }
    }

    public function getQuantiterById($id){
        try {
            $query = "SELECT stock FROM produit WHERE id_produit=:id";
            $_resultset = $this->_db->prepare($query);
            $_resultset->bindValue(":id",$id);
            $_resultset->execute();
            $retour = $_resultset->fetchColumn(0);
            return $retour;
        } catch (PDOException $e){
            print "Echec de la requête : ".$e->getMessage();
        }
    }

    public function updateQuantiter($id,$quantiter) {
        try {
            $query = "UPDATE produit SET stock = stock - :quantiter WHERE id_produit=:id";
            $_resultset = $this->_db->prepare($query);
            $_resultset->bindValue(":quantiter",$quantiter);
            $_resultset->bindValue(":id",$id);
            $_resultset->execute();
        } catch (PDOException $e){
            print "Echec de la requête : ".$e->getMessage();
        }
    }
}