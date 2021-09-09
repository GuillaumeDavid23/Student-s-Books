<?php 
//Démarrage de la session
session_start();

//TEST de la session utilisateur
if(empty($_SESSION['user'])){
    header('Location: /index.php?page=10');
    exit();
}else{
    $rank = $_SESSION['user']->id_ranks;
    $id_users = $_SESSION['user']->id;
    $subject = $_SESSION['user']->id_matters;
}

//Inclusion des fichiers 
require_once(dirname(__FILE__).'/../../model/user.php');
require_once(dirname(__FILE__).'/../../model/assignements.php');
require_once(dirname(__FILE__).'/../../model/matters.php');
require_once(dirname(__FILE__).'/../../public/config/config.php');

//Déclaration des variables et constantes
$testForm = false;

if($_SERVER['REQUEST_METHOD'] == "POST"){

    if(empty($_POST['assignmentDate']))
    {
        $stockError['assignmentDate'] = "<br>ERREUR Champs 'assignmentDate' vide !";
        $testForm = true;
    }
    elseif(empty($_POST['assignmentName']))
    {
        $stockError['assignmentName'] = "<br>ERREUR Champs 'assignmentName' vide !";
        $testForm = true;
    }
    elseif(empty($_POST['class']))
    {
        $stockError['class'] = "<br>ERREUR Classe non renseigné!";
        $testForm = true;
    }
    elseif(empty($subject))
    {
        $stockError['subject'] = "<br>ERREUR Votre matière de professeur n'est pas renseigné !";
        $testForm = true;
    }
    else
    {
        $hwDate = strip_tags(trim(filter_input(INPUT_POST, 'assignmentDate', FILTER_SANITIZE_STRING)));
        $hwName = strip_tags(trim(filter_input(INPUT_POST, 'assignmentName', FILTER_SANITIZE_STRING)));
        $class = strip_tags(trim(filter_input(INPUT_POST, 'class', FILTER_SANITIZE_STRING)));
        
        if(!preg_match("/".REGEX_BIRTHDAY."/", $hwDate)){
                $stockError['assignmentDate'] = "ERREUR Le format de la date du devoir est incorrect (Format : YYYY-MM-JJ)";
                $testForm = true;
        }else{
            $save = explode("-", $hwDate);
            if(!checkdate($save[1], $save[2], $save[0])){
                $stockError['assignmentDate'] = "ERREUR La date saisie n'existe pas";
                $testForm = true;
            }
        }

        if(!$testForm){
            //Ajout dans la base
            $assign = new Assign("", $hwDate, $hwName, $class, $id_users);
            $code = $assign->Add();
            header('Refresh:0');
            exit;
        }
    }
}

//Préparation de l'affichage
$dataArray = Assign::SelectAll();
$title = 'Page des devoirs : voir ou rendre un devoir';
$meta = '';
$head = "Devoirs";

//Inclusion des vues
include dirname(__FILE__).'/../../view/templates/header.php';
include(dirname(__FILE__).'/../../view/pages/assignment.php');
include dirname(__FILE__).'/../../view/templates/footer.php';