<?php
//test de session
require_once(dirname(__FILE__).'/../session/sessionCtrl.php');
//Modèles
require_once(dirname(__FILE__).'/../../model/user.php');
require_once(dirname(__FILE__).'/../../model/marks.php');
require_once(dirname(__FILE__).'/../../model/matters.php');
require_once(dirname(__FILE__).'/../../model/classes.php');
 

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
if($_SESSION['user']->id_ranks == "3"){
    $matter = $_SESSION['user']->id_matters;
    $teacher = $_SESSION['user']->id;
}

if($_SERVER['REQUEST_METHOD'] == "POST"){

    //Fonction de validation des données
    function valid_data($index, $data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
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

$marksArray = Mark::SelectAll();
$dataArray = [];
$marksSum = 0;
$count = 0;
if($_SESSION['user']->id_ranks == "1"){
    foreach ($marksArray as $data){
        $matters = Matter::SelectOne($data['id_users_teacher_marks']);
        $data['matter'] = $matters->matter;
        if($data['id_users'] == $_SESSION['user']->id){
            array_push($dataArray, $data);
            $marksSum += $data['note'];
            $count++;
        }
    }
}
if($count > 0 && $marksSum > 0){
    $avg = $marksSum/$count;
}
else{
    $avg = 0;
}

$classesArray = Classes::SelectAll();
$dataUsers = User::SelectAll();

include dirname(__FILE__).'/../../view/pages/note.php';
