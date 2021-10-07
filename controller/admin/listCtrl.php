<?php
//Inclusion de tous les modèles.
require_once(dirname(__FILE__).'/../../model/user.php');

//Déclaration des variables.
$count= 0;
$title="Liste des patients";
$search = false;
$code = intval(trim(strip_tags(filter_input(INPUT_GET, 'code', FILTER_SANITIZE_NUMBER_INT))));


//Si une suppression est demandée
if(!empty($_POST['remove'])){
    //Suppression du patient
    $getId = intval(trim(strip_tags(filter_input(INPUT_POST, 'remove', FILTER_SANITIZE_NUMBER_INT))));
    $request = User::Desactivate($getId);
    header('Refresh:0');
}

//Si une recherche est lancée
if(!empty($_POST['search'])){
    $word = trim(strip_tags(filter_input(INPUT_POST, 'search', FILTER_SANITIZE_STRING)));
    $data = User::Search($word);
    $search = true;
    $pagesNb = 1;
    $currentList = 1;
}
else{ //Sinon on affiche tous les éléments
    // On détermine sur quelle page on se trouve
    if(isset($_GET['list']) && !empty($_GET['list'])){
        $currentList = (int) strip_tags($_GET['list']);
    }else{
        $currentList = 1;
    }
    //On compte le Nbr de patient
    $result = User::Count();
    $nbPatients = (int) $result['nb'];
    // On détermine le nombre d'éléments par page
    $parPage = 4;
    // On calcule le nombre de pages total
    $pagesNb = ceil($nbPatients / $parPage);
    
    // On prépare la requête
    $data = User::Show();
}
include dirname(__FILE__).'/../../view/admin/list.php';