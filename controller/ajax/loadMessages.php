<?php
session_start();
require_once(dirname(__FILE__).'/../../model/tchat.php');

// On vérifie la méthode utilisée par la requête ajax
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    // On est en GET
    // On vérifie si on a un id
    if(isset($_GET['lastId'])){
        if($_SESSION['user']->id_ranks == 4 || $_SESSION['user']->id_ranks == 3){
            if(isset($_GET['idClass'])){
                $idClass = intval(trim(strip_tags(filter_input(INPUT_GET, 'idClass', FILTER_SANITIZE_NUMBER_INT))));
            }
        }else{
            $idClass = $_SESSION['user']->id_classes;
        }
        // On récupère l'id et on nettoie
        $lastId = (int)strip_tags($_GET['lastId']);
        // On va chercher les messages
        $messages = Chat::SelectAll($lastId, $idClass);
        // On convertit en json
        $messagesJson = json_encode($messages);
        // On envoie
        echo $messagesJson;
    }
}else{
    // Mauvaise méthode
    http_response_code(405);
    echo json_encode(['message' => 'Mauvaise méthode']);
}