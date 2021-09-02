<?php
session_start();
if(empty($_SESSION['rank'])){
    header('Location: ../controller/connectCtrl.php');
}
setlocale (LC_TIME, 'fr_FR.utf8','fra'); 
//Connexion BDD
require_once(dirname(__FILE__).'/../model/model.php');

require_once(dirname(__FILE__).'/../model/bdd.php');
require_once(dirname(__FILE__).'/../model/user.php');
require_once(dirname(__FILE__).'/../model/schedule.php');
require_once(dirname(__FILE__).'/../model/slots.php');
require_once(dirname(__FILE__).'/../model/matters.php');
require_once(dirname(__FILE__).'/../model/rooms.php');
require_once(dirname(__FILE__).'/../public/config/config.php');

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $dayInput = filter_input(INPUT_POST, 'days', FILTER_SANITIZE_STRING);
    $slotInput = filter_input(INPUT_POST, 'slots', FILTER_SANITIZE_NUMBER_INT);
    $matterInput = filter_input(INPUT_POST, 'matters', FILTER_SANITIZE_NUMBER_INT);
    $roomInput = filter_input(INPUT_POST, 'rooms', FILTER_SANITIZE_NUMBER_INT);
    
    $schedule = new Schedule("",$dayInput, $slotInput, $matterInput,$roomInput);
    $code = $schedule->Add();
}

$schedule = new Schedule();
$edt = $schedule->SelectAll();
$jour = array(null, "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi");
$dataArray1 = [];
$time = time();
$currentDay = ucfirst(strftime('%A', $time));

foreach ($edt as $slot) {
    array_push($dataArray1, $slot);
}

foreach ($dataArray1 as $key => $currentArray) {
    $slots = new Slot($currentArray['id_slots']);
    $slot = $slots->SelectOne();

    $matters = new Matter($currentArray['id_matters']);
    $matter = $matters->SelectOne();

    $rooms = new Room($currentArray['id_rooms']);
    $room = $rooms->SelectOne();

    $rdv1[$currentArray['day']][$slot->slot] = $matter->matter. '<br> Salle '.$room->room;
}



$slotsArray = $slots->SelectAll();
$mattersArray = $matters->SelectAll();
$roomsArray = $rooms->SelectAll();
$title = "Emploi du temps Student's Book's";
$meta = "";
$head = "Emploi du temps";

include dirname(__FILE__).'/../view/templates/header.php';
include(dirname(__FILE__).'/../view/edt.php');
include dirname(__FILE__).'/../view/templates/footer.php';