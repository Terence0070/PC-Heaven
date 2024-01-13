<?php
class Accueil {
    private $db;
    private $OrdinateurRecent;
    private $ComposantsRecent;

    public function __construct($db) {
       $this->db = $db;
       $this->OrdinateurRecent = $db->prepare("SELECT p.id, nomProduit, description, prix, photo, t.libelle as type FROM produit p, type t WHERE p.idType = t.id AND idType IN ('7', '8') ORDER BY p.id DESC LIMIT 6;");
       $this->ComposantsRecent = $db->prepare("SELECT p.id, nomProduit, description, prix, photo, t.libelle as type FROM produit p, type t WHERE p.idType = t.id AND idType IN ('2', '3', '4', '5', '9', '10', '11', '12') ORDER BY p.id DESC LIMIT 6;
       ");
    }

    public function OrdinateurRecent() { // Affiche tous les ordinateurs récents dans la page d'accueil (limité à 6).
        $this->OrdinateurRecent->execute();
        if ($this->OrdinateurRecent->errorCode()!=0){
            print_r($this->OrdinateurRecent->errorInfo());
        }
        return $this->OrdinateurRecent->fetchAll();
    }

    public function ComposantsRecent() { // Affiche tous les composants récents dans la page d'accueil (limité à 6).
        $this->ComposantsRecent->execute();
        if ($this->ComposantsRecent->errorCode()!=0){
            print_r($this->ComposantsRecent->errorInfo());
        }
        return $this->ComposantsRecent->fetchAll();
    }
}
?>

