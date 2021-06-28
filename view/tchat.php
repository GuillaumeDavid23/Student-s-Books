<?php 
    session_start();
    if(empty($_SESSION['rank'])){
        header('Location: ../controllers/connectCtrl.php');
    }
?>