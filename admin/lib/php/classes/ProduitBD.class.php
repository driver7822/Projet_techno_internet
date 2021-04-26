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

    public function getProduitById($id){
        $this->_db->beginTransaction();
        $query = "SELECT * FROM produit WHERE id_produit=:id";
        $_resultset = $this->_db->prepare($query);
        $_resultset->bindValue(':id',$id);
        $_resultset->execute();
        $_data = $_resultset->fetch(PDO::FETCH_OBJ);

        return $_data;
        $this->_db->commit();
    }

    public function getProduitByMotCle(){

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


}