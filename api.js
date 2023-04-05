// Récupération du bouton "Delete All"
const deleteAllBtn = document.querySelector(".delete-all");

// Récupération de la liste des tâches
const tasksList = document.querySelector(".tasks");

// Ajout d'un gestionnaire d'événement sur le clic du bouton "Delete All"
deleteAllBtn.addEventListener("click", function () {
    // Suppression de toutes les tâches de la liste
    //


    let LesTaches = document.getElementById("lesTaches");


    // Initialisation du tableau qui va contenir les IDs des éléments enfants
    const idsTaches = [];

    // Parcours des enfants de l'élément parent
    for (let task of LesTaches.children) {
 
        idsTaches.push(task.id);
    }

    //name est donne2 pour $_POST["donne2"] 
    let data = { "idTaches": idsTaches };
    const urlEncodedData = new URLSearchParams(data);
    fetch('api/deleteAll.php', {
        method: 'POST',
        body: urlEncodedData,
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        }
    })
        .then(response => response.json())
        .then(respJsonData => {
            if(respJsonData[0]=="ok"){
                tasksList.innerHTML = "";
            }else{
                tasksList.innerHTML += "errrur de suppresion";
            }
           

        })
        .catch(error => {
            console.error('erreur post', error);
        });

    

});