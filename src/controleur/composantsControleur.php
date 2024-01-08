<?php
function composantsControleur($twig, $db) {
    $recherche = new Recherche($db);
    $resultatsCPU = array();
    $resultatsGPU = array();
    $resultatsRAM = array();
    $resultatsHDD = array();

    // Récupérer le terme de recherche
    $rechercheTerme = isset($_GET['q']) ? $_GET['q'] : '';

    // Vérifier les cases à cocher
    $rechercheCPU = isset($_GET['cpu']) && ($_GET['cpu'] == 'on');
    $rechercheGPU = isset($_GET['gpu']) && ($_GET['gpu'] == 'on');
    $rechercheRAM = isset($_GET['ram']) && ($_GET['ram'] == 'on');
    $rechercheHDD = isset($_GET['hdd']) && ($_GET['hdd'] == 'on');

    // Effectuer la recherche pour les CPU si la case CPU est cochée, ou si la barre de recherche est vide et aucune autre case n'est cochée
    if ($rechercheCPU || (empty($rechercheTerme) && !$rechercheGPU && !$rechercheRAM && !$rechercheHDD)) {
        $resultatsCPU = $recherche->rechercheCPU($rechercheTerme);
    }

    // Effectuer la recherche pour les GPU si la case GPU est cochée, ou si la barre de recherche est vide et aucune autre case n'est cochée
    if ($rechercheGPU || (empty($rechercheTerme) && !$rechercheCPU && !$rechercheRAM && !$rechercheHDD)) {
        $resultatsGPU = $recherche->rechercheGPU($rechercheTerme);
    }

    // Effectuer la recherche pour la RAM si la case RAM est cochée, ou si la barre de recherche est vide et aucune autre case n'est cochée
    if ($rechercheRAM || (empty($rechercheTerme) && !$rechercheCPU && !$rechercheGPU && !$rechercheHDD)) {
        $resultatsRAM = $recherche->rechercheRAM($rechercheTerme);
    }

    // Effectuer la recherche pour les HDD si la case HDD est cochée, ou si la barre de recherche est vide et aucune autre case n'est cochée
    if ($rechercheHDD || (empty($rechercheTerme) && !$rechercheCPU && !$rechercheGPU && !$rechercheRAM)) {
        $resultatsHDD = $recherche->rechercheHDD($rechercheTerme);
    }


    echo $twig->render('composants.html.twig', array(
        'cpu' => $resultatsCPU,
        'gpu' => $resultatsGPU,
        'ram' => $resultatsRAM,
        'hdd' => $resultatsHDD,
        'q' => $rechercheTerme,
        'cpu_checked' => $rechercheCPU,
        'gpu_checked' => $rechercheGPU,
        'ram_checked' => $rechercheRAM,
        'hdd_checked' => $rechercheHDD,
    ));
}
?>

