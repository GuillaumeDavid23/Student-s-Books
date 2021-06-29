<?php 
    session_start();
    if(empty($_SESSION['rank'])){
        header('Location: ../controller/connectCtrl.php');
        exit();
    }else{
        $rank = $_SESSION['rank'];
    }
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $hwDate = $_POST['assignmentDate'];
        $hwName = $_POST['assignmentName'];
    }
    var_dump($_SESSION);
    require(dirname(__FILE__).'../view/assignment.php');

    
