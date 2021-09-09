<?php 
    session_start();    
    if(empty($_SESSION['user'])){
        header('Location: /index.php?page=10');
        exit;
    }
    
    require_once(dirname(__FILE__).'/../../model/user.php');
    require_once(dirname(__FILE__).'/../../model/matters.php');
    require_once(dirname(__FILE__).'/../../model/ranks.php');
    require_once(dirname(__FILE__).'/../../public/config/config.php');
    
    //Déclaration des variables
    $user = User::SelectOne($_SESSION['user']->id);

    $matter = Matter::SelectOne($user->id_matters);

    $rank = Rank::SelectOne($user->id_ranks);

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
                    $dataArray = User::SelectAll();
                    
                    foreach ($dataArray as $data)
                    {   
                        if ($data['id'] == $_SESSION["id"]){
                            $changePass = 0;
                            $id = $_SESSION['user']->id;
                            $mail = $_SESSION['mail'];
                            $users = new User($id,$_SESSION['user']->firstname, $_SESSION['user']->lastname, $_SESSION['user']->birthdate,$mail,$ctrlPass,$changePass);
                            $code = $users->Modify();
                            $_SESSION["password"] = $ctrlPass;
                            $_SESSION['changePass'] = $changePass;
                            if($code == 3){
                                break;
                            }else{
                                header('Location: /index.php?page=10');
                                exit;
                            }
                        }
                    }
                }else{
                    $code = 12;
                    $errorInForm = true;
                }
            }   
            
    }
$title = "Profil Students'Books";
$meta = "";
$head = "Votre profil";

include dirname(__FILE__).'/../../view/templates/header.php';
include dirname(__FILE__)."/../../view/user/profile.php";
include dirname(__FILE__).'/../../view/templates/footer.php';
