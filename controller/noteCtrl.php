<?php
session_start();
define("REGEX_BIRTHDAY", "^([12]\d{3}[-](0[1-9]|1[0-2])[-](0[1-9]|[12]\d|3[01]))$");
if(empty($_SESSION['rank'])){
    header('Location: ../controller/connectCtrl.php');
}
//Connexion BDD
require_once(dirname(__FILE__).'/../model/model.php');
$bdd = new BDD();
$pdo = $bdd->bddConnect();
//Variables
    $testForm = false;
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

        $matter = "Histoire";
        $teacher = $_SESSION['lastname'];
        if(!$testForm){
            $error = "C'est good !";
            $sql = "INSERT INTO `notation`(`date`, `matter`, `name`, `notation`, `class`, `lastname`, `teacher`) 
            VALUES('$notationDate', '$matter', '$notationName', '$notationInput', '$class', '$student', '$teacher')";
            $pdo->query($sql);
            header('Location: /controller/noteCtrl.php');
        }
    }
    $sql = "SELECT * FROM notation";
    $request = $pdo->query($sql);
    $dataArray = [];
    while ($data = $request->fetch(PDO::FETCH_ASSOC)){
            array_push($dataArray, $data);
    }
include(dirname(__FILE__).'/../view/note.php');