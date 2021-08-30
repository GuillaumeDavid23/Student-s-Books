<?php
    session_start();
    if(empty($_SESSION['rank'])){
        header('Location: connectCtrl.php');
    }
    require(dirname(__FILE__).'/../model/model.php');

    require_once(dirname(__FILE__).'/../model/bdd.php');
    require_once(dirname(__FILE__).'/../model/user.php');
    require_once(dirname(__FILE__).'/../public/config/config.php');

    //Déclaration des variables
    $error = '';
    $stockError = [];
    $errorInForm = true;
     //Fonction de validation des données
    function valid_data($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    //Les données sont-elles envoyées ?
    
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        //Correction et validation de toutes les données
            foreach ($_POST as $key => $value) {
                $_POST[$key] = valid_data($value);
            }
            if(!empty($_POST['inputPass'])){
                $firstPass = $_POST['inputPass'];
            }else{
                $error = "<br>ERREUR une donnée est vide : Nouveau mot de passe";
                    $stockError['inputPass'] = $error;
                    $errorInForm = true;
            }

            if(!empty($_POST['inputCtrlPass'])){
                $ctrlPass = $_POST['inputCtrlPass'];
            }else{
                $error = "<br>ERREUR une donnée est vide : Confirmation du mot de passe";
                $stockError['inputCtrlPass'] = $error;
                $errorInForm = true;
            }
            if (!empty($firstPass) && !empty($ctrlPass)){
                if($firstPass == $ctrlPass){
                    //MOT DE PASSE OK
                    $mail = $_SESSION['mail'];
                    $ctrlPass = password_hash($ctrlPass, PASSWORD_BCRYPT);
                    $users = new User();
                    $dataArray = $users->SelectAll();
                    
                    foreach ($dataArray as $data)
                    {
                        if ($data['id'] == $_SESSION["id"]){
                            $changePass = 0;
                            $id = $_SESSION['id'];
                            $mail = $_SESSION['mail'];
                            $users = new User($id,$_SESSION['firstname'], $_SESSION['lastname'], $_SESSION['birthdate'],$mail,$ctrlPass,$changePass);
                            $test = $users->Modify();
                            $_SESSION["password"] = $ctrlPass;
                            $_SESSION['changePass'] = $changePass;
                            header('Location: /index.php');
                            exit;
                        }
                    }
                }
            }   
            
    }
    if(!empty($_SESSION["rank"]) && $_SESSION["changePass"]){
            if($errorInForm){
                foreach ($stockError as $key => $value) { //boucle affichage ERROR
                    echo "<div class='error'>$value</div>";
                }
            }
            include dirname(__FILE__).'/../view/templates/header.php';
            include(dirname(__FILE__).'/../view/changePass.php');
            include dirname(__FILE__).'/../view/templates/footer.php';

    } 
