<?php
function connexionControleur($twig, $db){
    $form = array();

    if (isset($_POST['btConnecter'])) {
        $form['valide'] = true;
        $inputEmail = $_POST['inputEmail'];
        $inputPassword = $_POST['inputPassword'];

        $utilisateur = new Utilisateur($db);
        $unUtilisateur = $utilisateur->connect($inputEmail);

        if ($unUtilisateur != null) {
            // On vérifie si le nom d'utilisateur et le mot de passe sont valides.
            if (!password_verify($inputPassword, $unUtilisateur['mdp'])) {
                $form['message'] = 'Login ou mot de passe incorrect';
                $form['valide'] = false;
            } else {
                $_SESSION['login'] = $inputEmail;
                $_SESSION['role'] = $unUtilisateur['idRole'];
                header("Location:index.php");
            }
        } else {
            // L'utilisateur n'existe pas, c'est un échec.
            $form['message'] = 'Login ou mot de passe incorrect';
            $form['valide'] = false;
        }
    }
    echo $twig->render('connexion.html.twig', array(
        'form' => $form));
}
?>