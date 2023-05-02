// Récupération du formulaire d'ajout de tâches
const addTaskForm = document.querySelector(".input");

// Ajout d'un gestionnaire d'événement sur la soumission du formulaire
addTaskForm.addEventListener("submit", function (event) {
    event.preventDefault();

    // Récupération de la valeur du champ "task"
    const taskValue = addTaskForm.elements.input.value.trim();

    // Si le champ est vide, on ne fait rien
    if (taskValue === "") {
        return;
    }

    // Envoi de la nouvelle tâche au serveur via l'API
    const data = { input: taskValue };
    const urlEncodedData = new URLSearchParams(data);

    fetch("api/addtask.php", {
        method: "POST",
        body: urlEncodedData,
        headers: {
            "Content-Type": "application/x-www-form-urlencoded",
        },
    })
        .then((response) => response.json())
        .then((respJsonData) => {
            if (respJsonData[0] === "ok") {
                // Si la tâche a été ajoutée avec succès, on l'affiche dans la liste
                const newTask = document.createElement("li");
                newTask.classList.add("task");
                newTask.innerHTML = `
                    <span>${taskValue}</span>
                    <button class="delete">Delete</button>
                `;
                tasksList.appendChild(newTask);
            } else {
                // Sinon, on affiche un message d'erreur
                tasksList.innerHTML += "Erreur d'ajout de tâche";
            }
        })
        .catch((error) => {
            console.error("Erreur lors de l'ajout de la tâche : ", error);
        });

    // Réinitialisation du formulaire
    addTaskForm.reset();
});
