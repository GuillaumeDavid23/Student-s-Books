var changePass = document.getElementById('changePass');
var divMsg = document.getElementById('msg');
var pass1 = document.getElementById('pass');
var pass2 = document.getElementById('checkPass');

function checkPass(e) {
    if (pass1.value != pass2.value) {
        e.preventDefault();
        divMsg.innerHTML = "Les mots de passes sont différents";
        pass1.classList.add('inputError');
        pass2.classList.add('inputError');
    } else {
        divMsg.innerHTML = "";
        pass1.classList.add('inputValide');
        pass2.classList.add('inputValide');
    }
}

changePass.addEventListener("submit", checkPass);
pass2.addEventListener("keyup", checkPass);