<?php
session_start();
if(empty($_SESSION['rank'])){
    header('Location: ../controller/connectCtrl.php');
}
setlocale (LC_TIME, 'fr_FR.utf8','fra'); 
//Connexion BDD
require_once(dirname(__FILE__).'/../model/model.php');
$bdd = new BDD();
$pdo = $bdd->bddConnect();
$request = $bdd->selectAll($pdo, "edt");
$dataArray = [];

while ($data = $request->fetch(PDO::FETCH_ASSOC)){
    array_push($dataArray, $data);
}
$jour = array(null, "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi");
foreach ($dataArray as $key => $currentArray) {
$rdv[$currentArray['day']][$currentArray['hour']] = $currentArray['matter']. '<br> Salle '. $currentArray['room'];
}
$time = time();
$currentDay = ucfirst(strftime('%A', $time));

include dirname(__FILE__).'/../view/templates/header.php';
include(dirname(__FILE__).'/../view/edt.php');
include dirname(__FILE__).'/../view/templates/footer.php';