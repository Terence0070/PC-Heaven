<?php
function rechercheControleur($twig, $db) {
    $produit = new Produit($db);

    $resultats = array();

    if (isset($_GET['q'])) {
        $recherche = $_GET['q'];
        $resultats = $produit->recherche($recherche);
    }

    echo $twig->render('recherche.html.twig', array('resultats' => $resultats));
}
?>