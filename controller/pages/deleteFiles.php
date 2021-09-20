<?php
require_once(dirname(__FILE__).'/../session/sessionCtrl.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $idAssign = filter_input(INPUT_POST, 'idAssign', FILTER_SANITIZE_NUMBER_INT);

    $testPic = dirname(__FILE__).'/../../uploads/assign/'.$_SESSION['user']->id.'-'.$idAssign.'.pdf';

    if(file_exists($testPic)){
        unlink($testPic);
        header('Location: /index.php?page=2&code=19');
        die;
    }else{
        header('Location: /index.php?page=2&code=20');
        die;
    }
}