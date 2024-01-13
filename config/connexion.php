<?php
// Connexion à la base de données.
function connect($config){
    try{
        $db = new PDO('mysql:host='.$config['serveur'].';dbname='.$config['bd'], $config['login'], $config['mdp'], array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8')); // On utilise PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8' pour forcer tous les champs à s'afficher en utf8 quoiqu'il arrive. 
    }
 catch(Exception $e){
    $db = NULL;
    }
    return $db;
}
?>