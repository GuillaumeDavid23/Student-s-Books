<?php
session_start();
if(!empty($_SESSION['user'])){
    unset($_SESSION['user']);
}

//Inclusion des fichiers
require_once(dirname(__FILE__).'/../../model/user.php');
 

//Déclaration des variables
$stockError = [];
$errorInForm = false;
$verifyPass = false;
$code = null;
if(!empty($_GET['code'])){
    $code = intval(trim(filter_input(INPUT_GET, 'code', FILTER_SANITIZE_NUMBER_INT)));
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){ //Les données sont-elles envoyées ?
    //Attribtion et validation de toutes les données
    $mail = strtolower(strip_tags(trim(filter_input(INPUT_POST, 'inputMail', FILTER_SANITIZE_EMAIL))));
    $password = $_POST['inputPass'];
    
    if(empty($password) || empty($mail)) //Si les deux champs sont vides
    {
        $stockError['password'] = 'Mot de passe vide !';
        $stockError['mail'] = 'Email vide !';
    }
    elseif(empty($mail))//Si mail est vide
    {
        $stockError['mail'] = 'mail vide !';
    }
    elseif(empty($password))//Si password est vide
    {
        $stockError['password'] = 'Mot de passe vide !';
    }
    else
    {
        if(!filter_var($mail, FILTER_VALIDATE_EMAIL)){ //On valide le format de l'email
            $stockError['mail'] = "<br>L'email n'est pas au bon format";
        }

        if(empty($stockError)){
            $user = User::SelectOneByMail($mail);
            if(is_object($user)){
                if($user->statut != 0){
                    if (password_verify($password, $user->password)){
                        $_SESSION['derniere_action'] = time(); // mise à jour de la variable de dernière action
                        $_SESSION['user'] = $user;
                        if($_SESSION['user']->changePass){
                            header("Location: /index.php?page=6");
                            exit;
                        }
                        else{
                            header("Location: /index.php");
                            exit;
                        }
                    }
                }else{
                    $code = 15;
                }
                
            }
            else
            {   
                //Utilisateur non trouvé
                $code = 13;
                $stockError['mail'] = "";
                $stockError['password'] = "";
                $errorInForm = true;
            }
        }
    }
}

//Affichage de la vue
$title = 'Page de connexion : Students\'Books';
$meta = '';
$head = 'Connexion';
include dirname(__FILE__).'/../../view/templates/header.php';
include dirname(__FILE__).'/../../view/connect/connect.php';
include dirname(__FILE__).'/../../view/templates/footer.php';