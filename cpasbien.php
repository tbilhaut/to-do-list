<?php 
include("session.php");
$_SESSION["trueconnect"] = false;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <link rel="stylesheet" href="./css/main.css">
  <link rel="icon" type="image/ico" sizes="700x700" href="./img/icone.jpg">
  <title>Forget Password</title>
</head>
<body>
    <section>
        <div class="form-box">
            <div class="form-value">
                <form action="">
                    <h2>Tant pis</h2>
                    <div class="register">
                      <p>Fallait s'en souvenir <a href="connexion.php">Maintenant, direction accueil bg</a></p>
                  </div>
                </form>
            </div>
        </div>
    </section>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>