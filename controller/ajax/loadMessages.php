<?php
require_once(dirname(__FILE__).'/../../model/bdd.php');
require_once(dirname(__FILE__).'/../../model/tchat.php');

// On vérifie la méthode utilisée par la requête ajax
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    // On est en GET
    // On vérifie si on a un id
    if(isset($_GET['lastId'])){
        // On récupère l'id et on nettoie
        $lastId = (int)strip_tags($_GET['lastId']);
        //echo $lastId;
        $filtre = ($lastId > 0) ? " WHERE `messages`.`id` > $lastId" : '';

        // On va chercher les messages
        $chat = new Chat();
        $messages = $chat->SelectAll($filtre);

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