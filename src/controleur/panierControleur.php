<?php
function panierControleur($twig, $db){
    $form = array();
    $liste = array();

    if (isset($_POST['placerCommade'])) { // Permet de valider la commande et de tout enregistre sur la base de données.
        $montant = $_POST['montant'];
        $aujourdhui = new DateTime();
        $aujourdhui->setTimezone(new DateTimeZone('Europe/Paris'));
        $date = $aujourdhui->format("Y-m-d H:i:s");
        $etat = 1;

        $utilisateur = new Utilisateur($db);
        $unUtil = $utilisateur->selectByEmail($_SESSION['login']);
        $idUtilisateur = $unUtil['id'];

        $form['valide'] = true;
        $commande = new Commande($db);
        $exec = $commande->insert($montant, $date, $etat, $idUtilisateur);

        if (!$exec) {
            $form['valide'] = false;
            $form['message'] = 'Problème de l\'enregistrement de la commande';
        } else {
            $maCommande = $commande->selectByDateCli($date, $idUtilisateur);
            $composer = new Composer($db);

            if (!empty($_SESSION['panier']) && is_array($_SESSION['panier'])) {
                foreach ($_SESSION['panier'] as $k => $v) {
                    $execC = $composer->insert($maCommande['id'], $k, $v);

                    if (!$execC) {
                        $form['erreur'] = 'Problème : au moins un produit n\'a pas été validé';
                    }
                }
            }

            $form['message'] = 'Votre commande a été passée';
            unset($_SESSION['panier']);
        }
    } else {
        if (!empty($_SESSION['panier'])) { // Prépare le panier s'il n'a pas encore été mis en place
            $ids = array_keys($_SESSION['panier']);
            $produits = new Produit($db);
            $liste = $produits->selectIn($ids);
        }

        if (isset($_POST['btAjoutP'])) { // Permet d'ajouter davantage de produits dans la page panier.html.twig
            $produitId = $_POST['id'];

            if (!isset($_SESSION['panier'][$produitId])) {
                $_SESSION['panier'][$produitId] = 1;
            } else {
                $_SESSION['panier'][$produitId]++;
            }

            header("Location: index.php?page=panier");
            exit();
        }

        if (isset($_GET['remove'])) { // Permet de retirer quelque chose du panier
            unset($_SESSION['panier'][$_GET['remove']]);
            header("Location: index.php?page=panier");
            exit();
        }

        if (isset($_POST['update'])) { // Permet de mettre à jour le panier si l'utilisateur modifie le nombre d'exemplaires dans son panier
            foreach ($_POST as $k => $v) {
                if (strpos($k, 'q-') !== false) {
                    $explose = explode('-', $k);
                    $unid = (int)$explose[1];
                    $_SESSION['panier'][$unid] = $v;
                }
            }

            header("Location:index.php?page=panier");
        }
    }

    echo $twig->render('panier.html.twig', array(
        'form' => $form,
        'liste' => $liste));
}
?>
