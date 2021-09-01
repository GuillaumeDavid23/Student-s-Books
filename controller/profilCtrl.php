<?php 
    session_start();    
    if(empty($_SESSION['rank'])){
        header('Location: ../controller/connectCtrl.php');
    }
    
    require_once(dirname(__FILE__).'/../model/bdd.php');
    require_once(dirname(__FILE__).'/../model/user.php');
    require_once(dirname(__FILE__).'/../public/config/config.php');
    
    //Déclaration des variables
    $users = new User($_SESSION['id']);
    $user = $users->SelectOne();

    $users = new User($user->id_matters);
    $matter = $users->SelectOne('matters');

    $users = new User($user->id_ranks);
    $rank = $users->SelectOne('ranks');

    $error = '';
    $stockError = [];
    $errorInForm = true;
    $code = null;


    if($_SERVER['REQUEST_METHOD'] == "POST"){
        //Fonction de validation des données
        function valid_data($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        //Correction et validation de toutes les données
            foreach ($_POST as $key => $value) {
                $_POST[$key] = valid_data($value);
            }
            if(!empty($_POST['pass'])){
                $firstPass = $_POST['pass'];
            }else{
                $error = "<br>ERREUR une donnée est vide : Nouveau mot de passe";
                    $stockError['pass'] = $error;
                    $errorInForm = true;
            }

            if(!empty($_POST['checkPass'])){
                $ctrlPass = $_POST['checkPass'];
            }else{
                $error = "<br>ERREUR une donnée est vide : Confirmation du mot de passe";
                $stockError['checkPass'] = $error;
                $errorInForm = true;
            }
            if (!empty($firstPass) && !empty($ctrlPass)){
                if($firstPass == $ctrlPass){
                    //MOT DE PASSE OK
                    $mail = $_SESSION['mail'];
                    $ctrlPass = password_hash($ctrlPass, PASSWORD_BCRYPT);
                    $_SESSION['password'] = $ctrlPass; 
                    $users = new User();
                    $dataArray = $users->SelectAll();
                    
                    foreach ($dataArray as $data)
                    {
                        if ($data['id'] == $_SESSION["id"]){
                            $changePass = 0;
                            $id = $_SESSION['id'];
                            $mail = $_SESSION['mail'];
                            $users = new User($id,$_SESSION['firstname'], $_SESSION['lastname'], $_SESSION['birthdate'],$mail,$ctrlPass,$changePass);
                            $code = $users->Modify();
                            $_SESSION["password"] = $ctrlPass;
                            $_SESSION['changePass'] = $changePass;
                        }
                        else{
                            //une erreur est survenue reconnexion demandée
                            header("Location: /controller/connectCtrl.php");
                            exit;
                        }
                    }
                }
            }   
            
    }
include dirname(__FILE__).'/../view/templates/header.php';
include dirname(__FILE__)."/../view/profile.php";
include dirname(__FILE__).'/../view/templates/footer.php';
