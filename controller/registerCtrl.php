<?php
    define("REGEX_NAME", "^[A-Za-z-éèàùëüöïäûîôâê]+$");
    session_start();
    function passgen($nbChar){
        return substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCEFGHIJKLMNOPQRSTUVWXYZ0123456789!$?()'),1, $nbChar); 
    }
    //Déclaration des variables
    $error = '';
    $stockError = [];
    $testForm = true;
    //REGEX
    $nameReg = "/^[A-Za-z-éèàùëüöïäûîôâê]+$/";
    $host = 'localhost';
    $dbname = 'studentbook';
    $username = 'root';
    $password = ''; 
    $connect = "mysql:host=$host;dbname=$dbname"; 

    // récupérer tous les utilisateurs
    $sql = "SELECT * FROM users";
    
    //CONNEXION A LA BDD
    try{
        $pdo = new PDO($connect, $username, $password);
        $stmt = $pdo->query($sql);
        if($stmt === false){  
            die("Erreur");
        }
    }
    catch (PDOException $e)
    {
        echo $e->getMessage();
    }
    
     //Fonction de validation des données
    function valid_data($index, $data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $requiredInput = [
                'firstname' => true,
                'lastname' => true,
                'birthday' => true,
                'mail'=> true,
                'rank'=> true,
            ];


    //Les données sont-elles envoyées ?
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        //Test des champs
        if(empty($_POST['firstname'])      
        || empty($_POST['lastname']) && $requiredInput['lastname'] == true
        || empty($_POST['birthday']) && $requiredInput['birthday'] == true
        || empty($_POST['mail']) && $requiredInput['mail'] == true
        || empty($_POST['rank']) && $requiredInput['rank'] == true
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
        ){
            $testForm = true; //Affichage du formulaire si vide
            $error = 'Tout les champs sont vides';
            $stockError['empty'] = $error;
        }
        else{
            
        $testForm = false;//Affichage des données

        //Correction et validation de toutes les données
        foreach ($_POST as $key => $value) {
            $_POST[$key] = valid_data($key,$value);
        }

        //Assignation des données dans des variables
        if(empty($_POST['firstname'])){
            
            $error = "<br>ERREUR Champs 'Rank' vide !";
            array_push($stockError, $error);
            $testForm = true;//Affichage du formulaire si vide
        }else{
            $firstname = $_POST['firstname'];
        }

        if(empty($_POST['lastname'])){
            $error = "<br>ERREUR Champs 'Nom' vide !";
            array_push($stockError, $error);
            $testForm = true;//Affichage du formulaire si vide
        }else{
            $lastname = $_POST['lastname'];
        }

        if(empty($_POST['birthday'])){
            $error = "<br>ERREUR Champs 'DA' vide !";
            array_push($stockError, $error);
            $testForm = true;//Affichage du formulaire si vide
        }else{
            $birthday = $_POST['birthday'];
        }

        if(empty($_POST['mail'])){
            $error = "<br>ERREUR Champs 'Rank' vide !";
            array_push($stockError, $error);
            $testForm = true;//Affichage du formulaire si vide
        }else{
            $mail = $_POST['mail'];
        }

        if(empty($_POST['rank'])){
            $error = "<br>ERREUR Champs 'Rank' vide !";
            array_push($stockError, $error);
            $testForm = true;//Affichage du formulaire si vide
        }else{
            $rank = $_POST['rank'];
        }

        //Test regex avant de rentrer dans la BDD
        if(!preg_match("/".REGEX_NAME."/", $firstname) && !empty($firstname)){
            $error = "<br>ERREUR une donnée est invalide : Prénom";
            array_push($stockError, $error);
            $testForm = true;//Affichage du formulaire si vide
        }

        if(!preg_match("/".REGEX_NAME."/", $lastname) && !empty($lastname)){
            $error = "<br>ERREUR une donnée est invalide : Nom";
            $stockError['lastname'] = $error;
            $testForm = true;//Affichage du formulaire si vide
        }

        if(!filter_input(INPUT_POST, 'mail', FILTER_VALIDATE_EMAIL) && !empty($mail)){
            $error = "<br>ERREUR une donnée est invalide : Mail";
            $stockError['mail'] = $error;
            $testForm = true;//Affichage du formulaire si vide
        }

        }
    }
    
    if($testForm){
        session_destroy();
        session_start();
        include '../view/register.php';
    }else{
        session_destroy();
        session_start();
        $password = passgen(12);
        mail('guillaume.david744@orange.fr', 'Première connexion', "$password && $mail");
        $password = password_hash($password, PASSWORD_BCRYPT);
        $sql = "INSERT INTO `users`(`mail`, `password`, `firstname`, `lastname`,`birthday`, `rank`, `changePass`) 
        VALUES('$mail', '$password','$firstname', '$lastname', '$birthday', '$rank', '1' )";
        $pdo->query($sql);
        // include '../view/profile.php';
        include '../view/register.php';
    }
?>