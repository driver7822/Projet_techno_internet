<?php

class Connexion{
    private static $_instance = null;

    public static function getInstance($dsn, $user, $password){
        if(!self::$_instance) {
            //Si l'instance de cnx n'existe pas encore
            try{
                //on essaie d'instancier un obje PDO
                self::$_instance = new PDO($dsn, $user, $password);
                //print "Connecté";
            } catch (PDOException $e){
                print 'Erreur : '.$e->getMessage();
            }
        }
        return self::$_instance;
    }
}