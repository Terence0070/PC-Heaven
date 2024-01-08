<?php
function accueilControleur($twig, $db){
    $accueil = new Accueil($db);

    // Appel de la méthode pour récupérer les ordinateurs récents
    $ordinateursRecents = $accueil->OrdinateurRecent();

    // Appel de la méthode pour récupérer les composants récents
    $composantsRecents = $accueil->ComposantsRecent();

    // Rendu Twig avec les résultats
    echo $twig->render('accueil.html.twig', array(
        'ordinateursRecents' => $ordinateursRecents,
        'composantsRecents' => $composantsRecents,
    ));
}
?>


