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
<?php
$ipServerSQL = "192.168.65.36";
$NomBase = "to_do_list";
$UserBDD = "root";
$PassBDD = "root";
$BasePDO = null;

$BasePDO = new PDO("mysql:host=".$ipServerSQL.";dbname=".$NomBase.";", $UserBDD, $PassBDD);

if (isset($_POST["envoyer"]) && !empty($_POST["tache"])) {
  $tache = $_POST["tache"];
  $date_heure = date("Y-m-d H:i:s"); // date et heure actuelles
  $idUser = 1; // ID de l'utilisateur actuellement connecté (à remplacer par votre propre système d'authentification)
  
  $requete = $BasePDO->prepare("INSERT INTO tache (nomtache, `date-heure`, idUser) VALUES (?, ?, ?)");
  $requete->execute([$tache, $date_heure, $idUser]);
}

if (isset($_POST["supprimer"])) {
  $id = $_POST["id"];
  $requete = $BasePDO->prepare("DELETE FROM tache WHERE id = ?");
  $requete->execute([$id]);
}

$requete = $BasePDO->query("SELECT * FROM tache ORDER BY nomtache ASC"); // tri par ordre alphabétique
$taches = $requete->fetchAll(PDO::FETCH_ASSOC);
?>

<form action="" method="post">
  <div class="container">
    <div class="form">
      <input id="DonneAEnvoyer" type="text" class="input" name="tache" autocomplete="off"/>
      <input type="submit" class="add" value="Add Task" name="envoyer"/>
    </div>
    <div class="tasks">
      <?php foreach ($taches as $tache) { ?>
        <div class="task">
          <span><?php echo $tache["nomtache"]; ?></span>
          <form action="" method="post">
            <input type="hidden" name="id" value="<?php echo $tache["id"]; ?>"/>
            <input type="submit" class="delete" value="Delete" name="supprimer"/>
          </form>
        </div>
      <?php } ?>
    </div>
    <div class="delete-all">Delete all</div>
  </div>
</form>
