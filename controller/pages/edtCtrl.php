<?php
require_once(dirname(__FILE__).'/../../controller/session/sessionCtrl.php');
setlocale (LC_TIME, 'fr_FR.utf8','fra'); 

require_once(dirname(__FILE__).'/../../model/schedule.php');
require_once(dirname(__FILE__).'/../../model/slots.php');
require_once(dirname(__FILE__).'/../../model/classes.php');
require_once(dirname(__FILE__).'/../../model/matters.php');
require_once(dirname(__FILE__).'/../../model/rooms.php');

$jour = array(null, "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi");
$code = null;
$currentDayNumber = strftime('%w', time());
if($currentDayNumber == 0 || $currentDayNumber == 6){
    $currentDayNumber = 1;
}


if($_SERVER['REQUEST_METHOD'] == "POST"){
    $dayInput = trim(strip_tags(filter_input(INPUT_POST, 'days', FILTER_SANITIZE_STRING)));
    $slotInput = trim(strip_tags(filter_input(INPUT_POST, 'slots', FILTER_SANITIZE_NUMBER_INT)));
    $matterInput = trim(strip_tags(filter_input(INPUT_POST, 'matters', FILTER_SANITIZE_NUMBER_INT)));
    $roomInput = trim(strip_tags(filter_input(INPUT_POST, 'rooms', FILTER_SANITIZE_NUMBER_INT)));
    $id_class = trim(strip_tags(filter_input(INPUT_POST, 'class', FILTER_SANITIZE_NUMBER_INT)));
    try {
        $pdo = SPDO::getInstance();
        $pdo->beginTransaction();

        $schedule = new Schedule("",$dayInput, $slotInput, $matterInput,$roomInput);
        $code = $schedule->Add();
        if($code == 11){
            throw new Exception(11);
        }

        $id_schedule = $schedule->getLastId();
        if($code == 11){
            throw new Exception(11);
        }

        $classSchedule = new ClassSchedule($id_class,$id_schedule);
        $code = $classSchedule->Add();
        if($code == 11){
            throw new Exception(11);
        }

        $pdo->commit();
    } catch (Exception $ex) {
        
        $pdo->rollBack();
    }

}

$edt = Schedule::SelectAll();

foreach ($edt as $currentArray) {
    if($_SESSION['user']->id_classes == $currentArray['id_class']){
        $rdv1[$currentArray['day']][$currentArray['slot']] = $currentArray['matter']. '<br> Salle '.$currentArray['room'];
    }
}

//Préparation pour la vue
$slotsArray = Slot::SelectAll();
$classArray = Classes::SelectAll();
$mattersArray = Matter::SelectAll();
$roomsArray = Room::SelectAll();
$title = "Emploi du temps Student's Book's";
$meta = "";
$head = "Emploi du temps";

include dirname(__FILE__).'/../../view/templates/header.php';
include(dirname(__FILE__).'/../../view/pages/edt.php');
include dirname(__FILE__).'/../../view/templates/footer.php';