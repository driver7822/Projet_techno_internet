<?php

class Panier{

    public function AjouterPanier($id_produit,$stock){
        $ok=0;
        if (isset($_SESSION['user'])) {
            if (!isset($_SESSION['panier'])){
                $_SESSION['panier']=array();
            }

            for ($i = 0;$i<sizeof($_SESSION['panier']);$i++){
                if ($_SESSION['panier'][$i]['produit'] == $id_produit){
                    $ok=1;

                    if ($_SESSION['panier'][$i]['quantiter']<$stock) {
                        $_SESSION['panier'][$i]['quantiter']+=1;
                    }
                    break;
                }
            }

            if ($ok == 0){
                $prod = array("produit"=>$id_produit,"quantiter"=>1);

                array_push($_SESSION['panier'],$prod);
            }
        }
    }

    public function getElement($id){
        if ($id < sizeof($_SESSION['panier'])){
            $prod =  $_SESSION['panier'][$id]['produit'];
            $quantiter = $_SESSION['panier'][$id]['quantiter'];

            return array($prod,$quantiter);
        }
    }

    public function TaillePanier(){
        return sizeof($_SESSION['panier']);
    }

    public function ChangerQuantiter($id,$quantiter,$stock){
        $produit = new ProduitBD($cnx);
        for($i = 0;$i<sizeof($_SESSION['panier']);$i++) {
            if ($_SESSION['panier'][$i]['produit'] == $id){
                if ($quantiter<=0){
                    $_SESSION['panier'][$i]['quantiter']=1;
                } else {

                    if ($quantiter>$stock){
                        $quantiter=$stock;
                    }

                    $_SESSION['panier'][$i]['quantiter']=(int)$quantiter;
                }

                break;
            }
        }
    }

    public function ViderPanier(){
        unset($_SESSION['panier']);
    }




}