<?php

class UtilisateurBD extends Utilisateur {

    private $_db; //recevoir la valeur de $cnx lors de la connexion à la BD dans index
    private $_data = array();
    private $_resultset;

    public function __construct($cnx){ // $cnx envoyé depuis la page qui instancie
        $this->_db = $cnx;
    }

    public function getUtilisateur($login,$password){
        try {
            $query = "SELECT is_utilisateur(:login,:password) as retour";
            $_resultset = $this->_db->prepare($query);
            $_resultset->bindValue(':login',$login);
            $_resultset->bindValue(':password',md5($password));
            $_resultset->execute();

            $retour = $_resultset->fetchColumn(0);

            return $retour;
        } catch (PDOException $e){
            print "Erreur de la requête : ".$e->getMessage();
        }
    }

    public function getAllUtilisateur() {
        try {
            $query = "SELECT * FROM utilisateur ORDER BY id_utilisateur";
            $_resultset = $this->_db->prepare($query);
            $_resultset->execute();

            while ($d = $_resultset->fetch()){
                $_data[] = new Utilisateur($d);
            }

            return $_data;
        } catch (PDOException $e){
            print "Erreur de la requête : ".$e->getMessage();
        }
    }

    public function getUtilisateurByPseudo($pseudo){
        try {
            $query="SELECT * FROM utilisateur WHERE pseudo=:pseudo";
            $_resultset = $this->_db->prepare($query);
            $_resultset->bindValue(":pseudo",$pseudo);
            $_resultset->execute();

            $data = $_resultset->fetch(PDO::FETCH_OBJ);
            return $data;
        } catch (PDOException $e){
            print "Erreur de la requête : ".$e->getMessage();
        }
    }

    public function AjoutUtilisateur($pseudo,$mdp,$nom,$prenom,$email,$date){
        try {
            $query = "SELECT ajoututilisateur(:pseudo,:nom,:prenom,:date,:email,:mdp) as retour";
            $_resultset = $this->_db->prepare($query);
            $_resultset->bindValue(":pseudo",$pseudo);
            $_resultset->bindValue(":nom",$nom);
            $_resultset->bindValue(":prenom",$prenom);
            $_resultset->bindValue(":date",$date);
            $_resultset->bindValue(":email",$email);
            $_resultset->bindValue(":mdp",$mdp);
            $_resultset->execute();
            $retour = $_resultset->fetchColumn(0);

            return $retour;
        }catch (PDOException $e){
            print "Echec de la requête : ".$e->getMessage();
        }
    }

    public function DeleteUtilisateur($id){
        try {
            $query = "DELETE FROM utilisateur WHERE id_utilisateur=:id";
            $_resultset = $this->_db->prepare($query);
            $_resultset->bindValue(':id',$id);
            $_resultset->execute();

        } catch (PDOException $e){
            print "Echec de la requête : ".$e->getMessage();
        }
    }

    public function UpdateUtilisateur($id_utilisateur,$pseudo,$prenom,$nom,$email,$date_de_naissance){
        try {
            $query = "SELECT updateutilisateur(:id,:pseudo,:prenom,:nom,:email,:date) as retour";
            $_resultset = $this->_db->prepare($query);
            $_resultset->bindValue(":id",$id_utilisateur);
            $_resultset->bindValue(":pseudo",$pseudo);
            $_resultset->bindValue(":prenom",$prenom);
            $_resultset->bindValue(":nom",$nom);
            $_resultset->bindValue(":email",$email);
            $_resultset->bindValue(":date",$date_de_naissance);
            $_resultset->execute();
            $retour = $_resultset->fetchColumn(0);

            if ($retour==1){
                session_start();
                unset($_SESSION['login_user']);
                $_SESSION['login_user']=$pseudo;
            }

            return $retour;
        } catch (PDOException $e){
            print "Echec de la requête : ".$e->getMessage();
        }
    }

    public function ModifierMDP($pseudo,$oldMDP,$newMDP){
        try{
            $query="SELECT modifiermdputilisateur(:pseudo,:oldMDP,:newMDP) as retour";
            $_resultset = $this->_db->prepare($query);
            $_resultset->bindValue(':pseudo',$pseudo);
            $_resultset->bindValue(':oldMDP',md5($oldMDP));
            $_resultset->bindValue(':newMDP',md5($newMDP));
            $_resultset->execute();

            $retour = $_resultset->fetchColumn(0);

            return $retour;

        } catch (PDOException $e) {
            print "Erreur : ".$e->getMessage();
        }
    }

}
