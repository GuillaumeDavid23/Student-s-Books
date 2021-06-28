//Variables Globales
var myStock = localStorage;
var table = document.getElementById("calendarTable");
var formCalendar = document.getElementById("formToCreateCalendar");
var monthAndYear = document.getElementById("monthAndYear");
var dateEventInput = document.getElementById("dateEvent");
var btnAddEvent = document.getElementById("addEvent");
var dateInput = document.getElementById("date");
var arrayOfMonths = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
var ArrayMonthYear = monthAndYear.innerText.split(' ');
var month = ArrayMonthYear[0];
var year = ArrayMonthYear[1];
var indexForMonth = 0;

arrayOfMonths.forEach(function (monthEl, index) {
    if (month == monthEl) { //test du mois en cours
        indexForMonth = index + 1;
    }
});

if (indexForMonth < 10) {
    indexForMonth = `0${indexForMonth}`;
}

//Stockage du mois et de l'année
if (year != "" && indexForMonth != "00") {
    myStock.setItem('month', `${indexForMonth}`);
    myStock.setItem('year', `${year}`);
}
let stockMonth = myStock.getItem('month');
let stockYear = myStock.getItem('year');

//Réattribution des valeurs dans l'input
dateInput.value = `${stockYear}-${stockMonth}`;

// Ré-Affichage du calendrier 
btnAddEvent.addEventListener("click", function (event) {
    formCalendar.submit();
});

dateInput.onchange = () => {
    formCalendar.submit();
}

//Au clic sur un jour
table.addEventListener("click", function (event) {
    //Variables
    let focusList = document.getElementsByClassName("focus");
    let ArrayOfDay = event.target.innerText.split('\n');
    let day = ArrayOfDay[0];
    if (!(event.target.classList == "empty")) {
        //Test de la liste des éléments avec la classe "focus"
        if (focusList.length == 1) { //Si égal à 1 on enlève la classe de l'élément en cours
            focusList[0].classList.remove("focus");
        }
        focusList = []; //on reset le tableau
        event.target.classList.add("focus"); //et on ajoute la classe sur le nouvel élément

        if (day < 10) { //on ajoute un 0 si en dessous de 10 pour la syntaxe (jour 2 ==> jour 02)
            day = `0${day}`;
        }
        dateEventInput.value = `${year}-${indexForMonth}-${day}`; //Attribution des valeurs pour la séléction du jour de l'événement
    }
});