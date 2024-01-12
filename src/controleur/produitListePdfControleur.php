<?php
function produitListePdfControleur($twig, $db){
    $produit = new Produit($db);
    $liste = $produit->select(); // Utiliser la nouvelle méthode qui récupère uniquement les noms de produits

    echo $twig->render('produit-liste-pdf.html.twig', array('liste' => $liste));
}
?>
