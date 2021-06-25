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
    
    }catch (PDOException $e){
    echo $e->getMessage();
    }
    
    

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/register.css">
    <title>Vous êtes connecté !</title>
</head>
<body>
        <h1>Vous êtes connecté :</h1>
        <?php while($row = $stmt->fetch()) : ?>
        <div class="info">
            <h1>Bonjour <?=$row['firstname'].' '.$row['lastname']?></h1>
            <div class="list">
                <strong>Votre date de naissance est :</strong>  <?=$row['birthday']?> <br>
                <strong>Votre e-mail :</strong>  <?=$row['mail']?> <br>
                <strong>Votre  :</strong>  <?=$row['mail']?> <br>
            </div>
        </div>
        <?php endwhile; ?>
</body>
</html>