<?php
//REGEX
session_start();
function passgen($nbChar){
    return substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCEFGHIJKLMNOPQRSTUVWXYZ0123456789!$?()'),1, $nbChar); 
}

//Déclaration des variables
$error = '';
$stockError = [];
$testForm = true;
$code =null;

//Connexion BDD
require_once(dirname(__FILE__).'/../../model/user.php');
 

$requiredInput = [
            'firstname' => true,
            'lastname' => true,
            'birthday' => true,
            'mail'=> true,
            'rank'=> true,
            'subject'=>false,
            'class'=>false
        ];

//Les données sont-elles envoyées ?
if($_SERVER['REQUEST_METHOD'] == "POST"){
    //Fonction de validation des données
    function valid_data($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    //Test des champs
    if(empty($_POST['firstname'])      
    || empty($_POST['lastname']) && $requiredInput['lastname'] == true
    || empty($_POST['birthday']) && $requiredInput['birthday'] == true
    || empty($_POST['mail']) && $requiredInput['mail'] == true
    || empty($_POST['rank']) && $requiredInput['rank'] == true
    || empty($_POST['subject']) && $requiredInput['subject'] == true
    || empty($_POST['class']) && $requiredInput['class'] == true
    ){
        //Affichage du formulaire si vide
        $testForm = true;
        $error = 'Un ou plusieurs champs obligatoires sont vides';
        $stockError['empty'] = $error;
    }
    elseif(empty($_POST['firstname']) 
    && empty($_POST['lastname']) 
    && empty($_POST['birthday'])
    && empty($_POST['mail']) 
    && empty($_POST['rank'])
    && empty($_POST['subject'])
        && empty($_POST['class'])           
    ){
        $testForm = true; //Affichage du formulaire si vide
        $error = 'Tout les champs sont vides';
        $stockError['empty'] = $error;
    }
    else{
            
        $testForm = false;//Affichage des données

        //Correction et validation de toutes les données
        foreach ($_POST as $key => $value) {
            $_POST[$key] = valid_data($value);
        }

        //Assignation des données dans des variables
        if(empty($_POST['firstname'])){
            $error = "<br>ERREUR Champs 'Rank' vide !";
            $stockError['firstname'] = $error;
            $testForm = true;//Affichage du formulaire si vide
        }else{
            $firstname = $_POST['firstname'];
        }

        if(empty($_POST['lastname'])){
            $error = "<br>ERREUR Champs 'Nom' vide !";
            $stockError['lastname'] = $error;
            $testForm = true;//Affichage du formulaire si vide
        }else{
            $lastname = $_POST['lastname'];
        }

        if(empty($_POST['birthday'])){
            $error = "<br>ERREUR Champs 'birthday' vide !";
            $stockError['birthday'] = $error;
            $testForm = true;//Affichage du formulaire si vide
        }else{
            $birthday = $_POST['birthday'];
        }

        if(empty($_POST['mail'])){
            $error = "<br>ERREUR Champs 'mail' vide !";
            $stockError['mail'] = $error;
            $testForm = true;//Affichage du formulaire si vide
        }else{
            $mail = $_POST['mail'];
        }

        if(empty($_POST['rank'])){
            $error = "<br>ERREUR Champs 'Rank' vide !";
            $stockError['rank'] = $error;
            $testForm = true;//Affichage du formulaire si vide
        }else{
            $rank = $_POST['rank'];
        }

        if($rank == "3"){
            if(empty($_POST['subject'])){
                $error = "<br>ERREUR Champs 'Matière' vide !";
                $stockError['subject'] = $error;
                $testForm = true;//Affichage du formulaire si vide
            }else{
                $matters = $_POST['subject'];
                $classes = null;
            }
        }
        elseif($rank == "1"){
            if(empty($_POST['class'])){
                $error = "<br>ERREUR Champs 'Classe' vide !";
                $stockError['class'] = $error;
                $testForm = true;//Affichage du formulaire si vide
            }else{
                $classes = $_POST['class'];
                $matters = null;
            }
        }
        else{
            $classes = null;
            $matters = null;
        }

        if(!$testForm){
            //Test regex avant de rentrer dans la BDD
            if(!preg_match("/".REGEX_NAME."/", $firstname)){
                $error = "ERREUR une donnée est invalide : Prénom";
                $stockError['firstname'] = $error;
                $testForm = true; //Affichage du formulaire si vide
            }

            if(!preg_match("/".REGEX_NAME."/", $lastname)){
                $error = "ERREUR une donnée est invalide : Nom";
                $stockError['lastname'] = $error;
                $testForm = true;//Affichage du formulaire si vide
            }

            if(!filter_input(INPUT_POST, 'mail', FILTER_VALIDATE_EMAIL)){
                $error = "ERREUR une donnée est invalide : Mail";
                $stockError['mail'] = $error;
                $testForm = true;//Affichage du formulaire si vide
            }

            if(!preg_match("/".REGEX_BIRTHDAY."/", $birthday)){
                $error = "ERREUR Le format de la date de naissance est incorrect (Format : YYYY-MM-JJ)";
                $stockError['birthday'] = $error;
                $testForm = true;//Affichage du formulaire si vide
            }else{
                $save = explode("-", $birthday);
                $year = $save[0];
                $month = $save[1];
                $day = $save[2];

                if(!checkdate($month, $day, $year)){
                    $error = "ERREUR La date saisie n'existe pas";
                    $stockError['birthday'] = $error;
                    $testForm = true; //Affichage du formulaire si vide
                }
            }
            if(!$testForm){
                $password = passgen(12);
                $savePass = $password;
                $password = password_hash($password, PASSWORD_BCRYPT);
                $changePass = 1;
                $statut = 1;

                $user = new User("",$firstname,$lastname,$birthday,$mail,$password,$changePass,$statut,$rank,$matters,$classes);
                $code = $user->add();
                if($code === 1){
                    mail('guillaume.david744@orange.fr', 'Première connexion', "$password && $mail");
                }
            }
        }
    }
}

$title = "Enregistrement d'un nouvel utilisateur";
$meta = "";
$head = "Inscription d'utilisateur";

include dirname(__FILE__).'/../../view/templates/header.php';
include dirname(__FILE__).'/../../view/user/register.php';
include dirname(__FILE__).'/../../view/templates/footer.php';

