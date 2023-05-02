<?php
include("session.php");
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
     $_SESSION["erreur"] = 0;
    try {
        if (isset($_POST["login"])) 
        {
            $TheUser->seConnecter($_POST["email"],$_POST["password"]);
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
                    if ($_SESSION["erreur"] == 1) {
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