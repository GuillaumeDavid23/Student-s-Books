window.onload = () => {
    // On va chercher la zone de texte
    let texte = document.querySelector("#class")
    texte.addEventListener("change", link)

}

function link() {
    // On récupère la valeur dans le champ "texte"
    let classValue = document.querySelector("#class").value
    let studentSelect = document.querySelector("#student")

    // On vérifie si on a un message
    if (classValue != "") {
        // On instancie XMLHttpRequest
        let xmlhttp = new XMLHttpRequest()

        // On gère la réponse
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4) {
                if (this.status == 200) {
                    // On a une réponse
                    let studentArray = JSON.parse(this.response)
                    studentSelect.innerHTML = '<option>Sélectionner un élève</option>'
                    studentArray.map((student) => {
                        studentSelect.innerHTML += `<option value='${student.id}'>${student.firstname} ${student.lastname}</option>`
                    })
                } else {
                    // On reçoit une erreur, on l'affiche
                    let reponse = JSON.parse(this.response)
                    alert(reponse.message)
                }
            }
        }

        // On ouvre la requête
        xmlhttp.open("GET", "/controller/ajax/linkClass.php?class=" + classValue)


        // On envoie la requête avec les données
        xmlhttp.send();
    }
}