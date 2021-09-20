<?php
// Ce fichier ajoute un message dans la base de données
session_start();

require_once(dirname(__FILE__).'/../../model/user.php');

// On vérifie la méthode utilisée par la requête ajax
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    $idClass = intval(strip_tags(trim(filter_input(INPUT_GET, 'class', FILTER_SANITIZE_NUMBER_INT))));
    // On vérifie si on a un id
    if(!empty($idClass)){
        // On va chercher les messages
        $messages = User::SelectAllByClass($idClass);
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