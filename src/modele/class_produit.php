<?php
use Spipu\Html2Pdf\Html2Pdf;
class Produit {
   private $db;
   private $insert;
   private $select;
   private $selectIn;
   private $selectLimit;
   private $selectCount;
   private $selectById;
   private $update;
   private $delete;
   private $recherche;

   public function __construct($db){
      $this->db = $db;
      $this->insert = $db->prepare("INSERT INTO produit(nomProduit, description, prix, idType, photo) VALUES (:nomProduit, :description, :prix, :idType, :photo)");
      $this->select = $db->prepare("SELECT id, nomProduit, description, prix, idType, photo FROM produit ORDER BY nomProduit");
      $this->selectIn = $db->prepare("SELECT id, nomProduit, description, prix, photo, idType FROM produit WHERE FIND_IN_SET(id, :ids)");
      $this->selectLimit = $db->prepare("SELECT id, nomProduit, description, prix, idType, photo FROM produit ORDER BY nomProduit LIMIT :inf, :limite");
      $this->selectCount =$db->prepare("SELECT count(*) AS nb FROM produit");
      $this->selectById = $db->prepare("SELECT id, nomProduit, description, prix, idType, photo FROM produit WHERE id=:id");
      $this->update = $db->prepare("UPDATE produit SET nomProduit=:nomProduit, description=:description, prix=:prix, idType=:idType WHERE id=:id");
      $this->delete = $db->prepare("DELETE FROM produit WHERE id=:id");
      $this->recherche = $db->prepare("SELECT p.id, nomProduit, description, prix, photo, t.libelle as type FROM produit p, type t WHERE p.idType = t.id AND (nomProduit LIKE :recherche OR description LIKE :recherche) ORDER BY nomProduit");
   }
 
   public function insert($nomProduit, $description, $prix, $idType, $photo){ // Permet de mettre les informations du produit qu'on va insérer (nom, photo, etc.)
      $r = true;
  
      $this->insert->execute(array(':nomProduit'=>$nomProduit, ':description'=>$description, ':prix'=>$prix, ':idType'=>$idType, ':photo'=>$photo));
      if ($this->insert->errorCode()!=0){ 
          print_r($this->insert->errorInfo());
          $r=false;
      }
      return $r;
   }

   public function select(){ // Permet de choisir et d'afficher les produits
      $this->select->execute();
      if ($this->select->errorCode()!=0){
         print_r($this->select->errorInfo());
      }
      return $this->select->fetchAll();
   }

   public function selectIn($ids){ // Affiche les informations détaillées d'un produit selon son id
      $implose = implode(',', $ids);
      $this->selectIn->bindParam(':ids', $implose);
      $this->selectIn->execute();
      if ($this->selectIn->errorCode()!=0){
         print_r($this->selectIn->errorInfo());
      }
      return $this->selectIn->fetchAll();
   }

   public function selectLimit($inf, $limite){ // Permet de choisir un certain nombre de produits à afficher
      $this->selectLimit->bindParam(':inf', $inf, PDO::PARAM_INT);
      $this->selectLimit->bindParam(':limite', $limite, PDO::PARAM_INT);

      $this->selectLimit->execute();
      if ($this->selectLimit->errorCode()!=0){
         print_r($this->selectLimit->errorInfo());
      }
      return $this->selectLimit->fetchAll();
   }

   public function selectCount(){ // Permet de compter le nombre de produits total
      $this->selectCount->execute();
      if ($this->selectCount->errorCode()!=0){
         print_r($this->selectCount->errorInfo());
      }
      return $this->selectCount->fetch();
   }

   public function selectById($id){ // Permet de choisir un produit selon son id
      $this->selectById->execute(array(':id'=>$id)); 
      if ($this->selectById->errorCode()!=0){
         print_r($this->selectById->errorInfo());
      }
      return $this->selectById->fetch();
   }

   public function update($nomProduit, $description, $prix, $idType, $id){ // Permet de mettre un jour un produit (par contre la photo ne fonctionne pas)
      $r = true;
      $this->update->execute(array(':nomProduit'=>$nomProduit, ':description'=>$description, ':prix'=>$prix, ':idType'=>$idType, ':id'=>$id));
      if ($this->update->errorCode()!=0){ 
         print_r($this->update->errorInfo());
         $r=false;
      }
      return $r;
   }

   public function delete($id){ // Permet de supprimer un produit
      $r = true;
      $this->delete->execute(array(':id'=>$id));
      if ($this->delete->errorCode()!=0){
         print_r($this->delete->errorInfo());
         $r=false;
      }
      return $r;
   }

   public function recherche($recherche){  // Permet de rechercher un produit selon son nom
      $this->recherche->execute(array('recherche' => '%' . $recherche . '%'));
      if ($this->recherche->errorCode() != 0){
         print_r($this->recherche->errorInfo());
      }
      return $this->recherche->fetchAll();
   }
}
    
?>