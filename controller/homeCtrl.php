<?php
session_start();
if(empty($_SESSION['user'])){
    header('Location: /index.php?page=10');
    exit;
}
setlocale (LC_TIME, 'fr_FR.utf8','fra');

//Inclusion des fichiers
require_once(dirname(__FILE__).'/../model/user.php');
require_once(dirname(__FILE__).'/../model/assignements.php');
require_once(dirname(__FILE__).'/../model/absences.php');
require_once(dirname(__FILE__).'/../model/marks.php');
require_once(dirname(__FILE__).'/../model/matters.php');
require_once(dirname(__FILE__).'/../public/config/config.php');

//Déclaration des variables
$users = new User();
$dataArrayNote = [];
$dataArrayEdt = [];
$noteArray = Mark::SelectAll();
$absencesArray = Absence::SelectAll();

// A DEPLACER !!
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $object = trim(strip_tags(filter_input(INPUT_POST, 'object',FILTER_SANITIZE_STRING)));
    $prob = trim(strip_tags(filter_input(INPUT_POST, 'prob',FILTER_SANITIZE_STRING)));

    if(!empty($object) && !empty($prob)){
        mail('guillaume.david744@orange.fr', "$object", "$prob");
    }
}

foreach ($noteArray as $note){
    if($_SESSION['user']->id_ranks == "1"){
        if($note['id_users'] == $_SESSION['user']->id){
            array_push($dataArrayNote, $note);
        }
    }
    elseif($_SESSION['user']->id_ranks == "3"){
        if($note['id_users_teacher_marks'] == $_SESSION['user']->id){
            array_push($dataArrayNote, $note);
        }
    }
}

$time = time();
$currentDay = ucfirst(strftime('%A', $time));

include dirname(__FILE__).'/../view/home.php';