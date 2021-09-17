//Constante REGEX
const mailRegex = '[A-Z0-9a-z._%+-]+@[A-Za-z0-9.-]+\\.[A-Za-z]{2,64}'
const nameRegex = "^[a-zA-ZàâæçéèêëîïôœùûüÿÀÂÆÇnÉÈÊËÎÏÔŒÙÛÜŸ]{2,15}(-| |')?([a-zA-ZàâæçéèêëîïôœùûüÿÀÂÆÇnÉÈÊËÎÏÔŒÙÛÜŸ]{2,15})?$"
const subjectRegex = '^[a-zA-Zéèçàùâêîûüëï, \'"0-9]{2,}$'
const regNumber = "\\d{10}"

//Déclaration des variables
let lastnameInput = document.getElementById("lastname");
let firstnameInput = document.getElementById("firstname");
let mailInput = document.getElementById("mail");
let rankInput = document.getElementById("rank");
let subjectBloc = document.getElementById("subjectBloc");
let subjectInput = document.getElementById("subject");
let classesInput = document.getElementById("class");
let classesBloc = document.getElementById("classes");


//Ajout des eventlistener pour vérifier les champs
lastnameInput.addEventListener('keyup', (event) => {
    if (lastnameInput.value.match(nameRegex)) {
        lastnameInput.style.borderColor = "green";
        lastnameInput.style.borderWidth = "2px";
    } else {
        lastnameInput.style.borderColor = "red";
        lastnameInput.style.borderWidth = "2px";
        if (lastnameInput.value == "") {
            lastnameInput.style.borderColor = "";
        }
    }
});

firstnameInput.addEventListener('keyup', (event) => {
    if (firstnameInput.value.match(nameRegex)) {
        firstnameInput.style.borderColor = "green";
        firstnameInput.style.borderWidth = "2px";
    } else {
        firstnameInput.style.borderColor = "red";
        firstnameInput.style.borderWidth = "2px";
        if (firstnameInput.value == "") {
            firstnameInput.style.borderColor = "";
        }
    }
});

mailInput.addEventListener('keyup', (event) => {
    if (mailInput.value.match(mailRegex)) {
        mailInput.style.borderColor = "green";
        mailInput.style.borderWidth = "2px";
    } else {
        mailInput.style.borderColor = "red";
        mailInput.style.borderWidth = "2px";
        if (mailInput.value == "") {
            mailInput.style.borderColor = "";
        }
    }
});

rankInput.addEventListener('change', (event) => {
    if (rankInput.value == '3') {
        subjectBloc.classList.remove("d-none");
        subjectInput.setAttribute("required", "");
    } else {
        if (!subjectBloc.classList.contains("d-none")) {
            subjectBloc.classList.add("d-none");
        }

        subjectInput.removeAttribute("required", "");
    }

    if (rankInput.value == '1') {
        classesBloc.classList.remove("d-none");
        classesInput.setAttribute("required", "");
    } else {
        if (!classesBloc.classList.contains("d-none")) {
            classesBloc.classList.add("d-none");
        }

        classesInput.removeAttribute("required", "");
    }
});