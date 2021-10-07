<?php
//Démmarrage de la session
  //TEST de l'exitsance de la session
if(empty($_SESSION['user'])){
        header('Location: /index.php?page=10');
} 

//Inclusion des différents fichiers
require_once(dirname(__FILE__).'/../../model/tchat.php');
require_once(dirname(__FILE__).'/../../model/user.php');

include dirname(__FILE__).'/../../view/pages/tchat.php';