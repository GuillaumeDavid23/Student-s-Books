<?php
$page = intval(trim(filter_input(INPUT_GET, 'page', FILTER_SANITIZE_NUMBER_INT)));
switch ($page) {
    case 1:
        include dirname(__FILE__).'/controller/noteCtrl.php';
        break;
    case 2:
        include dirname(__FILE__).'/controller/assignmentCtrl.php';
        break;
    case 3:
        include dirname(__FILE__).'/controller/edtCtrl.php';
        break;
    case 4:
        include dirname(__FILE__).'/controller/absencesCtrl.php';
        break;
    case 5:
        include dirname(__FILE__).'/controller/agendaCtrl.php';
        break;
    case 6:
        include dirname(__FILE__).'/controller/passCtrl.php';
        break;
    case 7:
        include dirname(__FILE__).'/controller/profilCtrl.php';
        break;
    case 8:
        include dirname(__FILE__).'/controller/tchatCtrl.php';
        break;
    case 9:
        include dirname(__FILE__).'/controller/resetPassCtrl.php';
        break;
    case 10:
        include dirname(__FILE__).'/controller/connectCtrl.php';
        break;
    case 11:
        include dirname(__FILE__).'/controller/registerCtrl.php';
        break;
    default:
        include dirname(__FILE__).'/controller/homeCtrl.php';
        break;
}