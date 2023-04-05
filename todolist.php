<!--<!DOCTYPE html>
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
Entrer du texte : <input id="DonneAEnvoyer" type="text" name="tache"/>
<input type="submit" name="envoyer"/>
</form>
<?php

    if (isset($_POST["envoyer"])) {
        # code...
        echo $_POST["tache"];
    }else{
        echo("tache");
    }
    $req = "INSERT INTO `tache` (`id`, `nomtache`, `idUser`) VALUES (NULL,'".$_POST["tache"]."', '2')";
?>
</body>
</html>
