<?php
class Composer {
    private $db;
    private $insert;

    public function __construct($db) {
        $this->db = $db;
        $this->insert = $db->prepare("INSERT INTO composer(idCommande, idProduit, quantite) VALUES (:idCommande, :idProduit, :quantite)");
    }

    public function insert($idCommande, $idProduit, $quantite){
        $r = true;
    
        $this->insert->execute(array(':idCommande'=>$idCommande, ':idProduit'=>$idProduit, ':quantite'=>$quantite));
        if ($this->insert->errorCode()!=0){ 
            print_r($this->insert->errorInfo());
            $r=false;
        }
        return $r;
     }
}
?>
