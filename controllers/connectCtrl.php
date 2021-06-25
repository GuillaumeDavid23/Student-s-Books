<?php
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
        }
        if(!$errorInForm){
            while ($data = $stmt->fetch(PDO::FETCH_ASSOC)){
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
                    }
                }
            }
        }
        
    }
    
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- FONTS -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../assets/css/bootstrap/bootstrap.css">
    <!-- CSS -->
    <link rel="stylesheet" href="../assets/css/general.css">
    <link rel="stylesheet" href="../assets/css/connect.css">
    <!-- META Description -->
    <meta name="description" content="Bienvenue sur Students'Books, c'est ici que commence la révolution scolaire.
     Emploi du temps/ devoirs/ absences... retrouver toutes les information scolaire içi">
    <!-- Titre du site -->
    <title>Connexion Student's Books : Les devoirs à la maison facilement</title>
</head>
<body>
    <?php
        
        if(empty($_SESSION["rank"])){
            if($errorInForm){
                foreach ($stockError as $key => $value) { //boucle affichage ERROR
                    echo "<div class='error'>$value</div>";
                }
            }
            include "../views/connect.php";
        }
    ?>
    <!-- Bootstrap JavaScript -->
    <script src="../assets/js/bootstrap/bootstrap.js"></script>
</body>
</html>