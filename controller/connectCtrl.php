<?php
//démarrage de la session
session_start();
//TEST de l'existance d'une ancienne session pour destruction
if(!empty($_SESSION)){
    $_SESSION = [];
    session_destroy();
    session_start();
}

//Inclusion des fichiers
require_once(dirname(__FILE__).'/../model/user.php');
require_once(dirname(__FILE__).'/../public/config/config.php');

//Déclaration des variables
$error = '';
$stockError = [];
$errorInForm = true;
$verifyMail = false;
$verifyPass = false;

//Les données sont-elles envoyées ?
if($_SERVER['REQUEST_METHOD'] == "POST"){
        //Fonction de validation des données
    function valid_data($index, $data)
    {
        if($index != "inputPass"){
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
        }
        $data = trim($data);
        return $data;
    }
    
    //Test des champs
    if(empty($_POST['inputMail']))
    {
        $error = 'mail vide !';
        $stockError['mail'] = $error;
        $errorInForm = true;

        if(empty($_POST['inputPass']))
        {
            $errorInForm = true;
            $error = 'Mot de passe vide !';
            $stockError['password'] = $error;
        }
    }
    elseif(empty($_POST['inputPass']))
    {
        //Affichage du formulaire si vide
        $errorInForm = true;
        $error = 'Mot de passe vide !';
        $stockError['password'] = $error;
        if(empty($_POST['inputMail'])){
            $errorInForm = true;
            $error = 'Mot de passe vide !';
            $stockError['password'] = $error;
        }
    }
    else
    {
        //Affichage des données
        $errorInForm = false;

        //Correction et validation de toutes les données
        foreach ($_POST as $key => $value) {
            $_POST[$key] = valid_data($key,$value);
        }

        //Assignation des données dans des variables
        filter_input(INPUT_POST, 'inputMail', FILTER_SANITIZE_EMAIL);

        if(!filter_input(INPUT_POST, 'inputMail', FILTER_VALIDATE_EMAIL) && !empty($_POST['inputMail'])){
                $error = "<br>ERREUR une donnée est invalide : Mail";
                $stockError['mail'] = $error;
                $errorInForm = true;
        }else{
            $mail = $_POST['inputMail'];
        }

        $password = $_POST['inputPass'];

        if(!$errorInForm){
            $dataArray = User::SelectAll();
            
            foreach ($dataArray as $data){
                if ($data['mail'] == $mail){
                    $verifyMail = true;
                }else{
                    $verifyMail = false;
                }
                if(password_verify($password, $data["password"])){
                    $verifyPass = true;
                }else{
                    $verifyPass = false;
                }

                if ($verifyMail && $verifyPass){
                    $_SESSION['derniere_action'] = time(); // mise à jour de la variable
                    $_SESSION["id"] = $data['id'];
                    $_SESSION["mail"] = $data['mail'];
                    $_SESSION["lastname"] = $data['lastname'];
                    $_SESSION["firstname"] = $data['firstname'];
                    $_SESSION["birthdate"] = $data['birthdate'];
                    $_SESSION["password"] = $data['password'];
                    $_SESSION["rank"] = $data['id_ranks'];
                    $_SESSION["subject"] = $data['id_matters']; //CONDITION A FAIRE
                    $_SESSION["classes"] = $data['id_classes'];//CONDITION A FAIRE
                    if ($data['changePass']){
                        $_SESSION['changePass'] = $data['changePass'];
                        header("Location: passCtrl.php");
                        exit;
                    }
                    else{
                        header("Location: ../index.php");
                        exit;
                    }
                }
                else{
                    $error = "<br>Mail ou mot de passe incorrect !";
                    $stockError['mail'] = $error;
                    $errorInForm = true;
                }
            }
        }
    }
}

if(empty($_SESSION["rank"])){
        $title = "Page de connexion : Students'Books";
        $meta = "";
        $head = "Connexion";
        include dirname(__FILE__).'/../view/templates/header.php';
        include dirname(__FILE__).'/../view/connect.php';
        include dirname(__FILE__).'/../view/templates/footer.php';
}

