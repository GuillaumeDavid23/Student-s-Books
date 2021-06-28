<?php 
    session_start();
    if(empty($_SESSION['rank'])){
        header('Location: ../controller/connectCtrl.php');
    }
?>