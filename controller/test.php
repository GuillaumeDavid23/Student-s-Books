<?php 
session_start();
require_once(dirname(__FILE__).'/../model/user.php');
$user = User::SelectOne($_SESSION['user']->id);
$stockError = [];

$uploadDir = '../upload/users/';

if($_SERVER['REQUEST_METHOD'] == "POST"){

    if(isset($_FILES['fileselect']) && !empty($_FILES['fileselect']['name'])) {
    $tailleMax = 2000000;
    $extensionsValides = array('jpg', 'jpeg', 'png');

    if($_FILES['fileselect']['size'] <= $tailleMax) 
    {
        $extensionUpload = strtolower(substr(strrchr($_FILES['fileselect']['name'], '.'), 1));

        if(in_array($extensionUpload, $extensionsValides)) 
        {
            $uploadfile = $uploadDir . basename($_SESSION['user']->id.'.'.$extensionUpload);
            
            if(move_uploaded_file($_FILES['fileselect']['tmp_name'], $uploadfile)) 
            {
                $code = User::SetAvatar($_SESSION['user']->id, $extensionUpload);
                $_SESSION['user']->pic = $extensionUpload;
            } else {
                $stockError['avatar'] = "Erreur durant l'importation de votre photo de profil";
            }
        } else {
            $stockError['avatar'] = "Votre photo de profil doit être au format jpg, jpeg ou png";
        }
    } else {
        $stockError['avatar'] = "Votre photo de profil ne doit pas dépasser 2Mo";
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
    <title>test</title>
</head>
<body>
    <?= $stockError['avatar'] ?>
    <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
        <div>
            <label for="fileselect">Votre image :</label>
            <input type="file" id="fileselect" accept="image/*" name="fileselect" />
        </div>
        
        <button type="submit">Envoyer</button>
    </form>
    <div id="pic">
        <img src="/upload/users/<?= $_SESSION['user']->id.'.'.$_SESSION['user']->pic ?>" alt="">
    </div>
</body>
</html>