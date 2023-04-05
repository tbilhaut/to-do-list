<style>
body {
  background-color: #111;
  color: #ddd;
}

.container {
  width: 500px;
  margin: 20px auto;
}

.form {
  background-color: #333;
  border-radius: 6px;
  padding: 20px;
  display: flex;
  align-items: center;
}

.input {
  padding: 10px;
  border: 1px solid #555;
  border-radius: 6px;
  flex: 1;
  background-color: #444;
  color: #ddd;
}

.input:focus, .add:focus {
  outline: none;
}

.add {
  border: none;
  background-color: #f44336;
  color: #ddd;
  padding: 10px;
  border-radius: 6px;
  margin-left: 10px;
  cursor: pointer;
}

.tasks {
  background-color: #333;
  margin-top: 20px;
  border-radius: 6px;
  padding: 20px;
}

.tasks .task {
  background-color: #444;
  padding: 10px;
  border-radius: 6px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  transition: 0.3s;
  cursor: pointer;
  border: 1px solid #555;
}

.tasks .task:not(:last-child) {
  margin-bottom: 15px;
}

.tasks .task:hover {
  background-color: #555;
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
  color: #ddd;
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
  color: #ddd;
  background-color: #f44336;
  margin-top: 20px;
  cursor: pointer;
  border-radius: 4px;
}
</style>
<?php

include("classes/Database.php");

class Task
{
    private $database;
    
    public function __construct($database)
    {
        $this->database = $database;
    }
    
    public function addTask($name, $userId)
    {
        $date = date("Y-m-d H:i:s");
        $query = "INSERT INTO tache (nomtache, `date-heure`, idUser) VALUES (?, ?, ?)";
        $params = [$name, $date, $userId];
        $this->database->executeQuery($query, $params);
    }
    
    public function deleteTask($id)
    {
        $query = "DELETE FROM tache WHERE id = ?";
        $params = [$id];
        $this->database->executeQuery($query, $params);
    }
    
    public function getAllTasks()
    {
        $query = "SELECT * FROM tache ORDER BY nomtache ASC";
        $statement = $this->database->executeQuery($query);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
  
}

$database = new Database("192.168.65.36", "to_do_list", "root", "root");
$task = new Task($database);

if (isset($_POST["envoyer"]) && !empty($_POST["tache"])) {
  $tache = $_POST["tache"];
  $userId = 1; // ID de l'utilisateur actuellement connecté (à remplacer par votre propre système d'authentification)
  $task->addTask($tache, $userId);
}

if (isset($_POST["supprimer"])) {
  $id = $_POST["id"];
  $task->deleteTask($id);
}

$taches = $task->getAllTasks();
?>

<form action="" method="post">
  <div class="container">
    <div class="form">
      <input id="DonneAEnvoyer" type="text" class="input" name="tache" autocomplete="off"/>
      <input type="submit" class="add" value="Add Task" name="envoyer"/>
    </div>
    <div class="tasks" id="lesTaches">
      <?php foreach ($taches as $tache) { ?>
        <div class="task" id="<?php echo $tache["id"]; ?>">
          <span><?php echo $tache["nomtache"]; ?></span>
          <form action="" method="post">
            <input type="hidden" name="id" value="<?php echo $tache["id"]; ?>"/>
            <input type="submit" class="delete" value="Delete" name="supprimer"/>
          </form>
        </div>
      <?php } ?>
    </div>
    <div class="delete-all">Delete all V2 langlace</div>
  </div>
</form>
<script src="api.js">


</script>