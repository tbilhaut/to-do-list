<?php
session_start();
if ($_SESSION["trueconnect"] != true) {
?>
    <script>
        window.location.replace("../indexx.php");
    </script>
<?php
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width>, initial-scale=1.0">
    <title>ToDoList</title>
    
    <link rel="stylesheet" href="./css/style.css">
    
    
</head>

<body>

    <?php




    try { // Connexion à la base de donnée 
        $ipserver = "192.168.65.36";
        $nomBase = "to_do_list";
        $loginPrivilege = "root";
        $passPrivilege = "root";

        $GLOBALS["pdo"] = new PDO('mysql:host=' . $ipserver . ';dbname=' . $nomBase . '', $loginPrivilege, $passPrivilege);

    ?>

        <div class="header">
            <p class="header_titre">Ma super Todo List ! </p>
        </div>


        <form class="taches_input" method="post" action="">


            <input id="inserer" type="text" name="creer_tache" />
            <button id="envoyer">Créer</button>
        </form>


        <?php
        if (isset($erreurs)) {
        ?>
            <p><?php echo $erreurs ?></p>
        <?php
        }
        ?>


        <table class="taches">
            <tr>
                <th>
                    Numero tache
                </th>
                <th>
                    Nom tache
                </th>
                <th>
                    Pseudo
                </th>
                <th>
                    Action
                </th>
            </tr>
            <?php
            $reponse = "SELECT * FROM tache,user where tache.idUser = user.id"; // On exécute une requête visant à récupérer les tâches
            $resultat = $GLOBALS["pdo"]->query($reponse);
            while ($taches = $resultat->fetch()) { // On initialise une boucle
            ?>
                <tr>
                    <td><?php echo $taches['id'] ?></td>
                    <td><?php echo $taches['nomtache'] ?></td>
                    <td><?php echo $taches['pseudo'] ?></td>
                    <td>
                        <a class="suppr" href="index.php?supprimer_tache=<?php echo $taches['id'] ?>"> X</a>
                    </td>
                </tr>
        <?php
            }
        } catch (Exception $error) {
            echo "error est : " . $error->getMessage();
        }


        ?>


        </table>
</body>

</html>