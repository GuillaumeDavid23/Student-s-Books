<?php 
session_start();

require_once(dirname(__FILE__).'/../../model/bdd.php');
require_once(dirname(__FILE__).'/../../model/user.php');
require_once(dirname(__FILE__).'/../../model/online.php');
require_once(dirname(__FILE__).'/../../public/config/config.php');

date_default_timezone_set('Europe/Paris');

if(isset($_SESSION['derniere_action']) && $_SESSION['derniere_action'] > time() - 300 ) {
    // var_dump(strftime('%H : %M', $_SESSION['derniere_action']));
    // var_dump(strftime('%H : %M', time() - 300));
    /* time() + 300 secondes = heure actuelle + 5 min */
    /* donc dans ce cas, la dernière action date de moins de 5 minutes */
    $online = new Online("", $_SESSION['id']);
    $online->Add();
    $messages = $online->SelectAll();
    
    // On convertit en json
    $messagesJson = json_encode($messages);

    // On envoie
    //echo $messagesJson;
} else {
    $online = new Online("", $_SESSION['id']);
    $online->Delete();
    $messages = $online->SelectAll();
    
    // On convertit en json
    $messagesJson = json_encode($messages);

    // On envoie
    //echo $messagesJson;
    /* soit derniere action vielle de plus de 5 minutes => deconexion */
}

$online = new Online();
$test = $online->checkOffline(time() - 300);
var_dump($test);