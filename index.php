<?php
$page = intval(trim(filter_input(INPUT_GET, 'page', FILTER_SANITIZE_NUMBER_INT)));
switch ($page) {
    case 1:
        include dirname(__FILE__).'/controller/pages/noteCtrl.php';
        break;
    case 2:
        include dirname(__FILE__).'/controller/pages/assignmentCtrl.php';
        break;
    case 3:
        include dirname(__FILE__).'/controller/pages/edtCtrl.php';
        break;
    case 4:
        include dirname(__FILE__).'/controller/pages/absencesCtrl.php';
        break;
    case 5:
        include dirname(__FILE__).'/controller/pages/agendaCtrl.php';
        break;
    case 6:
        include dirname(__FILE__).'/controller/connect/passCtrl.php';
        break;
    case 7:
        include dirname(__FILE__).'/controller/user/profilCtrl.php';
        break;
    case 8:
        include dirname(__FILE__).'/controller/pages/tchatCtrl.php';
        break;
    case 9:
        include dirname(__FILE__).'/controller/connect/resetPassCtrl.php';
        break;
    case 10:
        include dirname(__FILE__).'/controller/connect/connectCtrl.php';
        break;
    case 11:
        include dirname(__FILE__).'/controller/user/registerCtrl.php';
        break;
    case 12:
        include dirname(__FILE__).'/controller/session/logOutCtrl.php';
        break;
    case 13:
        $head = "Mentions légales";
        $title = "Mentions légales";
        $meta = "Mentions légales";
        include dirname(__FILE__).'/view/templates/header.php';
        include dirname(__FILE__).'/view/mention.php';
        include dirname(__FILE__).'/view/templates/footer.php';

        break;
    case 14:
        include dirname(__FILE__).'/controller/pages/deleteFiles.php';
        break;
    default:
        include dirname(__FILE__).'/controller/homeCtrl.php';
        break;
}