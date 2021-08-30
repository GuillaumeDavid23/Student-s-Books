<?php 
    define("REGEX_BIRTHDAY", "^([12]\d{3}[-](0[1-9]|1[0-2])[-](0[1-9]|[12]\d|3[01]))$");
    session_start();
    // var_dump($_SESSION);
    if(empty($_SESSION['rank'])){
        header('Location: ../controller/connectCtrl.php');
        exit();
    }else{
        $rank = $_SESSION['rank'];
        $id_users = $_SESSION['id'];
    }
    
    //Connexion BDD
    require_once(dirname(__FILE__).'/../model/bdd.php');
    require_once(dirname(__FILE__).'/../model/user.php');
    require_once(dirname(__FILE__).'/../model/assignements.php');
    require_once(dirname(__FILE__).'/../public/config/config.php');

    $assign = new Assign();
    $title = 'Page des devoirs : voir ou rendre un devoir';
    $meta = '';

    //Variables
    $testForm = false;
    //Fonction de validation des données
    function valid_data($index, $data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        foreach ($_POST as $key => $value) {
            $_POST[$key] = valid_data($key,$value);
        }

        if(empty($_POST['assignmentDate'])){
            $error = "<br>ERREUR Champs 'assignmentDate' vide !";
            $stockError['assignmentDate'] = $error;
            $testForm = true;//Affichage du formulaire si vide
        }else{
            $hwDate = $_POST['assignmentDate'];
        }

        if(empty($_POST['assignmentName'])){
            $error = "<br>ERREUR Champs 'assignmentName' vide !";
            $stockError['assignmentName'] = $error;
            $testForm = true;//Affichage du formulaire si vide
        }else{
            $hwName = $_POST['assignmentName'];
        }

        if(empty($_SESSION['subject'])){
            $error = "<br>ERREUR Votre matière de professeur n'est pas renseigné !";
            $stockError['subject'] = $error;
            $testForm = true;//Affichage du formulaire si vide
        }else{
            $subject = $_SESSION['subject'];
        }

        if(empty($_POST['class'])){
            $error = "<br>ERREUR Classe non renseigné!";
            $stockError['class'] = $error;
            $testForm = true;//Affichage du formulaire si vide
        }else{
            $class = $_POST['class'];
        }

        if(!preg_match("/".REGEX_BIRTHDAY."/", $hwDate)){
                $error = "ERREUR Le format de la date du devoir est incorrect (Format : YYYY-MM-JJ)";
                $stockError['assignmentDate'] = $error;
                $testForm = true;//Affichage du formulaire si vide
        }else{
            $save = explode("-", $hwDate);
            $year = $save[0];
            $month = $save[1];
            $day = $save[2];

            if(!checkdate($month, $day, $year)){
                $error = "ERREUR La date saisie n'existe pas";
                $stockError['assignmentDate'] = $error;
                $testForm = true;//Affichage du formulaire si vide
            }
        }

        if(!$testForm){
            
            $assign = new Assign("", $hwDate, $hwName, $class, $id_users);
            $code = $assign->Add();
            header('Refresh:0');
        }
    }
    $dataArray = $assign->SelectAll();

    include dirname(__FILE__).'/../view/templates/header.php';
    include(dirname(__FILE__).'/../view/assignment.php');
    include dirname(__FILE__).'/../view/templates/footer.php';