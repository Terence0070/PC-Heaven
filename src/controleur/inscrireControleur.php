<?php
function inscrireControleur($twig, $db){
    $form = array();

    if (isset($_POST['btInscrire'])) {
        $inputEmail = $_POST['inputEmail'];
        $inputPassword = $_POST['inputPassword'];
        $inputPassword2 = $_POST['inputPassword2'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $role = $_POST['role'];
        $form['valide'] = true;

        // Vérifier si les mots de passe sont différents
        if ($inputPassword != $inputPassword2) {
            $form['valide'] = false;
            $form['message'] = 'Les mots de passe sont différents';
        } else {
            // Vérifier la longueur minimale du mot de passe
            if (strlen($inputPassword) < 12) {
                $form['valide'] = false;
                $form['message'] = 'Le mot de passe est trop court';
            } else {
                // Vérifier la complexité du mot de passe
                if (!preg_match('/[A-Z]/', $inputPassword) || !preg_match('/[0-9]/', $inputPassword) || !preg_match('/[!@#$%^&*(),_.?":{}|<>-]/', $inputPassword)) {
                    $form['valide'] = false;
                    $form['message'] = 'Le mot de passe doit contenir au moins une majuscule, un chiffre et un caractère spécial';
                } else {
                    $utilisateur = new Utilisateur($db);

                    // Vérifier si l'utilisateur existe déjà
                    if ($utilisateur->existe($inputEmail)) {
                        $form['valide'] = false;
                        $form['message'] = 'Cet utilisateur existe déjà';
                    } else {
                        // Insérer l'utilisateur dans la base de données
                        $exec = $utilisateur->insert($inputEmail, password_hash($inputPassword, PASSWORD_DEFAULT), $role, $nom, $prenom);

                        if (!$exec) {
                            $form['valide'] = false;
                            $form['message'] = 'Problème d\'insertion dans la table utilisateur';
                        }
                    }
                }
            }

            $form['email'] = $inputEmail;
            $form['role'] = $role;
        }
    }

    echo $twig->render('inscrire.html.twig', array('form' => $form));
}
?>