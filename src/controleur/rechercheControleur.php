<?php
function rechercheControleur($twig, $db) { // Permet de recherche l'intégralité des produits avec la barre de recherche sur le menu
    $produit = new Produit($db);

    $resultats = array();

    if (isset($_GET['q'])) {
        $recherche = $_GET['q'];
        $resultats = $produit->recherche($recherche);
    }

    echo $twig->render('recherche.html.twig', array(
        'resultats' => $resultats));
}
?>