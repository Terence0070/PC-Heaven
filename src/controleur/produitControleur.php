<?php
function produitControleur($twig, $db){
    $form = array();
    $produit = new Produit($db);

    if(isset($_POST['btSupprimer'])){ // Permet de supprimer un produit de la liste des produits (disponible quand on est administrateur)
        $cocher = $_POST['cocher'];
        $form['valide'] = true;
        $etat = true;
        foreach ( $cocher as $id){
            $exec=$produit->delete($id);
            if (!$exec){
                $etat = false;
                $form['message'] = 'Problème de suppression dans la table produit';
                }
            }
        header('Location: index.php?page=produit&etat='.$etat);
        exit;
            }

        if(isset($_GET['id'])){
            $exec=$produit->delete($_GET['id']);
        if (!$exec){
            $etat = false;
            $form['message'] = 'Problème de suppression dans la table produit';
        }else{
            $etat = true;
            $form['message'] = 'Produit supprimé';
        }
        header('Location: index.php?page=produit&etat='.$etat); exit;
        }
            if(isset($_GET['etat'])){
            $form['etat'] = $_GET['etat'];
        }

    $limite = 8;
    if (!isset($_GET['nopage'])) {
        $nopage = 0;
    } else {
        $nopage = $_GET['nopage'];
    }
        
    $inf = $nopage * $limite;
        
    $r = $produit->selectCount();
    $nb = $r['nb'];
        
    $liste = $produit->selectLimit($inf, $limite);
        
    $form['nbpages'] = ceil($nb / $limite);
    $form['nopage'] = $nopage;

    echo $twig->render('produit.html.twig', array('form'=>$form,'liste'=>$liste));
}

function produitAjoutControleur($twig, $db) { // Permet d'ajouter un produit dans la liste des produits (disponible quand on est administrateur)
    $form = array();
    $type = new Type($db);
    $listeT = $type->select();

    if (isset($_POST['btProduit'])) {
        $photo = null;
        $produit = new Produit($db);
        $nomProduit = $_POST['inputNomProduit'];
        $description = $_POST['inputDescription'];
        $prix = $_POST['inputPrix'];
        $idType = $_POST['inputCtg'];

        // Vérifier si un fichier a été soumis
        if (!empty($_FILES['photo']['name'])) {
            $upload = new Upload(array('png', 'gif', 'jpg', 'jpeg'), 'images', 500000);
            $photo = $upload->enregistrer('photo');

            echo '$_FILES:';
            print_r($_FILES);

            echo '$photo:';
            print_r($photo);
        }

        $exec = $produit->insert($nomProduit, $description, $prix, $idType, $photo['nom']);
        if (!$exec) {
            $form['valide'] = false;
            $form['message'] = 'Problème d\'insertion dans la table produit ';
        }
    }
    echo $twig->render('produit-ajout.html.twig', array(
        'form' => $form, 
        "listeT" => $listeT));
}

function produitModifControleur($twig, $db) {  // Permet de modifier un produit dans la liste des produits (disponible quand on est administrateur)
    $form = array();
    $type = new Type($db); // Instancie l'objet $type
    $listeT = $type->select();
    
    if (isset($_GET['id'])) {
        $produit = new Produit($db);
        $unProduit = $produit->selectById($_GET['id']); 
    
        if ($unProduit !== null) {
            $form['produit'] = $unProduit;
            $type = new Type($db);
            $listeT = $type->select();
            $form['type']=$listeT;
        } else {
            $form['message'] = 'Produit incorrect';
        }
    } else {
        if (isset($_POST['btModifier'])) {
            $produit = new Produit($db);
            $nomProduit = $_POST['nomProduit'];
            $description = $_POST['description'];
            $prix = $_POST['prix'];
            $idType = $_POST['inputCtg'];
            $id = $_POST['id'];
        
            $exec1 = $produit->update($nomProduit, $description, $prix, $idType, $id);
            
            if (!$exec1) {
                $form['valide'] = false;
                $form['message'] = 'Échec de la modification';
            } else {
                $form['valide'] = true;
                $form['message'] = 'Modification réussie';
            }
        }
    }
    echo $twig->render('produit-modif.html.twig', array(
        'form' => $form, 
        "listeT"=>$listeT));
}
?>