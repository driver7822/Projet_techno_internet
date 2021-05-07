<?php

class AvisBD extends Avis {

    private $_db; //recevoir la valeur de $cnx lors de la connexion à la BD dans index
    private $_data = array();
    private $_resultset;

    public function __construct($cnx)
    { // $cnx envoyé depuis la page qui instancie
        $this->_db = $cnx;
    }

    public function getAvisByIdProduit($id_prod){
        try {
            $query = "SELECT * FROM vue_avis_user WHERE id_produit=:id";
            $_resultset = $this->_db->prepare($query);
            $_resultset->bindValue(':id',$id_prod);
            $_resultset->execute();

            while ($d = $_resultset->fetch()){
                $_data[] = new Avis($d);
            }

            return $_data;
        } catch (PDOException $e){
            print "Echec de la requête : ".$e->getMessage();
        }
    }

    public function getVerificationSiMessagePourProduit($id_prod){
        try {
            $query = "SELECT * FROM avis WHERE id_produit=:id";
            $_resultset = $this->_db->prepare($query);
            $_resultset->bindValue(':id',$id_prod);
            $_resultset->execute();

            $verif = count($_resultset->fetchAll(PDO::FETCH_ASSOC));

            return $verif;
        } catch (PDOException $e){
            print "Echec de la requête : ".$e->getMessage();
        }
    }

    public function DeleteAvisById($id){
        try {
            $query = "DELETE FROM avis WHERE id_avis=:id";
            $_resultset = $this->_db->prepare($query);
            $_resultset->bindValue(':id',$id);
            $_resultset->execute();

        } catch (PDOException $e){
            print "Echec de la requête : ".$e->getMessage();
        }
    }

    public function AjoutAvis($pseudo,$date,$message,$id_produit){
        try {
            $query = "SELECT ajoutavis(:pseudo,:date,:message,:id_produit) as retour";
            $_resultset = $this->_db->prepare($query);
            $_resultset->bindValue(":pseudo",$pseudo);
            $_resultset->bindValue(":date",$date);
            $_resultset->bindValue(":message",$message);
            $_resultset->bindValue(":id_produit",$id_produit);
            $_resultset->execute();
            $retour = $_resultset->fetchColumn(0);
            return $retour;
        } catch (PDOException $e){
            print "Echec de la requête : ".$e->getMessage();
        }
    }
}