<?php
//démarrage de la session
session_start();
//TEST de l'existance de la session utilisateur
if(empty($_SESSION['user'])){
    header('Location: /index.php?page=10');
}

//Inclusion des différents fichiers
require_once(dirname(__FILE__).'/../model/calendar.php');
require_once(dirname(__FILE__).'/../public/config/config.php');

//Déclaration des variables
$arrayTestOfMonth = array('January','February', 'March', "April", 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'); 
$code = null;

//Test d'existance des variables de l'envoi 
if (!empty($_POST['dateEvent']) && !empty($_POST['eventName'])) {
    //On traite les données.
    $fullDate = trim(filter_input(INPUT_POST, 'dateEvent', FILTER_SANITIZE_STRING));
    $eventName = trim(filter_input(INPUT_POST, 'eventName', FILTER_SANITIZE_STRING));;
    //on ajoute dans la base
    $calendar = new Calendar("",$eventName,$fullDate,$_SESSION['user']->id);
    $code = $calendar->Add();
    //header("Refresh:0");
}

$empty = false;//Test du select
if (empty($_POST['month'])) {
    $empty = true;
}
else{
    //Création du calendrier
    function CreateCalendar()
    {
        //Déclaration des variables
        $arrayTestOfMonth = array('January','February', 'March', "April", 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'); //Tableau de test des mois
        $date = $_POST['month']; //Récupération des valeurs du select dans un array
        $cut = explode('-', $date); //Découpage du tableau $date pour séparer les valeurs
        $year = $cut[0]; //Année choisie
        $month = ltrim($cut[1], '0')-1; //mois choisi en enlevant les zéros 07(juillet) => 7
        $numberOfDay = date('t',mktime(0,0,0,$month+1,1,$year)); // le nombre de jour dans le mois selectionné
        $keyOfFirstDay = strftime('%w', strtotime("1 $arrayTestOfMonth[$month] $year")). '<br>'; // le nom du premier jour en entier (lundi = 1, diamanche = 7)
        $endCalendar = true;//Test de la fin du calendrier
        $empty = false;//Test du select
        $emptyCase = '<td class="empty"></td>';
        
        $dataDB = Calendar::SelectAll();

        //Attribution du premier jour.
        if((int)$keyOfFirstDay == 0){
            $keyOfFirstDay = 7;
        }
        $week = (int)$keyOfFirstDay;
        
        //Boucle principale
        for ($count = 1;$count <= $numberOfDay; $count++){
            
            $fillCase = "<td><span>$count</span>";
            
            if ($week == $keyOfFirstDay) {
                echo '<tr>';
                for($space = 1; $space < $keyOfFirstDay; $space++){
                    echo $emptyCase;
                }
                
                if ($count == 1 && $arrayTestOfMonth[$month] == 'May') {
                    echo "<td><span>$count</span> <br>Fête du travail</td>";
                }
                elseif ($count == 1 && $arrayTestOfMonth[$month] == 'January') {
                    echo "<td><span>$count</span> <br>Jour de l'an</td>";
                }
                elseif ($count == 1 && $arrayTestOfMonth[$month] == 'November') {
                    echo "<td><span>$count</span> <br>La Toussaint</td>";
                }
                else{
                    echo "$fillCase</td>";
                }
                
                $week++;
                $keyOfFirstDay = 10;
            }
            elseif ($week > 7) {
                $week = 1;
                $count--;
                echo '</tr><tr>';
            }
            else{
                
                if ($count == 14 && $arrayTestOfMonth[$month] == 'July') {
                    echo "<td><span>$count</span> <br>Fête Nationale";
                }
                elseif ($count == 8 && $arrayTestOfMonth[$month] == 'May') {
                    echo "<td><span>$count</span> <br>Fête de la victoire";
                }
                elseif ($count == 15 && $arrayTestOfMonth[$month] == 'August') {
                    echo "<td><span>$count</span> <br>Assomption";
                }
                elseif ($count == 11 && $arrayTestOfMonth[$month] == 'November') {
                    echo "<td><span>$count</span> <br>Armistice";
                }
                elseif ($count == 25 && $arrayTestOfMonth[$month] == 'December') {
                    echo "<td><span>$count</span> <br>Noël";
                }
                else{
                    echo $fillCase;
                }
                foreach($dataDB as $event)
                {   
                    $date = $event['event_date']; //Récupération des valeurs du SelectAll dans un array
                    $cut = explode('-', $date); //Découpage du tableau $date pour séparer les valeurs
                    $DByear = $cut[0]; //Année
                    $DBmonth = $cut[1]; //mois
                    $DBmonth = ltrim($DBmonth, '0');
                    $DBday = $cut[2]; //jour 
                    if($month+1 == array_search($arrayTestOfMonth[$DBmonth], $arrayTestOfMonth) && $DByear == $year && $DBday == $count){
                        echo '<br>'.$event['event'];
                    }
                }
                echo "</td>";
                $week++;
            }
        }
        
        if($endCalendar == true){
            $endCalendar = false;
            for($count2 = $week; $count2 <= 7; $count2++){
                echo $emptyCase;
            }
        }
        
    }
    //Création des jours
    function CreateDays()
    {
        $arrayOfDaysForTable = array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');
        foreach ($arrayOfDaysForTable as $key => $value) {
            echo "<th class='day'>$value</th>";
        }
    }
    //Création du titre de la sélection

    function titleMonthAndYear()
    {   
        $date = $_POST['month'];
        $cut = explode("-", $date);
        $year = $cut[0];
        $month = ltrim($cut[1], "0")-1;
        $arrayOfMonthForTable = array('Janvier','Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
        echo $arrayOfMonthForTable[$month].' '.$year;
    }
}

//Préparation de l'affichage 
$title = "Agenda Students'Books";
$meta = "";
$head = "Agenda";

//Inclusion des vues
include dirname(__FILE__).'/../view/templates/header.php';
include dirname(__FILE__).'/../view/agenda.php';
?>