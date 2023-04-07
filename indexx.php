<?php
session_start();
$_SESSION["trueconnect"] = false;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="./css/main.css">
    <link rel="icon" type="image/ico" sizes="700x700" href="./img/icone.jpg">
    <title>Login</title>
</head>

<body>

    <?php

    try {

        /*
            $requete4 = "UPDATE `user` SET idSecretaire = '".$_POST["laSecretaire"]."' WHERE Medecin.id = ".$_POST["IdMedecin"]."";
            $resultat4 = $GLOBALS["pdo"]->query($requete4);
            //resultat est du coup un objet de type PDOStatement
           
            $requete = "select * from user";
            $resultat = $GLOBALS["pdo"]->query($requete);
            //resultat est du coup un objet de type PDOStatement
            $tabuser = $resultat->fetchALL();
            */
        $erreur = 0;
        $count = 0;

        $ipserver = "192.168.65.36";
        $nomBase = "to_do_list";
        $loginPrivilege = "root";
        $passPrivilege = "root";

        $GLOBALS["pdo"] = new PDO('mysql:host=' . $ipserver . ';dbname=' . $nomBase . '', $loginPrivilege, $passPrivilege);


        if (isset($_POST["login"])) {

            // $requete = "select * from user";
            $requete = "select * from user where `email` = '" . $_POST["email"] . "' && `mdp` = '" . $_POST["password"] . "'";
            $resultat = $GLOBALS["pdo"]->query($requete);
            //resultat est du coup un objet de type PDOStatement

            $count = $resultat->rowCount();

            if ($count == 1) {
                $_SESSION["trueconnect"] = true;
    ?>
                <script>
                    window.location.replace("ToDoList/TODOLIST.php");
                </script>
    <?php
            } else {
                $erreur = 1;
            }
        }
    } catch (Exception  $error) {
        echo "error est : " . $error->getMessage();
    }

    ?>

    <section>
        <div class="form-box">
            <div class="form-value">
                <form action="" method="post">
                    <h2>Login</h2>
                    <div class="inputbox">
                        <ion-icon name="mail-outline"></ion-icon>
                        <input type="email" name="email" required>
                        <label for="">Email</label>
                    </div>
                    <div class="inputbox">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                        <input type="password" name="password" minlength="3" maxlength="50" required>
                        <label for="">Password</label>
                    </div>
                    <div class="forget">
                        <label for=""><input type="checkbox">Remember Me </label>

                    </div>
                    <?php
                    if ($erreur == 1) {
                    ?>
                        <div class="error">
                            <label for="">Password or Login error </label>
                        </div>
                    <?php
                    }
                    ?>
                    <div class="password">
                        <p><a href="cpasbien.php">Forget Password ?</a></p>

                    </div>
                    <button name="login">Log in</button>
                    <div class="register">
                        <p>Don't have a account ? <a href="register.php">Register</a></p>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>