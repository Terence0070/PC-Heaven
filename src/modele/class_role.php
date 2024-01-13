<?php
class Role {
 private $select;
 
 public function __construct($db){
 $this->select = $db->prepare("SELECT id, libelle FROM role");
 }

 public function select(){ // Permet de gérer tout ce qui est relatif aux rôles
    $this->select->execute();
    if ($this->select->errorCode()!=0){
    print_r($this->select->errorInfo());
    }
    return $this->select->fetchAll();
    }
}
    
?>