<?php 
    session_start();    
    if(empty($_SESSION['rank'])){
        header('Location: ../controller/connectCtrl.php');
    }
    
    require_once(dirname(__FILE__).'/../model/bdd.php');
    require_once(dirname(__FILE__).'/../model/user.php');
    require_once(dirname(__FILE__).'/../public/config/config.php');
    
    //CONNEXION A LA BDD
    $users = new User($_SESSION['id']);
    $user = $users->SelectOne();

    $users = new User($user->id_matters);
    $matter = $users->SelectOne('matters');

    $users = new User($user->id_ranks);
    $rank = $users->SelectOne('ranks');



include dirname(__FILE__)."/../view/profile.php";