<?php 
session_start();    
if(empty($_SESSION['user'])){
    header('Location: /index.php?page=10');
    exit;
}

require_once(dirname(__FILE__).'/../../model/user.php');
require_once(dirname(__FILE__).'/../../model/matters.php');
require_once(dirname(__FILE__).'/../../model/classes.php');
require_once(dirname(__FILE__).'/../../model/ranks.php');
 

//Déclaration des variables
$user = User::SelectOne($_SESSION['user']->id);
$matter = Matter::SelectOne($user->id_matters);
$classes = Classes::SelectOne($user->id_classes);
$rank = Rank::SelectOne($user->id_ranks);

$error = '';
$stockError = [];
$errorInForm = true;
$code = null;
$uploadDir = 'uploads/users/';

if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(isset($_FILES['fileselect']) && !empty($_FILES['fileselect']['name'])) {
        if($_FILES['fileselect']['size'] <= LIMIT_SIZE) 
        {
            $mime = mime_content_type($_FILES['fileselect']['tmp_name']);
            if(in_array($mime, SUPPORTED_FORMAT)) 
            {
                list($width, $height) = getImageSize($_FILES['fileselect']['tmp_name']);
                if($width > MIN_WIDTH && $height > MIN_HEIGHT){
                    $extensionUpload = ".jpg";
                    $uploadfile = $uploadDir.basename($_SESSION['user']->id.$extensionUpload);
                    if(move_uploaded_file($_FILES['fileselect']['tmp_name'], $uploadfile)) 
                    {
                        $new_width = RESIZE;
                        $new_height = RESIZE;
                        // $diff = $width / $new_width;
                        // $new_height = $height / $diff;
                        $dst_image = imagecreatetruecolor($new_width, $new_height);
                        $src_image = imagecreatefromjpeg($uploadfile);
                        $test = imagecopyresampled($dst_image, $src_image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
                        imagejpeg($dst_image, $uploadfile);
                        $code = 15;
                    } else {
                        $stockError['avatar'] = 'Erreur durant l\'importation de votre photo de profil';
                    }
                }else{
                    $stockError['avatar'] = 'Votre image est trop petite';
                }
            } else {
                $stockError['avatar'] = 'Votre photo de profil doit être au format jpg, jpeg ou png';
            }
        } else {
            $stockError['avatar'] = 'Votre photo de profil ne doit pas dépasser 2Mo';
        }
    }else{
        $firstPass = $_POST['pass'];
        $ctrlPass = $_POST['checkPass'];

        if(empty($firstPass)){
            $stockError['pass'] = "<br>ERREUR une donnée est vide : Nouveau mot de passe";
        }
        elseif(empty($ctrlPass)){
            $stockError['checkPass'] = "<br>ERREUR une donnée est vide : Confirmation du mot de passe";
        }
        elseif($firstPass != $ctrlPass){
            $code = 12;
        }
        if (empty($stockError) && $code != 12){
            $ctrlPass = password_hash($ctrlPass, PASSWORD_BCRYPT);
            $changePass = 0;
            $users = new User($_SESSION['user']->id,$_SESSION['user']->firstname, $_SESSION['user']->lastname, $_SESSION['user']->birthdate,$_SESSION['user']->mail,$ctrlPass,$changePass);
            $code = $users->Modify();
            $_SESSION['user']->password = $ctrlPass;
            $_SESSION['user']->changePass = $changePass;
        } 
    }
}
$testPic = dirname(__FILE__).'/../../uploads/users/'.$_SESSION['user']->id.'.jpg';

if(file_exists($testPic)){
    $pic='/uploads/users/'.$_SESSION['user']->id.'.jpg';
}else{
    $pic='/uploads/users/default-profile.jpg';
}

include dirname(__FILE__)."/../../view/user/profile.php";