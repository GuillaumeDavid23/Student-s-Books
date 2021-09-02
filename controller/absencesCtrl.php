<?php 
session_start();
setlocale (LC_TIME, 'fr_FR.utf8','fra.utf8'); 
if(empty($_SESSION['rank'])){
        header('Location: ../controller/connectCtrl.php');
}

require_once(dirname(__FILE__).'/../model/bdd.php');
require_once(dirname(__FILE__).'/../model/user.php');
require_once(dirname(__FILE__).'/../model/absences.php');

$absences= new Absence();
$absencesArray = $absences->SelectAll();




$title = 'Page des absences, Students\'Books : Les devoirs à la maison facilement';
$meta = 'Bienvenue sur Students\'Books, c\'est ici que commence la révolution scolaire.
        Emploi du temps/ devoirs/ absences... retrouver toutes les information scolaire içi';
$head = "Absences";
include dirname(__FILE__).'/../view/templates/header.php';
include dirname(__FILE__).'/../view/absences.php';
include dirname(__FILE__).'/../view/templates/footer.php';