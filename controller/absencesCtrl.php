<?php 
//Démarrage de la session
session_start();

//TEST de l'existance de la session utilisateur.
if(empty($_SESSION['user'])){
        header('Location: /index.php?page=10');
        exit;
}

//Inclusion des différents fichiers
require_once(dirname(__FILE__).'/../model/user.php');
require_once(dirname(__FILE__).'/../model/absences.php');

//On définit la localité
setlocale (LC_TIME, 'fr_FR.utf8','fra.utf8'); 

//Déclaration des variables
$absencesArray = Absence::SelectAll();

//Préparation de l'affichage de la vue.
$title = 'Page des absences, Students\'Books : Les devoirs à la maison facilement';
$meta = 'Bienvenue sur Students\'Books, c\'est ici que commence la révolution scolaire.
        Emploi du temps/ devoirs/ absences... retrouver toutes les information scolaire içi';
$head = "Absences";

//Inclusion des vues
include dirname(__FILE__).'/../view/templates/header.php';
include dirname(__FILE__).'/../view/absences.php';
include dirname(__FILE__).'/../view/templates/footer.php';