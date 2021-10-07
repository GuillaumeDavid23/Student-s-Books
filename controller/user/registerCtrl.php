<?php
//Démarrage de la session
  
if($_SESSION['user']->id_ranks != 4){
    header('Location: /index.php');
    exit;
}
//Déclaration des variables
$stockError = [];
$code =null;

//Inclusion des modèles
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
    //Test des champs
    if(empty($_POST['firstname'])      
    || empty($_POST['lastname']) && $requiredInput['lastname'] == true
    || empty($_POST['birthday']) && $requiredInput['birthday'] == true
    || empty($_POST['mail']) && $requiredInput['mail'] == true
    || empty($_POST['rank']) && $requiredInput['rank'] == true
    || empty($_POST['subject']) && $requiredInput['subject'] == true
    || empty($_POST['class']) && $requiredInput['class'] == true
    ){
        $stockError['empty'] = 'Un ou plusieurs champs obligatoires sont vides';
    }
    else{
        $firstname = ucfirst(strtolower(strip_tags(trim(filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING)))));
        $lastname = ucfirst(strtolower(strip_tags(trim(filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING)))));
        $birthday = strtolower(strip_tags(trim(filter_input(INPUT_POST, 'birthday', FILTER_SANITIZE_STRING))));
        $mail = strtolower(strip_tags(trim(filter_input(INPUT_POST, 'mail', FILTER_SANITIZE_EMAIL))));
        $rank = strtolower(strip_tags(trim(filter_input(INPUT_POST, 'rank', FILTER_SANITIZE_NUMBER_INT))));
        $matters = strtolower(strip_tags(trim(filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_NUMBER_INT))));
        $classes = strtolower(strip_tags(trim(filter_input(INPUT_POST, 'class', FILTER_SANITIZE_NUMBER_INT))));

        //Assignation des données dans des variables
        if(empty($firstname)){
            $stockError['firstname'] = "<br>ERREUR Champs 'Rank' vide !";
        }

        if(empty($lastname)){
            $stockError['lastname'] = "<br>ERREUR Champs 'Nom' vide !";
        }

        if(empty($birthday)){
            $stockError['birthday'] = "<br>ERREUR Champs 'birthday' vide !";
        }

        if(empty($mail)){
            $stockError['mail'] = "<br>ERREUR Champs 'mail' vide !";
        }

        if(empty($rank)){
            $stockError['rank'] = "<br>ERREUR Champs 'Rank' vide !";
        }

        if($rank == "3"){
            if(empty($matters)){
                $stockError['subject'] = "<br>ERREUR Champs 'Matière' vide !";
            }else{
                $classes = null;
            }
        }
        elseif($rank == "1"){
            if(empty($classes)){
                $stockError['class'] = "<br>ERREUR Champs 'Classe' vide !";
            }else{
                $matters = null;
            }
        }
        else{
            $classes = null;
            $matters = null;
        }

        if(empty($stockError)){
            //Test regex avant de rentrer dans la BDD
            if(!preg_match("/".REGEX_NAME."/", $firstname)){
                $stockError['firstname'] = "ERREUR une donnée est invalide : Prénom";
            }

            if(!preg_match("/".REGEX_NAME."/", $lastname)){
                $stockError['lastname'] = "ERREUR une donnée est invalide : Nom";
            }

            if(!filter_input(INPUT_POST, 'mail', FILTER_VALIDATE_EMAIL)){
                $stockError['mail'] = "ERREUR une donnée est invalide : Mail";
            }

            if(!preg_match("/".REGEX_BIRTHDAY."/", $birthday)){
                $stockError['birthday'] = "ERREUR Le format de la date de naissance est incorrect (Format : YYYY-MM-JJ)";
            }else{
                $save = explode("-", $birthday);
                $year = $save[0];
                $month = $save[1];
                $day = $save[2];

                if(!checkdate($month, $day, $year)){
                    $stockError['birthday'] = "ERREUR La date saisie n'existe pas";
                }
            }
            if(empty($stockError)){
                $password = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCEFGHIJKLMNOPQRSTUVWXYZ0123456789!$?()@'),1, 12);;
                $passwordHash = password_hash($password, PASSWORD_BCRYPT);
                $user = new User("",$firstname,$lastname,$birthday,$mail,$passwordHash,1,1,$rank,$matters,$classes);
                $code = $user->add();
                if($code === 1){
                    //--- Quelques Variables ---// 
                    $destinataire = $mail;
                    $sujet = 'Votre compte Student\'s Book\'s';
                    $expediteur = 'contact@studentsbooks.fr';

                    //--- La Structure Du Mail ----// 
                    $headers  = "From:".$expediteur."\n";
                    $headers .= "MIME-version: 1.0\n";
                    $headers .= "Content-type: text/html; charset=utf-8\n";

                    //--- Le Message ---// 
                    $message = "
                    <h1>Bonjour $firstname $lastname</h1>
                    <br>
                    Ce mail est automatique et vous informe de la création de votre compte sur le site Student's Book's.
                    <br/>
                    <br/>
                    <h3>Vos identifiants de connexion :</h3>
                    <strong>Votre email : </strong>".stripslashes(htmlentities($mail))."\n
                    <strong>Votre mot de passe : </strong>".stripslashes(htmlentities($password))."
                    <br/>
                    <br/>
                    Pour vous connecter rendez-vous sur : <a href='http://studentbook.localhost/'>Student's Book's</a>
                    <br/>
                    <span style=\"text-align: right;\">Cordialement, <em> Le webmaster</em></span>";

                    //--- Et c'est parti pour l'envoi ---// 
                    mail($destinataire,$sujet,$message,$headers);
                    mail('guillaume.david744@orange.fr',$sujet,$message,$headers);
                }
            }
        }
    }
}
include dirname(__FILE__).'/../../view/user/register.php';