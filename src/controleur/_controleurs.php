<?php
// On met tous les contrôleurs qu'on a ajouté dans le dossier "controleur"
    require_once 'accueilControleur.php';

// Fonctionnalités principales (inscription, connexion, etc.)
    require_once 'inscrireControleur.php';
    require_once 'connexionControleur.php';
    require_once 'deconnexionControleur.php';
    require_once 'maintenanceControleur.php';
    require_once 'politiqueControleur.php';

// Contrôleur lié au panier
    require_once 'panierControleur.php';

// Contrôleurs liés aux différentes pages principales (le choix des composants, du PC, le configurateur, etc.)
    require_once 'rechercheControleur.php';
    require_once 'composantsControleur.php';
    require_once 'configurateurControleur.php';
    require_once 'ordinateursControleur.php';

// Contrôleurs liés aux pages tertiaires (tout ce qui est lié à la paperasse et le légal)
    require_once 'aproposControleur.php';
    require_once 'contactControleur.php';
    require_once 'mentionsControleur.php';

// Contrôleur lié aux types (carte graphique, processeur, etc.) (Accessible uniquement aux admins)
    require_once 'typeControleur.php';

// Contrôleur lié aux produits (Accessible uniquement aux admins)
    require_once 'produitControleur.php';

// Contrôleur lié aux utilisateurs (Accessible uniquement aux admins)
    require_once 'utilisateurControleur.php';

?>