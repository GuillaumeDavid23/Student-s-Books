<?php
    session_start();
    if(empty($_SESSION['rank'])){
        header('Location: controllers/connectCtrl.php');
    }
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
                    echo "YES";
                    $mail = $_SESSION['mail'];
                    $ctrlPass = password_hash($ctrlPass, PASSWORD_BCRYPT);
                    
                    while ($data = $stmt->fetch(PDO::FETCH_ASSOC)){
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
        if(!empty($_SESSION["rank"]) && $_SESSION["changePass"]){
            if($errorInForm){
                foreach ($stockError as $key => $value) { //boucle affichage ERROR
                    echo "<div class='error'>$value</div>";
                }
            }
            include "../views/changePass.php";
        } 
    ?>
    <!-- Bootstrap JavaScript -->
    <script src="../assets/js/bootstrap/bootstrap.js"></script>
</body>
</html>