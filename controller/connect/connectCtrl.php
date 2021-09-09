<?php
session_start();
if(!empty($_SESSION['user'])){
    unset($_SESSION['user']);
}

//Inclusion des fichiers
require_once(dirname(__FILE__).'/../../model/user.php');
require_once(dirname(__FILE__).'/../../public/config/config.php');

//Déclaration des variables
$stockError = [];
$errorInForm = false;
$verifyPass = false;
$code = null;

//Les données sont-elles envoyées ?
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    //Correction et validation de toutes les données
    $mail = strtolower(strip_tags(trim(filter_input(INPUT_POST, 'inputMail', FILTER_SANITIZE_EMAIL))));
    $password = $_POST['inputPass'];
    //Si les deux champs sont vides
    if(empty($password) || empty($mail))
    {
        //Affichage du formulaire si vide
        $errorInForm = true;
        $stockError['password'] = 'Mot de passe vide !';
        $stockError['mail'] = 'mail vide !';
    }
    //Si mail est vide
    elseif(empty($mail))
    {
        $stockError['mail'] = 'mail vide !';
        $errorInForm = true;
    }
    //Si password est vide
    elseif(empty($password))
    {
        //Affichage du formulaire si vide
        $errorInForm = true;
        $stockError['password'] = 'Mot de passe vide !';
    }
    else
    {
        //On valide le format de l'email
        if(!filter_var($mail, FILTER_VALIDATE_EMAIL)){
                $stockError['mail'] = "<br>L'email n'est pas au bon format";
                $errorInForm = true;
        }

        if(!$errorInForm){
            $user = User::SelectOneByMail($mail);
            if(is_object($user)){
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
//<script>alert('COUCOU')</script>

//Affichage de la vue
$title = 'Page de connexion : Students\'Books';
$meta = '';
$head = 'Connexion';
include dirname(__FILE__).'/../../view/templates/header.php';
include dirname(__FILE__).'/../../view/connect/connect.php';
include dirname(__FILE__).'/../../view/templates/footer.php';