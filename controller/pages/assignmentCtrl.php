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
require_once(dirname(__FILE__).'/../../model/classes.php');
 

//Déclaration des variables et constantes
$code = null;
$uploadDir = 'uploads/assign/';
$stockError = [];

//Les données sont envoyés ?
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $hwDate = strip_tags(trim(filter_input(INPUT_POST, 'assignmentDate', FILTER_SANITIZE_STRING)));
    $hwName = strip_tags(trim(filter_input(INPUT_POST, 'assignmentName', FILTER_SANITIZE_STRING)));
    $class = strip_tags(trim(filter_input(INPUT_POST, 'class', FILTER_SANITIZE_STRING)));
    $returnAssign = strip_tags(trim(filter_input(INPUT_POST, 'returnAssign', FILTER_SANITIZE_NUMBER_INT)));
    $idAssign = strip_tags(trim(filter_input(INPUT_POST, 'idAssign', FILTER_SANITIZE_NUMBER_INT)));

    
    if(isset($_FILES['assignFile']) && !empty($_FILES['assignFile']['name'])){
        if($_FILES['assignFile']['size'] <= LIMIT_SIZE) 
        {
            $mime = mime_content_type($_FILES['assignFile']['tmp_name']);
            if(in_array($mime, SUPPORTED_FORMAT_ASSIGN)) 
            {
                    $extensionUpload = ".pdf";
                    $uploadfile = $uploadDir.basename($_SESSION['user']->id.'-'.$idAssign.$extensionUpload);
                    if(move_uploaded_file($_FILES['assignFile']['tmp_name'], $uploadfile)) 
                    {
                        $code = 17;
                    } else {
                        $stockError['assignFile'] = 'Erreur durant l\'importation de votre devoir';
                    }
            } else {
                $stockError['assignFile'] = 'Votre devoir doit être au format pdf';
            }
        } else {
            $stockError['assignFile'] = 'Votre devoirs ne doit pas dépasser 2Mo';
        }
    }elseif(!empty($idAssign)){
        //Modification D'UN DEVOIR
        if(empty($hwDate))
        {
            $stockError['ModalAssignmentDate'] = "<br>ERREUR Champs 'assignmentDate' vide !";
        }
        elseif(empty($hwName))
        {
            $stockError['ModalAssignmentName'] = "<br>ERREUR Champs 'assignmentName' vide !";
        }
        elseif(empty($class))
        {
            $stockError['ModalClass'] = "<br>ERREUR Classe non renseigné!";
        }
        elseif(empty($subject))
        {
            $stockError['subject'] = "<br>ERREUR Votre matière de professeur n'est pas renseigné !";
        }
        else
        {
            if(empty($returnAssign))
            {
                $returnAssign = 0;
            }
            elseif($returnAssign > 1)
            {
                $stockError['returnAssign'] = "<br>Valeur non valide !";
            }
            
            if(!preg_match("/".REGEX_BIRTHDAY."/", $hwDate)){
                    $stockError['assignmentDate'] = "ERREUR Le format de la date du devoir est incorrect (Format : YYYY-MM-JJ)";
            }else{
                $save = explode("-", $hwDate);
                if(!checkdate($save[1], $save[2], $save[0])){
                    $stockError['assignmentDate'] = "ERREUR La date saisie n'existe pas";
                }
            }
            
            if(empty($stockError)){
                //Modification dans la base
                $modifyAssign = Assign::SelectOne($idAssign);
                if($_SESSION['user']->id == $modifyAssign->id_users){
                    $assign = new Assign($idAssign, $hwDate, $hwName, $returnAssign,$class);
                    $code = $assign->Modify();
                }else{
                    $code=23;
                }
            }
        }
    }
    else{
        //AJOUT D'UN DEVOIR
        if(empty($hwDate))
        {
            $stockError['assignmentDate'] = "<br>ERREUR Champs 'assignmentDate' vide !";
        }
        elseif(empty($hwName))
        {
            $stockError['assignmentName'] = "<br>ERREUR Champs 'assignmentName' vide !";
        }
        elseif(empty($class))
        {
            $stockError['class'] = "<br>ERREUR Classe non renseigné!";
        }
        elseif(empty($subject))
        {
            $stockError['subject'] = "<br>ERREUR Votre matière de professeur n'est pas renseigné !";
        }
        else
        {
            if(empty($returnAssign))
            {
                $returnAssign = 0;
            }
            elseif($returnAssign > 1)
            {
                $stockError['returnAssign'] = "<br>Valeur non valide !";
            }
            
            if(!preg_match("/".REGEX_BIRTHDAY."/", $hwDate)){
                    $stockError['assignmentDate'] = "ERREUR Le format de la date du devoir est incorrect (Format : YYYY-MM-JJ)";
            }else{
                $save = explode("-", $hwDate);
                if(!checkdate($save[1], $save[2], $save[0])){
                    $stockError['assignmentDate'] = "ERREUR La date saisie n'existe pas";
                }
            }
            
            if(empty($stockError)){
                //Ajout dans la base
                $assign = new Assign("", $hwDate, $hwName, $returnAssign,$class, $id_users);
                $code = $assign->Add();
                
            }
        }
    }
    
}

//Préparation de l'affichage
$dataArray = Assign::SelectAllByTeacher($_SESSION['user']->id);
$classesArray = Classes::SelectAll();

//Inclusion des vues
include(dirname(__FILE__).'/../../view/pages/assignment.php');