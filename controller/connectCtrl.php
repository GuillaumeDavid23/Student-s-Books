<?php
    session_start();
    if(!empty($_SESSION)){
        $_SESSION = [];
        session_destroy();
        
        session_start();
    }

    require('../models/model.php');

    //Déclaration des variables
    $error = '';
    $stockError = [];
    $errorInForm = true;

    
     //Fonction de validation des données
    function valid_data($index, $data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    //Les données sont-elles envoyées ?
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        //Test des champs
        if(empty($_POST['inputMail'])){
            $errorInForm = true;
            $error = 'mail vide !';
            $stockError['mail'] = $error;
            if(empty($_POST['inputPass'])){
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
        else{
            //Affichage des données
            $errorInForm = false;

            //Correction et validation de toutes les données
            foreach ($_POST as $key => $value) {
                $_POST[$key] = valid_data($key,$value);
            }

            //Assignation des données dans des variables
            if(empty($_POST['inputMail'])){
                $mail = '';
            }else{
                $mail = $_POST['inputMail'];
            }
            if(empty($_POST['inputPass'])){
                $password = '';
            }else{
                $password = $_POST['inputPass'];
            }

            if(!filter_input(INPUT_POST, 'inputMail', FILTER_VALIDATE_EMAIL) && !empty($mail)){
                    $error = "<br>ERREUR une donnée est invalide : Mail";
                    $stockError['mail'] = $error;
                    $errorInForm = true;
            }

            if(!$errorInForm){
                $bdd = bddConnect();
                while ($data = $bdd->fetch(PDO::FETCH_ASSOC)){
                    if ($data['mail'] == $mail && password_verify($password, $data["password"])){
                        session_start();
                        $_SESSION["rank"] = $data['rank'];
                        $_SESSION["mail"] = $data['mail'];
                        $_SESSION["password"] = $data['password'];
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
                }
            }
        }
    }

    if(empty($_SESSION["rank"])){
            if($errorInForm){
                foreach ($stockError as $key => $value) { //boucle affichage ERROR
                    echo "<div class='error'>$value</div>";
                }
            }
            require("../views/connect.php");
    }

