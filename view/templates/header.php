<?php 
    $adresse = $_SERVER["PHP_SELF"];
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
    <link rel="stylesheet" href="/public/css/bootstrap/bootstrap.css">
    <!-- CSS -->
    <link rel="stylesheet" href="/public/css/dash.css">
    <?php 
    if($adresse == '/controller/agendaCtrl.php'){
        echo '<link rel="stylesheet" href="/public/css/agenda.css">';
    }
    if($adresse == '/controller/connectCtrl.php' || $adresse == '/controller/passCtrl.php' || $adresse == '/controller/resetPassCtrl.php'){
        echo '
            <link rel="stylesheet" href="/public/css/general.css">
            <link rel="stylesheet" href="/public/css/connect.css">
            ';
    }
    if($adresse == '/controller/edtCtrl.php'){
        echo '
            <link rel="stylesheet" href="/public/css/edt.css">
            ';
    }
    if($adresse == '/controller/registerCtrl.php'){
        echo '
            <link rel="stylesheet" href="../public/css/register.css">
            ';
    }
    ?>
    <!-- FavIcon -->    
    <link rel="shortcut icon" href="/public/img/favicon.ico" type="image/x-icon">
    <!-- META Description -->
    <meta name="description" content="<?= $meta ?>">
    <!-- Titre du site -->
    <title><?= $title ?></title>
</head>

<body>