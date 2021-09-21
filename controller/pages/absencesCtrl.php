<?php 
//Démarrage de la session
session_start();

//TEST de l'existance de la session utilisateur.
if(empty($_SESSION['user'])){
        header('Location: /index.php?page=10');
        exit;
}

//Inclusion des différents fichiers
require_once(dirname(__FILE__).'/../../model/user.php');
require_once(dirname(__FILE__).'/../../model/absences.php');

//On définit la localité
setlocale (LC_TIME, 'fr_FR.utf8','fra.utf8'); 

//Déclaration des variables
$absencesArray = Absence::SelectAll();

//Inclusion des vues
include dirname(__FILE__).'/../../view/pages/absences.php';