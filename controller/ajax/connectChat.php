<?php 
session_start();

require_once(dirname(__FILE__).'/../../model/online.php');
 

date_default_timezone_set('Europe/Paris');

if(isset($_SESSION['derniere_action']) && $_SESSION['derniere_action'] > time() - 300 ) {
    /* time() - 300 secondes = heure actuelle - 5 min */
    /* donc dans ce cas, la dernière action date de moins de 5 minutes */
    Online::checkOffline(time() - 300);

    $online = new Online("", $_SESSION['user']->id, $_SESSION['derniere_action']);
    $test = $online->Add();
    $messages = Online::SelectAll();

    // On convertit en json
    $messagesJson = json_encode($messages);
    // On envoie
    echo $messagesJson;
} else {
    /* soit derniere action vielle de plus de 5 minutes => deconexion */
    //On supprime les utilisateurs déconnectés depuis plus de 5 minutes
    Online::checkOffline(time() - 300);
    $messages = Online::SelectAll();
    // On convertit en json
    $messagesJson = json_encode($messages);
    // On envoie
    echo $messagesJson;
    
}


