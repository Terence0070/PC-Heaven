<?php
    function utilisateurControleur($twig, $db){
        $form = array();
        $utilisateur = new Utilisateur($db);
       
        if(isset($_POST['btSupprimer'])){ // Permet de supprimer un utilisateur de la base de données (et donc du site)
            $cocher = $_POST['cocher'];
            $form['valide'] = true;
            $etat = true;
            foreach ( $cocher as $id){
                $exec=$utilisateur->delete($id);
                if (!$exec){
                    $etat = false;
                }
            }
            header('Location: index.php?page=utilisateur&etat='.$etat);
            exit;
        }
        if(isset($_GET['id'])){ // Si l'id de l'utilisateur est valide et existe, on peut le supprimer.
            $exec=$utilisateur->delete($_GET['id']);
            if (!$exec){
                $etat = false;
                }else{
                    $etat = true;
                }
                header('Location: index.php?page=utilisateur&etat='.$etat); exit;
        }
        if(isset($_GET['etat'])){
            $form['etat'] = $_GET['etat'];
        }
        $liste = $utilisateur->select();

        $limite = 8; // Le nombre d'utilisateurs affichés par page est de 8 (changez le nombre si vous voulez plus ou moins)
        if (!isset($_GET['nopage'])) {
            $nopage = 0;
        } else {
            $nopage = $_GET['nopage'];
        }
        
        $inf = $nopage * $limite;
        
        $r = $utilisateur->selectCount();
        $nb = $r['nb'];
        
        $liste = $utilisateur->selectLimit($inf, $limite);
        
        $form['nbpages'] = ceil($nb / $limite);
        $form['nopage'] = $nopage;

        echo $twig->render('utilisateur.html.twig', array('form'=>$form,'liste'=>$liste));
    }

    function utilisateurModifControleur($twig, $db){ // Permet de modifier des informations sur l'utilisateur dans la base de données.
        $form = array(); 
        if(isset($_GET['id'])){
            $utilisateur = new Utilisateur($db);
            $unUtilisateur = $utilisateur->selectById($_GET['id']); 
            if ($unUtilisateur!=null){
                $form['utilisateur'] = $unUtilisateur;
                $role = new Role($db);
                $liste = $role->select();
                $form['roles']=$liste;
            }
            else{
                $form['message'] = 'Utilisateur incorrect';
            }
        }
        else{
            if (isset($_POST['btModifier'])) {
                $utilisateur = new Utilisateur($db);
                $email = $_POST['email'];
                $nom = $_POST['nom'];
                $prenom = $_POST['prenom'];
                $idRole = $_POST['idRole'];
                $id = $_POST['id'];
                $mdp = !empty($_POST['mdp']) ? $_POST['mdp'] : null;
            
                if ($mdp !== null && strlen($mdp) < 12) { // Si le mot de passe n'est pas vide (montrant que l'utilisateur souhaite le changer), mais qu'il est trop court, c'est refusé.
                        $form['valide'] = false;
                        $form['message'] = 'Le mot de passe est trop court';
                    } else {
                        // Vérifier la complexité du mot de passe
                        if ($mdp !== null && (!preg_match('/[A-Z]/', $mdp) || !preg_match('/[0-9]/', $mdp) || !preg_match('/[!@#$%^&*(),_.?":{}|<>-]/', $mdp))) {
                            $form['valide'] = false;
                            $form['message'] = 'Le mot de passe doit contenir au moins une majuscule, un chiffre et un caractère spécial';
                        } else {
                            // Mise à jour des informations de base
                            $exec1 = $utilisateur->update($email, $id, $idRole, $nom, $prenom);
            
                            // Mise à jour du mot de passe (si fourni)
                            if ($mdp !== null) {
                                $mdpHash = password_hash($mdp, PASSWORD_DEFAULT);
                                $exec2 = $utilisateur->updateMdp($mdpHash, $id);
                            }
            
                            // Gestion des messages de validation en fonction des résultats
                            if (!$exec1 || (isset($exec2) && !$exec2)) {
                                $form['valide'] = false;
                                $form['message'] = 'Échec de la modification';
                            } else {
                                $form['valide'] = true;
                                $form['message'] = 'Modification réussie';
                            }
                        }
                    }
                } 
            else {
            $form['message'] = 'Utilisateur non précisé';
            } 
        } echo $twig->render('utilisateur-modif.html.twig', array('form' => $form));
    }
?>