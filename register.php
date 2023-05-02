<?php
include("session.php");
$_SESSION["trueconnect"] = false;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="./css/main.css">
  <link rel="icon" type="image/ico" sizes="700x700" href="./img/icone.jpg">
  <title>Register</title>
</head>
    <body>


    <?php
        
        try {
    


            if(isset($_POST["register"]) && $_POST["password"] == $_POST["password2"])
            {
                $TheUser->Register($_POST["pseudo"],$_POST["email"],$_POST["password"]);
            }
        
        } catch (Exception  $error) {
            echo "error est : ".$error->getMessage();
        }

    ?>

        <section>
            <div class="form-box">
                <div class="form-value">
                    <form action="" method="post">
                        <h2>Register</h2>
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
                        <div class="inputbox">
                            <ion-icon name="lock-closed-outline"></ion-icon>
                            <input type="password" name="password2" minlength="3" maxlength="50" required>
                            <label for="">Confirm Password</label>
                        </div>
                        <div class="inputbox">
                            <ion-icon name="lock-closed-outline"></ion-icon>
                            <input type="text" name="pseudo" minlength="3" maxlength="50" required>
                            <label for="">Pseudo</label>
                        </div>
                        <div class="forget">
                            <label for=""><input type="checkbox">Remember Me  </label>
                        
                        </div>
                        <button name="register">Register</button>
                        <div class="register">
                            <p>Already have a account ? <a href="index.php">Log in</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    </body>
</html>