<?php
    session_start();
    if(!empty($_SESSION)){
        $_SESSION = [];
        session_destroy();
        session_start();
    }
    require_once(dirname(__FILE__).'/../model/model.php');
    $bdd = new BDD();
    //Déclaration des variables
    $error = '';
    $stockError = [];
    $errorInForm = true;
    $verifyMail = false;
    $verifyPass = false;
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
            echo("<script>alert('VRAI')</script>");
            $error = 'mail vide !';
            $stockError['mail'] = $error;
            $errorInForm = true;

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
            
            filter_input(INPUT_POST, 'inputMail', FILTER_SANITIZE_EMAIL);

            if(!filter_input(INPUT_POST, 'inputMail', FILTER_VALIDATE_EMAIL) && !empty($_POST['inputMail'])){
                    $error = "<br>ERREUR une donnée est invalide : Mail";
                    $stockError['mail'] = $error;
                    $errorInForm = true;
            }else{
                $mail = $_POST['inputMail'];
            }

            $password = $_POST['inputPass'];

            if(!$errorInForm){
                $pdo = $bdd->bddConnect();
                $sql = "SELECT * FROM users";
                $request = $pdo->query($sql);
                while ($data = $request->fetch(PDO::FETCH_ASSOC)){
                    if ($data['mail'] == $mail){
                        $verifyMail = true;
                    }
                    if(password_verify($password, $data["password"])){
                        $verifyPass = true;
                    }
                    if ($data['mail'] == $mail && password_verify($password, $data["password"])){
                        session_start();
                        $_SESSION["rank"] = $data['rank'];
                        $_SESSION["mail"] = $data['mail'];
                        $_SESSION["lastname"] = $data['lastname'];
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
                    elseif($verifyMail == false && $verifyPass == false ){
                        $error = "<br>Mail non trouvé";
                        $stockError['mail'] = $error;
                        $error = "<br>Le mot de passe ne correspond pas";
                        $stockError['password'] = $error;
                        $errorInForm = true;
                    }
                    elseif($verifyPass == false){
                        $error = "<br>Le mot de passe ne correspond pas";
                        $stockError['password'] = $error;
                        $errorInForm = true;
                    }
                    else{
                        $error = "<br>Mail non trouvé";
                        $stockError['mail'] = $error;
                        $errorInForm = true;
                    }
                }
            }
        }
    }

    if(empty($_SESSION["rank"])){
            require(dirname(__FILE__).'/../view/connect.php');
    }

