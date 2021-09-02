<?php
session_start();
if(empty($_SESSION['rank'])){
        header('Location: ../controller/connectCtrl.php');
} 
require_once(dirname(__FILE__).'/../model/bdd.php');
require_once(dirname(__FILE__).'/../model/tchat.php');
require_once(dirname(__FILE__).'/../model/user.php');
require_once(dirname(__FILE__).'/../public/config/config.php');

$title = "Tchat en ligne : Students'Books";
$meta ="";
$head = "Tchat";

include dirname(__FILE__).'/../view/templates/header.php';
include dirname(__FILE__).'/../view/tchat.php';
include dirname(__FILE__).'/../view/templates/footer.php';

