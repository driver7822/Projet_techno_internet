<?php

class CategorieBD extends Categorie {

    private $_db; //recevoir la valeur de $cnx lors de la connexion à la BD dans index
    private $_data = array();
    private $_resultset;

    public function __construct($cnx){ // $cnx envoyé depuis la page qui instancie
        $this->_db = $cnx;
    }

    public function getAllCategorie(){
        $query = "SELECT * FROM categorie ORDER BY id_categorie";
        $_resultset = $this->_db->prepare($query);
        $_resultset->execute();

        while ($d = $_resultset->fetch()){
            $_data[] = new Produit($d);
        }

        return $_data;
    }

    public function updateCategorie($champ,$id,$valeur){
        try {
            $query = "UPDATE categorie SET ".$champ."='".$valeur."' WHERE id_categorie='".$id."'";
            $_resultset = $this->_db->prepare($query);
            $_resultset->execute();

        } catch (PDOException $e){
            print "Echec de la requête : ".$e->getMessage();
        }
    }

    public function DeleteCategorie($id){
        try {
            $query = "DELETE FROM categorie WHERE id_categorie=:id";
            $_resultset = $this->_db->prepare($query);
            $_resultset->bindValue(':id',$id);
            $_resultset->execute();

        } catch (PDOException $e){
            print "Echec de la requête : ".$e->getMessage();
        }
    }

    public function AjoutCategorie($nom_categorie){
        try {
            $query ="INSERT INTO categorie (nom_categorie) VALUES ('".$nom_categorie."');";
            $_resultset = $this->_db->prepare($query);
            $_resultset->execute();

        } catch (PDOException $e){
            print "Echec de la requête : ".$e->getMessage();
        }
    }
}
