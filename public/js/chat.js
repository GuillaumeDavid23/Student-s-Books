// Variables globales
var lastId = 0


window.onload = () => {
    // On va chercher la zone de texte
    let texte = document.querySelector("#chatInput")
    texte.addEventListener("keyup", verifEntree)

    // On va chercher le bouton "valid"
    let valid = document.querySelector("#chatBtnSend")
    valid.addEventListener("click", ajoutMessage)

    setInterval(chargeMessages, 1000)
    setInterval(alive, 5000)
}

function verifEntree(e) {
    if (e.key == "Enter") {
        ajoutMessage()
    }
}

function ajoutMessage() {
    // On récupère la valeur dans le champ "texte"
    let message = document.querySelector("#chatInput").value

    // On vérifie si on a un message
    if (message != "") {
        // On crée un objet JS pour le message
        let donnees = {}
        donnees["message"] = message

        // On convertit les données en json
        let donneesJson = JSON.stringify(donnees)

        // On envoie les données en POST en Ajax
        // On instancie XMLHttpRequest
        let xmlhttp = new XMLHttpRequest()

        // On gère la réponse
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4) {
                console.log(this.status)
                if (this.status == 201) {
                    // On a une réponse
                    // On efface le champ texte
                    document.querySelector("#chatInput").value = ""
                } else {
                    // On reçoit une erreur, on l'affiche
                    document.querySelector("#chatInput").value = ""
                    let reponse = JSON.parse(this.response)
                    alert(reponse.message)

                }
            }
        }

        // On ouvre la requête
        xmlhttp.open("POST", "/controller/ajax/addMessage.php");

        // On envoie la requête avec les données
        xmlhttp.send(donneesJson);
    }
}

function chargeMessages() {
    // On charge les messages en Ajax
    // On instancie XMLHttpRequest
    let xmlhttp = new XMLHttpRequest()

    // On gère la réponse
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4) {
            if (this.status == 200) {
                // On a une réponse
                // On convertit le JSON en objet JS

                let messages = JSON.parse(this.response)
                // On retourne la liste pour traiter l'ID le plus élevé en dernier
                messages.reverse();

                // On récupère la div "discussion"
                let discussion = $("#chatMessage")

                let addClass = "";
                let bloc = document.getElementById('chatMessage');
                let idUser = bloc.dataset.id

                // On boucle sur les messages
                messages.map(async (message) => {
                    // On transforme la date en objet JS
                    let dateMessage = new Date(message.create_at)

                    if (idUser == message.id_users) {
                        addClass = "meChat align-self-end"
                        imgClass = "align-self-end"
                        img = ""
                    } else {
                        let image_url = `/uploads/users/${message.id_users}.jpg`;

                        let exist = await fetch(image_url)
                            .then(function (response) {
                                return response
                            }).then(function (data) {
                                if (data.status == 404) {
                                    return pic = `/uploads/users/default-profile.jpg`;
                                } else {
                                    return pic = `/uploads/users/${message.id_users}.jpg`
                                }
                            })
                        addClass = "otherChat align-self-start"
                        img = `<img width = '25'
                        class = "rounded-circle align-self-start"
                        src = "${exist}"
                        alt = "" >`
                    }

                    if (dateMessage.getMinutes() < 10) {
                        time = dateMessage.getHours() + ":0" + dateMessage.getMinutes()
                    } else {
                        time = dateMessage.getHours() + ":" + dateMessage.getMinutes()
                    }
                    // On ajoute le message avant le contenu déjà en place
                    discussion.append(

                        `
                        ${img}
                        <div class="${addClass} m-1 mb-3 p-1 d-flex flex-column">
                            <p class="${addClass}">${message.firstname} à ${time} : <br> ${message.message}</p>
                        </div>
                        `
                    )

                    // On met à jour l'id
                    lastId = message.id
                    bloc.scrollTo(0, bloc.scrollHeight);
                })



            } else {
                // On gère les erreurs
                let erreur = JSON.parse(this.response)
                alert(erreur.message)
            }
        }
    }

    // On ouvre la requête
    xmlhttp.open("GET", "/controller/ajax/loadMessages.php?lastId=" + lastId)
    // On envoie la requête
    xmlhttp.send()
}

function alive() {
    // On charge les messages en Ajax
    // On instancie XMLHttpRequest
    let xmlhttp = new XMLHttpRequest()
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4) {
            let onlines = JSON.parse(this.response)
            let contact = document.getElementById('connected')
            contact.innerHTML = onlines.nb
            // On ajoute le nombre de personne connecté

        }
    }
    // On ouvre la requête
    xmlhttp.open("GET", "/controller/ajax/connectChat.php")
    // On envoie la requête
    xmlhttp.send()
}