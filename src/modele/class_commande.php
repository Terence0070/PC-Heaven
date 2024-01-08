<?php
class Commande {
    private $db;
    private $insert;
    private $selectByDateCli;

    public function __construct($db) {
        $this->db = $db;
        $this->insert = $db->prepare("INSERT INTO commande(montant, date, etat, idUtilisateur) VALUES (:montant, :date, :etat, :idUtilisateur)");
        $this->selectByDateCli = $db->prepare("SELECT id FROM commande WHERE date = :date AND idUtilisateur = :idUtilisateur");
    }

    public function insert($montant, $date, $etat, $idUtilisateur) {
        $r = true;
    
        // Vérifier si $idUtilisateur n'est pas nul avant d'exécuter la requête
        if ($idUtilisateur !== null) {
            $this->insert->execute(array(':montant' => $montant, ':date' => $date, ':etat' => $etat, ':idUtilisateur' => $idUtilisateur));
            
            if ($this->insert->errorCode() != 0) {
                print_r($this->insert->errorInfo());
                $r = false;
            }
        } else {
            echo "Erreur : idUtilisateur ne peut pas être null.";
            $r = false;
        }
    
        return $r;
    }
    

    public function selectByDateCli($date, $idUtilisateur) {
        $this->selectByDateCli->bindParam(':date', $date);
        $this->selectByDateCli->bindParam(':idUtilisateur', $idUtilisateur);
        $this->selectByDateCli->execute();
    
        if ($this->selectByDateCli->errorCode() != 0) {
            print_r($this->selectByDateCli->errorInfo());
            return false; // Retourner false en cas d'erreur
        }
    
        // Retourner le résultat de la requête
        $result = $this->selectByDateCli->fetch(PDO::FETCH_ASSOC);
        return isset($result['id']) ? $result : false;
    }
    
      
}
?>
