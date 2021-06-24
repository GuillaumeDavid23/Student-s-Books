<?php
    session_start();
    $host = 'localhost';
    $dbname = 'studentbook';
    $username = 'root';
    $password = ''; 
    $connect = "mysql:host=$host;dbname=$dbname"; 

    // récupérer tous les utilisateurs
    $sql = "SELECT * FROM user";
    
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
        if(empty($_POST['password']) || empty($_POST['mail']))
        {
            //Affichage du formulaire si vide
            $errorInForm = true;
            $error = 'Un ou plusieurs champs obligatoires sont vides';
            $stockError['empty'] = $error;
        }
        elseif(empty($_POST['mail']) && empty($_POST['inputPass']))
        {
            //Affichage du formulaire si vide
            $errorInForm = true;
            $error = 'Tout les champs sont vides';
            $stockError['empty'] = $error;
        }
        else{
            //Affichage des données
            $errorInForm = false;

            //Correction et validation de toutes les données
            foreach ($_POST as $key => $value) {
                $_POST[$key] = valid_data($key,$value);
            }

            //Assignation des données dans des variables
            if(empty($_POST['mail'])){
                $mail = null;
            }else{
                $mail = $_POST['mail'];
            }
            if(!filter_input(INPUT_POST, 'mail', FILTER_VALIDATE_EMAIL) && !empty($mail)){
                    $error = "<br>ERREUR une donnée est invalide : Mail";
                    $stockError['mail'] = $error;
                    $errorInForm = true;
            }
        }
        while ($data = $sql->fetch()){
            if ($data['mail'] == $mail){
                echo 'connexion réussi';
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
        if($errorInForm){
            foreach ($_SESSION as $key => $value) { //boucle affichage ERROR
                echo "<div class='error'>$value</div>";
            }
        }
        include '../views/connect.php';
    ?>
    <!-- Bootstrap JavaScript -->
    <script src="../assets/js/bootstrap/bootstrap.js"></script>
</body>
</html>