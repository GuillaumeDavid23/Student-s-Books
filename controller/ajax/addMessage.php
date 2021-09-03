<?php
// Ce fichier ajoute un message dans la base de données
session_start();

require_once(dirname(__FILE__).'/../../model/bdd.php');
require_once(dirname(__FILE__).'/../../model/tchat.php');

// On vérifie la méthode
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    // Bonne méthode
    // On vérifie si l'utilisateur est connecté
    if(isset($_SESSION['id'])){
        // L'utilisateur est connecté
        // On récupère les données
        $donneesJson = file_get_contents('php://input');
        // On convertit les données
        $donnees = json_decode($donneesJson);
        
        // On vérifie qu'il y a un message
        if(isset($donnees->message) && !empty($donnees->message)){
            // Le message n'est pas vide
            // On peut l'enregistrer
            // On se connecte
            $chat = new Chat("", strip_tags($donnees->message), $_SESSION['id']);
            $code = $chat->Add();
            if($code == 3){
                $_SESSION['derniere_action'] = time(); // mise à jour de la variable
                http_response_code(201);
                echo json_encode(['message' => 'Message enregistré']);
            }else{
                http_response_code(400);
                echo json_encode(['message' => 'Une erreur est survenue']);
            }
        }else{
            // Le message est indéfini ou vide
            http_response_code(400);
            echo json_encode(['message' => 'Le message est vide']);    
        }
    }else{
        // L'utilisateur n'est pas connecté
        http_response_code(400);
        echo json_encode(['message' => 'Vous n\'êtes pas connecté(e)']);
    }
}else{
    // Mauvaise méthode
    http_response_code(405);
    echo json_encode(['message' => 'Mauvaise méthode']);
}