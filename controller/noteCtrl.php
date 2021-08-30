<?php
session_start();
define("REGEX_BIRTHDAY", "^([12]\d{3}[-](0[1-9]|1[0-2])[-](0[1-9]|[12]\d|3[01]))$");
if(empty($_SESSION['rank'])){
    header('Location: ../controller/connectCtrl.php');
}

if($_SESSION['rank'] == "3"){
    $matter = $_SESSION['subject'];
    $teacher = $_SESSION['id'];
}

require_once(dirname(__FILE__).'/../model/bdd.php');
require_once(dirname(__FILE__).'/../model/user.php');
require_once(dirname(__FILE__).'/../model/marks.php');
require_once(dirname(__FILE__).'/../public/config/config.php');
//Variables
$testForm = false;
$arrayOfMatters = [
    'Mathématique',
    'Histoire-Géographie',
    'Français',
    'Sciences de la vie et de la terre',
    'Sciences Physiques',
    'Technologie',
    'Musique',
    'Anglais',
    'Art Plastiques',
    'Latin',
    'Education physique et sportive'
];

    //Fonction de validation des données
    function valid_data($index, $data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        foreach ($_POST as $key => $value) {
            $_POST[$key] = valid_data($key,$value);
        }

        if(empty($_POST['notationDate'])){
            $error = "<br>ERREUR Champs 'notationDate' vide !";
            $stockError['notationDate'] = $error;
            $testForm = true;//Affichage du formulaire si vide
        }else{
            $notationDate = $_POST['notationDate'];
        }

        if(empty($_POST['notationName'])){
            $error = "<br>ERREUR Champs 'notationName' vide !";
            $stockError['notationName'] = $error;
            $testForm = true;//Affichage du formulaire si vide
        }else{
            $notationName = $_POST['notationName'];
        }

        if(empty($_POST['notationInput'])){
            $error = "<br>ERREUR Note non renseigné !";
            $stockError['notationInput'] = $error;
            $testForm = true; //Affichage du formulaire si vide
        }else{
            $notationInput = $_POST['notationInput'];
        }

        if(empty($_POST['class'])){
            $error = "<br>ERREUR Classe non renseigné!";
            $stockError['class'] = $error;
            $testForm = true;//Affichage du formulaire si vide
        }else{
            $class = $_POST['class'];
        }

        if(empty($_POST['student'])){
            $error = "<br>ERREUR student non renseigné!";
            $stockError['student'] = $error;
            $testForm = true;//Affichage du formulaire si vide
        }else{
            $student = $_POST['student'];
        }

        if(!preg_match("/".REGEX_BIRTHDAY."/", $notationDate)){
                $error = "ERREUR Le format de la date du devoir est incorrect (Format : YYYY-MM-JJ)";
                $stockError['notationDate'] = $error;
                $testForm = true;//Affichage du formulaire si vide
        }else{
            $save = explode("-", $notationDate);
            $year = $save[0];
            $month = $save[1];
            $day = $save[2];

            if(!checkdate($month, $day, $year)){
                $error = "ERREUR La date saisie n'existe pas";
                $stockError['notationDate'] = $error;
                $testForm = true;//Affichage du formulaire si vide
            }
        }
        
        if(!$testForm){
            $marks = new Mark("", $notationDate, $notationInput, $notationName, $student, $teacher);
            $code = $marks->Add();
            //header('Refresh:0');
        }
    }
    
    $marks = new Mark();
    $marksArray = $marks->SelectAll();

    $dataArray = [];

    foreach ($marksArray as $data){
        $users = new User($data['id_users_teacher_marks']);
        $matter = $users->SelectOne('matters');
        $data['matter'] = $matter->matter;
        if($_SESSION['rank'] == "1"){
            if($data['id_users'] == $_SESSION['id']){
                array_push($dataArray, $data);
            }
        }
        elseif($_SESSION['rank'] == "3"){
            if($data['id_users_teacher_marks'] == $_SESSION['id']){
                array_push($dataArray, $data);
            }
        }
        
    }

    $users = new User();
    $dataUsers = $users->SelectAll();
include dirname(__FILE__).'/../view/templates/header.php';
include dirname(__FILE__).'/../view/note.php';
include dirname(__FILE__).'/../view/templates/footer.php';
