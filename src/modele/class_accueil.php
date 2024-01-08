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

    public function OrdinateurRecent() {
        $this->OrdinateurRecent->execute();
        if ($this->OrdinateurRecent->errorCode()!=0){
            print_r($this->OrdinateurRecent->errorInfo());
        }
        return $this->OrdinateurRecent->fetchAll();
    }

    public function ComposantsRecent() {
        $this->ComposantsRecent->execute();
        if ($this->ComposantsRecent->errorCode()!=0){
            print_r($this->ComposantsRecent->errorInfo());
        }
        return $this->ComposantsRecent->fetchAll();
    }
}
?>

