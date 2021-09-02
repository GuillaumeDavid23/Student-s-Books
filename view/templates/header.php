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
    <!-- <link rel="stylesheet" href="/public/css/bootstrap/bootstrap.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
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
    <div class="container-fluid h-100 p-0">
        <header class="w-100 mb-5 d-flex align-items-center">
            <img src="../public/img/LOGO SOLO.png" class="ms-3 h-100" alt="">
            <a href="../index.php" class="h-100 d-flex align-items-center">
                <img src="../public/img/backward.png" class="img-fluid" width="50" alt="">
            </a>
            <h1 class="ms-4 align-self-center text-center m-0"><?= $head ?></h1>
        </header>