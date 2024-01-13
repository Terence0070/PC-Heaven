<?php
class Recherche {
    private $db;
    private $RechercheOrdinateur;
    private $RechercheLaptop;
    private $RechercheCPU;
    private $RechercheGPU;
    private $RechercheRAM;
    private $RechercheHDD;
    private $RechercheGenerale;

    public function __construct($db) {
        $this->db = $db;

        // Constructeurs pour ordinateurs.html.twig
        $this->RechercheOrdinateur = $db->prepare("SELECT p.id, nomProduit, description, prix, photo, t.libelle as type FROM produit p, type t WHERE p.idType = t.id AND idType = '7' AND nomProduit LIKE :recherche ORDER BY nomProduit");
        $this->RechercheLaptop = $db->prepare("SELECT p.id, nomProduit, description, prix, photo, t.libelle as type FROM produit p, type t WHERE p.idType = t.id AND idType = '8' AND nomProduit LIKE :recherche ORDER BY nomProduit");

        // Constructeurs pour composants.html.twig
        $this->RechercheCPU = $db->prepare("SELECT p.id, nomProduit, description, prix, photo, t.libelle as type FROM produit p, type t WHERE p.idType = t.id AND idType = '3' AND nomProduit LIKE :recherche ORDER BY nomProduit");
        $this->RechercheGPU = $db->prepare("SELECT p.id, nomProduit, description, prix, photo, t.libelle as type FROM produit p, type t WHERE p.idType = t.id AND idType = '2' AND nomProduit LIKE :recherche ORDER BY nomProduit");
        $this->RechercheRAM = $db->prepare("SELECT p.id, nomProduit, description, prix, photo, t.libelle as type FROM produit p, type t WHERE p.idType = t.id AND idType = '5' AND nomProduit LIKE :recherche ORDER BY nomProduit");
        $this->RechercheHDD = $db->prepare("SELECT p.id, nomProduit, description, prix, photo, t.libelle as type FROM produit p, type t WHERE p.idType = t.id AND idType = '4' AND nomProduit LIKE :recherche ORDER BY nomProduit");

        // Constructeur pour la barre de recherche au niveau du menu
        $this->RechercheGenerale = $db->prepare("SELECT p.id, nomProduit, description, prix, photo, t.libelle as type FROM produit p, type t WHERE p.idType = t.id AND nomProduit LIKE :recherche ORDER BY nomProduit");
    }

    public function rechercheOrdinateur($recherche) { // Permet de rechercher précisément un produit dont l'idType correspond aux ordinateurs
        $this->RechercheOrdinateur->execute(array('recherche' => '%' . $recherche . '%'));
        
        if ($this->RechercheOrdinateur->errorCode() != 0) {
            print_r($this->RechercheOrdinateur->errorInfo());
        }
        return $this->RechercheOrdinateur->fetchAll();
    }

    public function rechercheLaptop($recherche) { // Permet de rechercher précisément un produit dont l'idType correspond aux laptops
        $this->RechercheLaptop->execute(array('recherche' => '%' . $recherche . '%'));

        if ($this->RechercheLaptop->errorCode() != 0) {
            print_r($this->RechercheLaptop->errorInfo());
        }
        return $this->RechercheLaptop->fetchAll();
    }

    public function rechercheCPU($recherche) { // Permet de rechercher précisément un produit dont l'idType correspond aux CPU
        $this->RechercheCPU->execute(array('recherche' => '%' . $recherche . '%'));

        if ($this->RechercheCPU->errorCode() != 0) {
            print_r($this->RechercheCPU->errorInfo());
        }
        return $this->RechercheCPU->fetchAll();
    }

    public function rechercheGPU($recherche) { // Permet de rechercher précisément un produit dont l'idType correspond aux GPU
        $this->RechercheGPU->execute(array('recherche' => '%' . $recherche . '%'));

        if ($this->RechercheGPU->errorCode() != 0) {
            print_r($this->RechercheGPU->errorInfo());
        }
        return $this->RechercheGPU->fetchAll();
    }

    public function rechercheRAM($recherche) {  // Permet de rechercher précisément un produit dont l'idType correspond à la RAM
        $this->RechercheRAM->execute(array('recherche' => '%' . $recherche . '%'));

        if ($this->RechercheRAM->errorCode() != 0) {
            print_r($this->RechercheRAM->errorInfo());
        }
        return $this->RechercheRAM->fetchAll();
    }

    public function rechercheHDD($recherche) {  // Permet de rechercher précisément un produit dont l'idType correspond aux HDD
        $this->RechercheHDD->execute(array('recherche' => '%' . $recherche . '%'));

        if ($this->RechercheHDD->errorCode() != 0) {
            print_r($this->RechercheHDD->errorInfo());
        }
        return $this->RechercheHDD->fetchAll();
    }
}
?>

