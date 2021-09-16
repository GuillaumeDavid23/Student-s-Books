<?php
setlocale(LC_TIME, ['fr.utf8', 'fra', 'fr_FR']);

$messageCode = [
    1 => ['type' => 'alert-success', 'msg' => 'L\'utilisateur à bien été ajouté'],
    2 => ['type' => 'alert-danger', 'msg' => 'Cet utilisateur existe déjà'],
    3 => ['type' => 'alert-success', 'msg' => 'Compte modifié !'],
    4 => ['type' => 'alert-danger', 'msg' => 'Erreur lors de la modification du compte !'],
    5 => ['type' => 'alert-success', 'msg' => 'Si le compte existe un mail vous a été envoyé'],
    11 => ['type' => 'alert-danger', 'msg' => 'Une erreur est survenue'],
    12 => ['type' => 'alert-danger', 'msg' => 'Les mots de passes sont différents'],
    13 => ['type' => 'alert-warning', 'msg' => 'Email ou mot de passe incorrect !'],
    14 => ['type' => 'alert-success', 'msg' => 'Votre compte a bien été désactivé '],
    15 => ['type' => 'alert-warning', 'msg' => 'Compte désactivé, contactez votre administrateur'],
    15 => ['type' => 'alert-success', 'msg' => 'Votre photo de profil a bien été ajouté'],
    16 => ['type' => 'alert-success', 'msg' => 'Cours ajouté'],
    17 => ['type' => 'alert-success', 'msg' => 'Devoirs rendu !'],
    18 => ['type' => 'alert-success', 'msg' => 'Devoirs ajouté !'],
];

//REGEX 
define("REGEX_NAME", "^[a-zA-ZàâæçéèêëîïôœùûüÿÀÂÆÇnÉÈÊËÎÏÔŒÙÛÜŸ]{2,15}(-| |')?([a-zA-ZàâæçéèêëîïôœùûüÿÀÂÆÇnÉÈÊËÎÏÔŒÙÛÜŸ]{2,15})?$");

define("REGEX_BIRTHDAY", "^([12]\d{3}[-](0[1-9]|1[0-2])[-](0[1-9]|[12]\d|3[01]))$");
define("LIMIT_SIZE", "2097152");
define("SUPPORTED_FORMAT", array('image/jpeg'));
define("SUPPORTED_FORMAT_ASSIGN", array('application/pdf'));
define("MIN_WIDTH", 150);
define("MIN_HEIGHT", 150);
define("RESIZE", 300);


