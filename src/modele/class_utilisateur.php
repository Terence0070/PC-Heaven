<?php
class Utilisateur {
   private $db;
   private $insert;
   private $existe;
   private $connect;
   private $select;
   private $selectByEmail;
   private $selectLimit;
   private $selectCount;
   private $selectById;
   private $update;
   private $updateMdp;
   private $delete;


   public function __construct($db) {
      $this->db = $db;
      $this->insert = $db->prepare("INSERT INTO utilisateur(email, mdp, nom, prenom, idRole) VALUES (:email, :mdp, :nom, :prenom, :role)");
      $this->existe = $db->prepare("SELECT COUNT(*) AS count FROM utilisateur WHERE email = :email");
      $this->connect = $db->prepare("SELECT email, idRole, mdp FROM utilisateur WHERE email=:email");
      $this->select = $db->prepare("SELECT u.id, email, idRole, nom, prenom, r.libelle AS libellerole FROM utilisateur u, role r WHERE u.idRole = r.id ORDER BY nom");
      $this->selectByEmail = $db->prepare("SELECT u.id, email, idRole, nom, prenom, r.libelle AS libellerole FROM utilisateur u, role r WHERE u.idRole = r.id AND email = :email ORDER BY nom");
      $this->selectLimit = $db->prepare("SELECT u.id, email, idRole, nom, prenom, r.libelle AS libellerole FROM utilisateur u, role r WHERE u.idRole = r.id ORDER BY id LIMIT :inf, :limite");
      $this->selectCount =$db->prepare("SELECT count(*) AS nb FROM utilisateur");
      $this->selectById = $db->prepare("SELECT id, email, nom, prenom, idRole FROM utilisateur WHERE id=:id");
      $this->update = $db->prepare("UPDATE utilisateur SET email=:email, nom=:nom, prenom=:prenom, idRole=:idRole WHERE id=:id");
      $this->updateMdp = $db->prepare("UPDATE utilisateur SET mdp=:mdp WHERE id=:id");
      $this->delete = $db->prepare("DELETE from utilisateur where id=:id");
    }

   public function insert($email, $mdp, $role, $nom, $prenom) {  // Permet d'insérer un nouvel utilisateur dans la base de données
      $r = true;
      if ($this->existe($email)) { // Si l'utilisateur existe déjà, on le rajoute pas
         return false;
      }

      $this->insert->execute(array(
         ':email' => $email,
         ':mdp' => $mdp,
         ':role' => $role,
         ':nom' => $nom,
         ':prenom' => $prenom
        ));

      if ($this->insert->errorCode() != 0) {
         print_r($this->insert->errorInfo());
         $r = false;
      }

      return $r;
    }

   public function existe($email) {  // Permet de procéder à la vérification d'un email déjà présent dans la base de données
      $this->existe->execute(array(':email' => $email));
      if ($this->existe->errorCode() != 0) {
         print_r($this->existe->errorInfo());
      }
      $result = $this->existe->fetch(PDO::FETCH_ASSOC);
      return $result['count'] > 0;
   }

   public function connect($email){ // Permet de se connecter au site PC HEAVEN
      $unUtilisateur = $this->connect->execute(array(':email'=>$email));
      if ($this->connect->errorCode()!=0){
         print_r($this->connect->errorInfo());
      }
      return $this->connect->fetch();
   }

   public function select(){ // Permet de sélectionner et afficher les utilisateurs
      $this->select->execute();
       if ($this->select->errorCode()!=0){
         print_r($this->select->errorInfo());
       }
    return $this->select->fetchAll();
   }

   public function selectByEmail($email) { // Permet de sélectionner et afficher les utilisateurs selon leur email
      $this->selectByEmail->execute(array(':email' => $email));

      if ($this->selectByEmail->errorCode() != 0) {
         print_r($this->selectByEmail->errorInfo());
      }

      return $this->selectByEmail->fetch(PDO::FETCH_ASSOC);
   }


   public function selectLimit($inf, $limite){ // Permet de sélectionner et afficher les utilisateurs avec une certaine limite (pratique pour la pagination)
      $this->selectLimit->bindParam(':inf', $inf, PDO::PARAM_INT);
      $this->selectLimit->bindParam(':limite', $limite, PDO::PARAM_INT);

      $this->selectLimit->execute();
      if ($this->selectLimit->errorCode()!=0){
         print_r($this->selectLimit->errorInfo());
      }
      return $this->selectLimit->fetchAll();
   }

   public function selectCount(){  // Permet de compter le nombre d'utilisateurs
      $this->selectCount->execute();
      if ($this->selectCount->errorCode()!=0){
         print_r($this->selectCount->errorInfo());
      }
      return $this->selectCount->fetch();
   }

   public function selectById($id){  // Permet d'afficher l'utilisateur selon son id
      $this->selectById->execute(array(':id'=>$id)); 
      if ($this->selectById->errorCode()!=0){
         print_r($this->selectById->errorInfo());
      }
      return $this->selectById->fetch();
   }

   public function update($email, $id, $idRole, $nom, $prenom){  // Permet de mettre à jour les informations d'un utilisateur
      $r = true;
      $this->update->execute(array(':email'=>$email, ':id'=>$id, ':idRole'=>$idRole, ':nom'=>$nom, ':prenom'=>$prenom));
      if ($this->update->errorCode()!=0){ print_r($this->update->errorInfo());
         $r=false;
      }
      return $r;
   }

   public function updateMdp($mdp, $id) {  // Permet de mettre à jour le mot de passe de l'utilisateur
      $r = true;
      $this->updateMdp->execute(array(':mdp' => $mdp, ':id' => $id));
      if ($this->updateMdp->errorCode() != 0) {
          print_r($this->updateMdp->errorInfo());
          $r = false;
      }
      return $r;
  }

  public function delete($id){  // Permet de supprimer un utilisateur de la base de données (donc du site)
      $r = true;
      $this->delete->execute(array(':id'=>$id));
      if ($this->delete->errorCode()!=0){
         print_r($this->delete->errorInfo());
         $r=false;
      }
      return $r;
  }
}
    
?>
