<?php
function getPage($db){
// Les contrôleurs à inscrire.
$lesPages['accueil'] = "accueilControleur;0";
// Fonctionnalités principales (inscription, connexion, etc.)
$lesPages['inscrire'] = "inscrireControleur;0";
$lesPages['connexion'] = "connexionControleur;0";
$lesPages['deconnexion'] = "deconnexionControleur;0";
$lesPages['maintenance'] = "maintenanceControleur;0";

// Contrôleur lié au panier
$lesPages['panier'] = "panierControleur;2";

// Contrôleurs liés aux différentes pages principales (le choix des composants, du PC, le configurateur, etc.)
$lesPages['recherche'] = "rechercheControleur;0";
$lesPages['ordinateurs'] = "ordinateursControleur;0";
$lesPages['configurateur'] = "configurateurControleur;0";
$lesPages['composants'] = "composantsControleur;0";

// Contrôleurs liés aux pages tertiaires (tout ce qui est lié à la paperasse et le légal)
$lesPages['mentions_legales'] = "mentionsControleur;0";
$lesPages['politique_confidentialite'] = "politiqueControleur;0";
$lesPages['contact'] = "contactControleur;0";
$lesPages['a_propos'] = "aproposControleur;0";

// Contrôleurs liés aux types (carte graphique, processeur, etc.) (Accessible uniquement aux admins)
$lesPages['type'] = "typeControleur;1";
$lesPages['type-modif'] = "typeModifControleur;1";

// Contrôleurs liés aux produits (Accessible uniquement aux admins)
$lesPages['produit'] = "produitControleur;1";
$lesPages['produit-modif'] = "produitModifControleur;1";
$lesPages['produit-ajout'] = "produitAjoutControleur;1";

// Contrôleurs liés aux utilisateurs (Accessible uniquement aux admins)
$lesPages['utilisateur'] = "utilisateurControleur;1";
$lesPages['utilisateur-modif'] = "utilisateurModifControleur;1";

if ($db != null) {
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 'accueil';
    }

    if (!isset($lesPages[$page])) {
        // Redirige l'utilisateur vers la page d'accueil si la page demandée n'existe pas
        $page = 'accueil';
    }

    $explose = explode(";", $lesPages[$page]);

    // Vérifie si l'élément existe à l'indice 1 avant de l'accéder
    if (isset($explose[1])) {
        $role = $explose[1];

        if ($role != 0) {
            // Si le rôle nécessite une vérification
            if (isset($_SESSION['login']) && isset($_SESSION['role'])) {
                if ($role != $_SESSION['role']) {
                    // Redirige vers l'accueil si le rôle ne correspond pas
                    $contenu = 'accueilControleur';
                } else {
                    $contenu = $explose[0];
                }
            } else {
                $contenu = 'accueilControleur';
            }
        } else {
            $contenu = $explose[0];
        }
    } else {
        // Gère le cas où il n'y a pas de rôle défini dans $lesPages[$page]
        $contenu = $explose[0];
    }
} else {
    $contenu = 'maintenanceControleur';
}

return $contenu;



}
?>