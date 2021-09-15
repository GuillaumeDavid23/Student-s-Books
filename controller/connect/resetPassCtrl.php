<?php
session_start();

require_once(dirname(__FILE__).'/../../model/user.php');
require_once(dirname(__FILE__).'/../../public/config/config.php');

$stockError = [];
$token = "";
$code = null;

if(!empty($_GET['token'])){
    $token = $_GET['token'];
}

if(!empty($_GET['id'])){
    $id = $_GET['id'];
}


//Les données sont-elles envoyées ?
if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(!empty($_SESSION['token']) && !empty($token)){
        
        if($token == $_SESSION['token']){
            
            $ctrlPass = $_POST['inputCtrlPass'];
            $pass = $_POST['inputPass'];
            if(empty($pass)){
                $stockError['inputPass'] = 'Mot de passe vide !';
            }
            
            if(empty($ctrlPass)){
                $stockError['inputCtrlPass'] = 'Confirmation mot de passe vide !';
            }

            if($pass != $ctrlPass){
                $code = 12;
            }

            if(empty($stockError) && $code != 12){
                $dataUser = User::SelectOne($id);
                if(is_object($dataUser)){
                    $ctrlPass = password_hash($ctrlPass, PASSWORD_BCRYPT);
                    $users = new User($id,$dataUser->firstname, $dataUser->lastname, $dataUser->birthdate,$dataUser->mail,$ctrlPass,0);
                    $code = $users->Modify();
                    if($code = 3){
                        header("Location: /index.php?page=10");
                        exit;
                    }
                }else{
                    $code = 4;
                }
            }
        }
    }
    else{ //recherche de l'email et envoie du mail
        
        //Assignation des données dans des variables
        $mail = filter_input(INPUT_POST, 'resetMail', FILTER_SANITIZE_EMAIL);

        if(empty($_POST['resetMail']))
        {
            $stockError['mail'] = 'mail vide !';
        }
        elseif(!filter_var($mail, FILTER_VALIDATE_EMAIL))
        {
            $stockError['mail'] = "<br>ERREUR une donnée est invalide : Mail";
        }
        if(empty($stockError)){
            //On va checrher le tableau des utilisateurs
            $dataUser = User::SelectOneByMail($mail);
            if(is_object($dataUser)){
                $token = password_hash($mail, PASSWORD_BCRYPT);
                $_SESSION['token'] = $token;
                mail('guillaume.david744@orange.fr', 'Réinitialisation du mot de passe', "Voici votre token : http://studentbook.localhost/index.php?page=9&token=$token&id=".$dataUser->id); //mail a changer
            }
            $code = 5;
        }
    }
}
$title = "Reinitialisation du mot de passe";
$meta = "";
$head = "Reinitialisation du mot de passe";

include dirname(__FILE__).'/../../view/templates/header.php';
include dirname(__FILE__).'/../../view/connect/resetPass.php';
include dirname(__FILE__).'/../../view/templates/footer.php';



