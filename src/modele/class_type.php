<?php
class Type {
    private $db;
    private $select;
    private $insert;
    private $selectById;
    private $update;
    private $delete;

    public function __construct($db){
        $this->db = $db;
        $this->insert = $db->prepare("INSERT INTO type(libelle) VALUES (:libelle)");
        $this->select = $db->prepare("SELECT id, libelle FROM type ORDER BY libelle ASC");
        $this->selectById = $db->prepare("SELECT id, libelle FROM type WHERE id=:id");
        $this->update = $db->prepare("UPDATE type SET libelle=:libelle WHERE id=:id");
        $this->delete = $db->prepare("DELETE FROM type WHERE id=:id");
    }

    public function insert($libelle){  // Permet d'insérer un nouveau "type"
        $r = true;
        $this->insert->execute(array(':libelle'=>$libelle));
        if ($this->insert->errorCode()!=0){ print_r($this->insert->errorInfo());
        $r=false;
        }
        return $r;
        }    

    public function select(){  // Permet d'afficher tous les types
        $this->select->execute();
        if ($this->select->errorCode()!=0){
        print_r($this->select->errorInfo());
        }
        return $this->select->fetchAll();
        }

    public function selectById($id){  // Permet d'afficher un type selon son id
        $this->selectById->execute(array(':id'=>$id)); 
        if ($this->selectById->errorCode()!=0){
            print_r($this->selectById->errorInfo());
        }
        return $this->selectById->fetch();
        }

    public function update($id, $libelle){  // Permet de mettre un jour un type (lui changer de nom)
        $r = true;
        $this->update->execute(array(':id'=>$id, ':libelle'=>$libelle));
        if ($this->update->errorCode()!=0){ print_r($this->update->errorInfo());
            $r=false;
        }
        return $r;
        }

    public function delete($id){  // Permet de supprimer un type
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
