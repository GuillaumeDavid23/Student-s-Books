<?php
//Démmarrage de la session
session_start();
//TEST de l'exitsance de la session
if(empty($_SESSION['user'])){
        header('Location: /index.php?page=10');
} 

//Inclusion des différents fichiers
require_once(dirname(__FILE__).'/../../model/tchat.php');
require_once(dirname(__FILE__).'/../../model/user.php');
 

//On définit la langue par défault et la zone pour l'heure
setlocale (LC_TIME, 'fr_FR.utf8','fra'); 
date_default_timezone_set('Europe/Paris');

//Préparation de l'affichage.
$title = "Tchat en ligne : Students'Books";
$meta ="";
$head = "Tchat";

include dirname(__FILE__).'/../../view/templates/header.php';
include dirname(__FILE__).'/../../view/pages/tchat.php';
include dirname(__FILE__).'/../../view/templates/footer.php';

