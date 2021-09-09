<?php
require_once(dirname(__FILE__).'/../session/sessionCtrl.php');
require_once(dirname(__FILE__).'/../../model/user.php');
require_once(dirname(__FILE__).'/../../public/config/config.php');

//Déclaration des variables
$stockError = [];
$errorInForm = false;    

//Les données sont-elles envoyées ?
if($_SERVER['REQUEST_METHOD'] == "POST"){
    //Correction et validation de toutes les données
    $firstPass = trim(htmlspecialchars(filter_input(INPUT_POST, 'inputPass', FILTER_SANITIZE_STRING)));
    $ctrlPass = trim(htmlspecialchars(filter_input(INPUT_POST, 'inputCtrlPass', FILTER_SANITIZE_STRING)));

    if(empty($firstPass)){ //Contrôle de l'input
        $stockError['inputPass'] = "<br>ERREUR une donnée est vide : Nouveau mot de passe";
        $errorInForm = true;
    }
    elseif(empty($ctrlPass)){
        $stockError['inputCtrlPass'] = "<br>ERREUR une donnée est vide : Confirmation du mot de passe";
        $errorInForm = true;
    }
    elseif($firstPass != $ctrlPass){
        $stockError['different'] = "<br>ERREUR les mots de passes ne sont pas identiques";
        $errorInForm = true;
    }

    if (!$errorInForm){ //MOT DE PASSE OK
        $ctrlPass = password_hash($ctrlPass, PASSWORD_BCRYPT);
        $users = new User($_SESSION['user']->id, $_SESSION['user']->firstname, $_SESSION['user']->lastname, $_SESSION['user']->birthdate, $_SESSION['user']->mail, $ctrlPass, 0);
        $code = $users->Modify();

        $_SESSION["user"]->password = $ctrlPass;
        $_SESSION['user']->changePass = 0;

        header('Location: /index.php');
        exit;
    }   
}


$title = "Changement du mot de passe Students'Books";
$meta = "";
$head = "Changer votre mot de passe";

include dirname(__FILE__).'/../../view/templates/header.php';
include(dirname(__FILE__).'/../../view/connect/changePass.php');
include dirname(__FILE__).'/../../view/templates/footer.php';

