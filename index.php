<?php
$page = intval(trim(filter_input(INPUT_GET, 'page', FILTER_SANITIZE_NUMBER_INT)));
switch ($page) {
    case 1:
        $title = "Page des notes : Students'Books";
        $meta = "";
        $head = "Notes";
        include dirname(__FILE__).'/view/templates/header.php';
        include dirname(__FILE__).'/controller/pages/noteCtrl.php';
        break;
    case 2:
        $title = 'Page des devoirs : voir ou rendre un devoir';
        $meta = '';
        $head = "Devoirs";
        include dirname(__FILE__).'/view/templates/header.php';
        include dirname(__FILE__).'/controller/pages/assignmentCtrl.php';
        break;
    case 3:
        $title = "Emploi du temps Student's Book's";
        $meta = "";
        $head = "Emploi du temps";
        include dirname(__FILE__).'/view/templates/header.php';
        include dirname(__FILE__).'/controller/pages/edtCtrl.php';
        break;
    case 4:
        $title = 'Page des absences, Students\'Books : Les devoirs à la maison facilement';
        $meta = 'Bienvenue sur Students\'Books, c\'est ici que commence la révolution scolaire.
                Emploi du temps/ devoirs/ absences... retrouver toutes les information scolaire içi';
        $head = "Absences";
        include dirname(__FILE__).'/view/templates/header.php';
        include dirname(__FILE__).'/controller/pages/absencesCtrl.php';
        break;
    case 5:
        //Préparation de l'affichage 
        $title = "Agenda Students'Books";
        $meta = "";
        $head = "Agenda";
        include dirname(__FILE__).'/view/templates/header.php';
        include dirname(__FILE__).'/controller/pages/agendaCtrl.php';
        break;
    case 6:
        $title = "Changement du mot de passe Students'Books";
        $meta = "";
        $head = "Changer votre mot de passe";
        include dirname(__FILE__).'/view/templates/header.php';
        include dirname(__FILE__).'/controller/connect/passCtrl.php';
        break;
    case 7:
        $title = "Profil Students'Books";
        $meta = "";
        $head = "Votre profil";
        include dirname(__FILE__).'/view/templates/header.php';
        include dirname(__FILE__).'/controller/user/profilCtrl.php';
        break;
    case 8:
        $title = "Tchat en ligne : Students'Books";
        $meta ="";
        $head = "Tchat";
        include dirname(__FILE__).'/view/templates/header.php';
        include dirname(__FILE__).'/controller/pages/tchatCtrl.php';
        break;
    case 9:
        $title = "Reinitialisation du mot de passe";
        $meta = "";
        $head = "Reinitialisation du mot de passe";
        include dirname(__FILE__).'/view/templates/header.php';
        include dirname(__FILE__).'/controller/connect/resetPassCtrl.php';
        break;
    case 10:
        $title = 'Page de connexion : Students\'Books';
        $meta = '';
        $head = 'Connexion';
        include dirname(__FILE__).'/view/templates/header.php';
        include dirname(__FILE__).'/controller/connect/connectCtrl.php';
        break;
    case 11:
        $title = "Enregistrement d'un nouvel utilisateur";
        $meta = "";
        $head = "Inscription d'utilisateur";
        include dirname(__FILE__).'/view/templates/header.php';
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
        break;
    case 14:
        include dirname(__FILE__).'/controller/pages/deleteFiles.php';
        break;
    default:
        include dirname(__FILE__).'/controller/homeCtrl.php';
        break;
}

include dirname(__FILE__).'/view/templates/footer.php';

