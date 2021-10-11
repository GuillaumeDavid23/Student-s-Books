<?php
require_once(dirname(__FILE__).'/../../controller/session/sessionCtrl.php');
require_once(dirname(__FILE__).'/../../model/schedule.php');
require_once(dirname(__FILE__).'/../../model/classes_schedule.php');
require_once(dirname(__FILE__).'/../../model/slots.php');
require_once(dirname(__FILE__).'/../../model/classes.php');
require_once(dirname(__FILE__).'/../../model/matters.php');
require_once(dirname(__FILE__).'/../../model/rooms.php');

$stockError = [];
$arrayRdvId = [];
$jour = array(null, "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi");
$code = null;
$selectClass = null;
$count = 0;


if(!empty($_GET['day'])){
    $currentDayNumber = trim(strip_tags(filter_input(INPUT_GET, 'day', FILTER_SANITIZE_NUMBER_INT)));
    if($currentDayNumber < 0 || $currentDayNumber > 6){
        $currentDayNumber = strftime('%w', time());
    }
}else{
    $currentDayNumber = strftime('%w', time());
}

if($currentDayNumber == 0 || $currentDayNumber == 6){
    $currentDayNumber = 1;
}
if(!empty($_GET['idClass']) && empty($_POST['selectClass'])){
    $selectClass = trim(strip_tags(filter_input(INPUT_GET, 'idClass', FILTER_SANITIZE_NUMBER_INT)));
    if($selectClass > 1 || $selectClass < 4){
            $edt = Schedule::SelectAll();
            foreach ($edt as $currentArray) {
                if($selectClass == $currentArray['id_class']){
                    if($_SESSION['user']->id_ranks == 3){
                        if($_SESSION['user']->id_matters ==  $currentArray['id_matters']){
                            array_push($arrayRdvId, $currentArray['id']);
                            $rdv1[$currentArray['day']][$currentArray['slot']] = $currentArray['matter'].' <br>Salle: '.$currentArray['room'];
                        }
                    }else{
                        array_push($arrayRdvId, $currentArray['id']);
                        $rdv1[$currentArray['day']][$currentArray['slot']] = $currentArray['matter'].' <br>Salle: '.$currentArray['room'];
                    }
                }
            }
        }else{
            $stockError['selectClass'] = 'Veuillez renseigner une classe valide';
        }
}

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $selectClass = trim(strip_tags(filter_input(INPUT_POST, 'selectClass', FILTER_SANITIZE_NUMBER_INT)));
    if(!empty($selectClass)){
        if($selectClass > 1 || $selectClass < 4){
            $edt = Schedule::SelectAll();
            $arrayRdvId = [];

            foreach ($edt as $currentArray) {
                if($selectClass == $currentArray['id_class']){
                    if($_SESSION['user']->id_ranks == 3){
                        if($_SESSION['user']->id_matters ==  $currentArray['id_matters']){
                            array_push($arrayRdvId, $currentArray['id']);
                            $rdv1[$currentArray['day']][$currentArray['slot']] = $currentArray['matter'].' <br>Salle: '.$currentArray['room'];
                        }
                    }else{
                        array_push($arrayRdvId, $currentArray['id']);
                        $rdv1[$currentArray['day']][$currentArray['slot']] = $currentArray['matter'].' <br>Salle: '.$currentArray['room'];
                    }
                    
                }
            }
        }else{
            $stockError['selectClass'] = 'Veuillez renseigner une classe valide';
        }
    }else{
        $dayInput = trim(strip_tags(filter_input(INPUT_POST, 'days', FILTER_SANITIZE_STRING)));
        $slotInput = trim(strip_tags(filter_input(INPUT_POST, 'slots', FILTER_SANITIZE_NUMBER_INT)));
        $matterInput = trim(strip_tags(filter_input(INPUT_POST, 'matters', FILTER_SANITIZE_NUMBER_INT)));
        $roomInput = trim(strip_tags(filter_input(INPUT_POST, 'rooms', FILTER_SANITIZE_NUMBER_INT)));
        $id_class = trim(strip_tags(filter_input(INPUT_POST, 'class', FILTER_SANITIZE_NUMBER_INT)));
        $idSchedule = trim(strip_tags(filter_input(INPUT_POST, 'idSchedule', FILTER_SANITIZE_NUMBER_INT)));
        $idRemove = trim(strip_tags(filter_input(INPUT_POST, 'idRemove', FILTER_SANITIZE_NUMBER_INT)));
        if(!empty($idRemove)){
            $scheduleExist = Schedule::SelectOne($idRemove);
            if($scheduleExist){
                $code = Schedule::Delete($idRemove);
            }else{
                $code = 25;
            }
            
        }else{
            if(empty($dayInput)){
                $stockError['days'] = 'Veuillez renseigner un jour';
            }
            if(empty($slotInput)){
                $stockError['slots'] = 'Veuillez renseigner un créneau';
            }
            if(empty($matterInput)){
                $stockError['matters'] = 'Veuillez renseigner une matière';
            }
            if(empty($roomInput)){
                $stockError['rooms'] = 'Veuillez renseigner une salle';
            }
            if(empty($id_class)){
                $stockError['class'] = 'Veuillez renseigner une classe';
            }
            if(!empty($idSchedule)){
                $schedule = new Schedule($idSchedule,$dayInput, $slotInput, $matterInput,$roomInput);
                $code = $schedule->Modify();
            }else{
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
        }
    }
}

if(empty($selectClass)){
    $selectClass = 1;
    $edt = Schedule::SelectAll();
    foreach ($edt as $currentArray) {
        if($_SESSION['user']->id_classes == $currentArray['id_class']){
            $rdv1[$currentArray['day']][$currentArray['slot']] = $currentArray['matter']. '<br> Salle '.$currentArray['room'];
        }
        elseif($selectClass == $currentArray['id_class']){
            if($_SESSION['user']->id_ranks == 3){
                if($_SESSION['user']->id_matters ==  $currentArray['id_matters']){
                    array_push($arrayRdvId, $currentArray['id']);
                    $rdv1[$currentArray['day']][$currentArray['slot']] = $currentArray['matter'].' <br>Salle: '.$currentArray['room'];
                }
            }else{
                array_push($arrayRdvId, $currentArray['id']);
                $rdv1[$currentArray['day']][$currentArray['slot']] = $currentArray['matter'].' <br>Salle: '.$currentArray['room'];
            }
        }
    }
}

function ColorMatter($str){
    switch ($str) {
        case stristr($str, 'Musique'):
            $result = 'bg-darkRed';
            break;
        case stristr($str, 'Histoire-Géographie'):
            $result = 'bg-green';
            break;
        case stristr($str, 'EPS'):
            $result = 'bg-cyan';
            break;
        case stristr($str, 'Latin'):
            $result = 'bg-pink';
            break;
        case stristr($str, 'Pause'):
            $result = 'bg-secondary text-white';
            break;
        case stristr($str, 'SVT'):
            $result = 'bg-orange';
            break;        
        case stristr($str, 'Mathématique'):
            $result = 'bg-red';
            break;        
        case stristr($str, 'Français'):
            $result = 'bg-yellow';
            break;
        case stristr($str, 'Sciences-Physiques'):
            $result = 'bg-white';
            break;
        case stristr($str, 'Anglais'):
            $result = 'bg-royal';
            break;
        case stristr($str, 'Arts-Plastiques'):
            $result = 'bg-info';
            break;
        default:
            $result = '';
            break;
    }
    return $result;
}


//Préparation pour la vue
$slotsArray = Slot::SelectAll();
$classArray = Classes::SelectAll();
$mattersArray = Matter::SelectAll();
$roomsArray = Room::SelectAll();

include(dirname(__FILE__).'/../../view/pages/edt.php');