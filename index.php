<style> body {
    font-family: Arial, Helvetica, sans-serif;
}
.container {
    width: 500px;
    margin: 20px auto;
}

.form {
    background-color: #eee;
    border-radius: 6px;
    padding: 20px;
    display: flex;
    align-items: center;
}
.input {
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 6px;
    flex: 1;
}
.input:focus , .add:focus{
    outline: none;
}
.add {
    border: none;
    background-color: #f44336;
    color: white;
    padding: 10px;
    border-radius: 6px;
    margin-left: 10px;
    cursor: pointer;
}
.tasks {
    background-color: #eee;
    margin-top: 20px;
    border-radius: 6px;
    padding: 20px;
}
.tasks .task {
    background-color: white;
    padding: 10px;
    border-radius: 6px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    transition: 0.3s;
    cursor: pointer;
    border: 1px solid #ccc;
}
.tasks .task:not(:last-child) {
    margin-bottom: 15px;
}
.tasks .task:hover {
    background-color: #f7f7f7;
}
.tasks .task.done {
    opacity: 0.5;
    position: relative;
}
.task.done::after {
    position: absolute;
    content: "";
}
.tasks .task span { 
    font-weight: bold;
    font-size: 10px;
    background-color: red;
    color: white;
    padding: 2px 6px;
    border-radius: 4px;
    cursor: pointer;
}
.delete-all {
    width: calc(100% - 25px);
    margin: auto;
    padding: 12px;
    text-align: center;
    font-size: 14px;
    color: white;
    background-color: #f44336;
    margin-top: 20px;
    cursor: pointer;
    border-radius: 4px;
}</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php   
$ipServerSQL = "192.168.65.36";
$NomBase = "to_do_list";
$UserBDD = "root";
$PassBDD = "root";
$BasePDO = null;

$BasePDO = new PDO("mysql:host=".$ipServerSQL.";dbname=".$NomBase.";", $UserBDD, $PassBDD);


   
?>
<form action="" method="post">
<div class="container">
    <div class="form">
        <input id="DonneAEnvoyer" type="text" class="input" name="tache" autocomplete="off"/>
        <input type="submit" class="add" value="Add Task" name="envoyer"/>
    </div>
    <div class="tasks">
    <?php

if (isset($_POST["envoyer"])) {
    # code...
    echo $_POST["tache"];
}else{
    echo("");
}

?>
    </div>
    <div class="delete-all">Delete all</div>
    </div>
</form>

</body>
<script>
// Créer un tableau pour stocker les tâches
let tasks = [];

// Ajouter une tâche à la liste et trier la liste par ordre alphabétique
function addTask(task) {
  tasks.push(task);
  tasks.sort(function(a, b) {
    var textA = a.toUpperCase();
    var textB = b.toUpperCase();
    return (textA < textB) ? -1 : (textA > textB) ? 1 : 0;
  });
}

// Supprimer une tâche de la liste
function deleteTask(task) {
  const index = tasks.indexOf(task);
  if (index > -1) {
    tasks.splice(index, 1);
  }
}

// Obtenir la liste complète des tâches
function getTasks() {
  return tasks;
}

// Exporter les fonctions de l'API
module.exports = {
  addTask,
  deleteTask,
  getTasks,
};
</script>
</html>


