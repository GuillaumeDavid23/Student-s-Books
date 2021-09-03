<?php
//Démmarrage de la session
session_start();
//TEST de l'exitsance de la session
if(empty($_SESSION['rank'])){
        header('Location: ../controller/connectCtrl.php');
} 

//Inclusion des différents fichiers
require_once(dirname(__FILE__).'/../model/bdd.php');
require_once(dirname(__FILE__).'/../model/tchat.php');
require_once(dirname(__FILE__).'/../model/user.php');
require_once(dirname(__FILE__).'/../public/config/config.php');

//On définit la langue par défault et la zone pour l'heure
setlocale (LC_TIME, 'fr_FR.utf8','fra'); 
date_default_timezone_set('Europe/Paris');

//Préparation de l'affichage.
$title = "Tchat en ligne : Students'Books";
$meta ="";
$head = "Tchat";

include dirname(__FILE__).'/../view/templates/header.php';
include dirname(__FILE__).'/../view/tchat.php';
include dirname(__FILE__).'/../view/templates/footer.php';

