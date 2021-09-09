<?php
session_start();

require_once(dirname(__FILE__).'/../model/user.php');
require_once(dirname(__FILE__).'/../public/config/config.php');

$error = '';
$stockError = [];
$errorInForm = true;
$verifyMail = false;
$verifyPass = false;
$token = "";
$code = null;

if(!empty($_GET['token'])){
    $token = $_GET['token'];
}


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

    if(!empty($_SESSION['token']) && !empty($token)){
        if($token == $_SESSION['token']){
            $dataArray = User::SelectAll();
            foreach ($dataArray as $data) {
                if(password_verify($data['mail'],$token)){
                    $errorInForm = false;
                    foreach ($_POST as $key => $value) {
                        $_POST[$key] = valid_data($key,$value);
                    }

                    if(!empty($_POST['inputPass'])){
                        $pass = $_POST['inputPass'];
                    }else{
                        $error = 'Mot de passe vide !';
                        $stockError['inputPass'] = $error;
                        $errorInForm = true;
                    }
                    

                    if(!empty($_POST['inputCtrlPass'])){
                        $ctrlPass = $_POST['inputCtrlPass'];
                    }else{
                        $error = 'Confirmation mot de passe vide !';
                        $stockError['inputCtrlPass'] = $error;
                        $errorInForm = true;
                    }
                    if(!$errorInForm){
                        
                        if($pass == $ctrlPass){
                            $changePass = 0;
                            $ctrlPass = password_hash($ctrlPass, PASSWORD_BCRYPT);
                            $users = new User($data['id'],$data['firstname'], $data['lastname'], $data['birthdate'],$data['mail'],$ctrlPass,$changePass,"","","","",null);
                            $code = $users->Modify();
                            
                            if($code = 3){
                                header("Location: /index.php?page=10");
                                exit;
                            }
                        }
                    }
                }
            }
        }
    }
    else{
        //Test des champs
        if(empty($_POST['resetMail']))
        {
            $error = 'mail vide !';
            $stockError['mail'] = $error;
            $errorInForm = true;
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
            $mail = filter_input(INPUT_POST, 'resetMail', FILTER_SANITIZE_EMAIL);
            $mail = filter_var($mail, FILTER_VALIDATE_EMAIL);
            
            if(!$mail){
                    $error = "<br>ERREUR une donnée est invalide : Mail";
                    $stockError['mail'] = $error;
                    $errorInForm = true;
            }
            if(!$errorInForm){
                //On va checrher le tableau des utilisateurs
                $dataArray = User::SelectAll();
                $verifyMail = false;

                foreach ($dataArray as $data){
                    if(!$verifyMail){
                        var_dump($verifyMail);
                        if ($data['mail'] == $mail){
                            $verifyMail = true;
                        }else{
                            $verifyMail = false;
                        }
                        
                        if ($verifyMail){
                            $token = password_hash($mail, PASSWORD_BCRYPT);
                            $_SESSION['token'] = $token;
                            mail('guillaume.david744@orange.fr', 'Réinitialisation du mot de passe', "Voici votre token : http://studentbook.localhost/controller/resetPassCtrl.php?token=$token"); //mail a changer
                            $code = 5;
                            break;
                        }
                    }
                }
                if(!$verifyMail){
                    $error = "<br>Aucun utilisateur reconnus";
                    $stockError['mail'] = $error;
                    $errorInForm = true;
                }
            }
        }
    }

    
}
$title = "Reinitialisation du mot de passe";
$meta = "";
$head = "Reinitialisation du mot de passe";

include dirname(__FILE__).'/../view/templates/header.php';
include dirname(__FILE__).'/../view/connect/resetPass.php';
include dirname(__FILE__).'/../view/templates/footer.php';



