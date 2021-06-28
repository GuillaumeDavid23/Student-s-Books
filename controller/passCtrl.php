<?php
    session_start();
    if(empty($_SESSION['rank'])){
        header('Location: controller/connectCtrl.php');
    }
    require('../model/model.php');

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
        //Correction et validation de toutes les données
            foreach ($_POST as $key => $value) {
                $_POST[$key] = valid_data($key,$value);
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
                    $bdd = bddConnect();
                    while ($data = $bdd->fetch(PDO::FETCH_ASSOC)){
                        if ($data['mail'] == $_SESSION["mail"]){
                            $sql = "UPDATE users SET changePass = '0', password = '$ctrlPass' WHERE mail = '$mail' ";
                            $pdo->query($sql);
                            $_SESSION["password"] = $ctrlPass;
                            $_SESSION['changePass'] = $data['changePass'];
                            var_dump($_SESSION);
                        }
                    }
                }
                else{
                    echo "NO";
                }
            }   
            
    }
    if(!empty($_SESSION["rank"]) && $_SESSION["changePass"]){
            if($errorInForm){
                foreach ($stockError as $key => $value) { //boucle affichage ERROR
                    echo "<div class='error'>$value</div>";
                }
            }
            require("../view/changePass.php");
    } 
