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

                if (this.status == 201) {
                    // On a une réponse
                    // On efface le champ texte
                    document.querySelector("#chatInput").value = ""
                } else {
                    // On reçoit une erreur, on l'affiche

                    let reponse = JSON.parse(this.response)
                    alert(reponse.message)
                }
            }
        }

        // On ouvre la requête
        xmlhttp.open("POST", "ajax/addMessage.php");

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

                // On boucle sur les messages
                messages.map((message) => {
                    // On transforme la date en objet JS
                    let dateMessage = new Date(message.create_at)

                    // On ajoute le message avant le contenu déjà en place
                    discussion.append(
                        `<p>${message.firstname} a écrit le ${dateMessage.toLocaleString()} : <br> ${message.message}</p>`
                    )

                    // On met à jour l'id
                    lastId = message.id
                })



            } else {
                // On gère les erreurs
                let erreur = JSON.parse(this.response)
                alert(erreur.message)
            }
        }
    }

    // On ouvre la requête
    xmlhttp.open("GET", "ajax/loadMessages.php?lastId=" + lastId)
    // On envoie la requête
    xmlhttp.send()
}