<?php
    function typeControleur($twig, $db){
        $form = array();
        $type = new Type($db);

        if(isset($_POST['btSupprimer'])){
            $cocher = $_POST['cocher'];
            $form['valide'] = true;
            $etat = true;
            foreach ( $cocher as $id){
            $exec=$type->delete($id);
            if (!$exec){
            $etat = false;
            }
            }
            header('Location: index.php?page=type&etat='.$etat);
            exit;
            }
            if(isset($_GET['id'])){
            $exec=$type->delete($_GET['id']);
            if (!$exec){
            $etat = false;
            }else{
            $etat = true;
            }
            header('Location: index.php?page=type&etat='.$etat); exit;
            }
            if(isset($_GET['etat'])){
            $form['etat'] = $_GET['etat'];
            }
            $liste = $type->select();
            echo $twig->render('type.html.twig', array(
                'form'=>$form,
                'liste'=>$liste));

        if (isset($_POST['btLibelle'])){
            $form['valide'] = true;
            $libelle = $_POST['inputLibelle'];
            $ajouterlibelle = new Type($db);
            $exec = $ajouterlibelle->insert($libelle);
            if (!$exec){
                $form['valide'] = false;
                $form['message'] = 'Problème d\'insertion dans la table type ';
            }
            header("Location: index.php?page=type");
            exit;
        }
    }

    function typeModifControleur($twig, $db) {
        $form = array();
    
        if (isset($_GET['id'])) {
            $type = new Type($db);
            $unType = $type->selectById($_GET['id']); 
    
            if ($unType !== null) {
                $form['type'] = $unType;
            } else {
                $form['message'] = 'Libellé incorrect';
            }
        } else {
            if (isset($_POST['btModifier'])) {
                $type = new Type($db);
                $libelle = $_POST['libelle'];
                $id = $_POST['id'];
                $exec1 = $type->update($id, $libelle);
    
                if (!$exec1) {
                    $form['valide'] = false;
                    $form['message'] = 'Échec de la modification';
                } else {
                    $form['valide'] = true;
                    $form['message'] = 'Modification réussie';
                }
            }
        }
    
        echo $twig->render('type-modif.html.twig', array(
            'form' => $form));
    }
?>