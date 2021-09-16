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
    <!-- font Awesome -->
    <script src="https://kit.fontawesome.com/8fbc0d958d.js" crossorigin="anonymous"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="/public/css/dash.css">
    <?php 
    if($page == 5){
        echo '<link rel="stylesheet" href="/public/css/agenda.css">';
    }
    if($page == 10 || $page == 6 || $page == 11 || $page == 9){
        echo '
            <link rel="stylesheet" href="/public/css/general.css">
            <link rel="stylesheet" href="/public/css/connect.css">
            ';
    }
    if($page == 3){
        echo '
            <link rel="stylesheet" href="/public/css/edt.css">
            ';
    }
    if($page == 11){
        echo '
            <link rel="stylesheet" href="/public/css/register.css">
            ';
    }
    if($page == 7){
        echo '
            <link rel="stylesheet" href="/public/css/profil.css">
            ';
    }
    if($page == 8){
        echo '
            <link rel="stylesheet" href="/public/css/chat.css">
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
        <header class="d-flex w-100 align-items-center">
            <div class="logoBloc ms-1">
                <img src="/public/img/LOGO SOLO.png" width="70" alt="">
            </div>
            <div class="ps-2">
                <a href="/index.php" class="h-100 d-flex align-items-center text-decoration-none text-white">
                    <i class="fas fa-angle-double-left fa-2x"></i>
                </a>
            </div>
            
            <div class="w-100 d-flex align-items-center justify-content-center">
                <h1 class="m-0"><?= $head ?></h1>
            </div>
            <div class="align-self-center">
                <a href="/index.php?page=7" class="btn btn-outline-dark fw-bold me-3"><i class="fas fa-user-alt"></i></a> 
            </div>
            <div class="align-self-center me-2">
                <a href="/index.php?page=12" class="btn btn-outline-danger fw-bold"><i class="fas fa-sign-out-alt"></i></a> 
            </div>
        </header>
        <main class="container-fluid">