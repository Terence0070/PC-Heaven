<?php
function ordinateursControleur($twig, $db) {
    $recherche = new Recherche($db);
    $resultatsOrdinateurs = array();
    $resultatsLaptops = array();

    // Récupérer le terme de recherche
    $rechercheTerme = isset($_GET['q']) ? $_GET['q'] : '';

    // Vérifier les cases à cocher
    $rechercheOrdinateurs = isset($_GET['ordinateurs']) && ($_GET['ordinateurs'] == 'on');
    $rechercheLaptops = isset($_GET['laptops']) && ($_GET['laptops'] == 'on');

    // Effectuer la recherche pour les ordinateurs si la case "Ordinateurs" est cochée, ou si la barre de recherche est vide
    if ($rechercheOrdinateurs || (empty($rechercheTerme) && !$rechercheLaptops)) {
        $resultatsOrdinateurs = $recherche->rechercheOrdinateur($rechercheTerme);
    }

    // Effectuer la recherche pour les laptops si la case "Laptops" est cochée, ou si la barre de recherche est vide
    if ($rechercheLaptops || (empty($rechercheTerme) && !$rechercheOrdinateurs)) {
        $resultatsLaptops = $recherche->rechercheLaptop($rechercheTerme);
    }


    echo $twig->render('ordinateurs.html.twig', array(
        'ordinateurs' => $resultatsOrdinateurs,
        'laptops' => $resultatsLaptops,
        'q' => $rechercheTerme,
        'ordinateurs_checked' => $rechercheOrdinateurs,
        'laptops_checked' => $rechercheLaptops,
    ));
}
?>




