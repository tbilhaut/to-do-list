<?php 
    session_start(); 
    echo "tu es co bg";
?> 

<p>
<form action="" method="post" class="form-example">
    <div class="form-example">
        <input type="submit" value="Deconnexion" name="Deconnexion" >
    </div>
</form>
</p>

<?php
    if(isset($_POST["Deconnexion"]))
    {   
        //Si on appuie sur le bouton "Deconnexion", on supprime les données de la session et on la détruit (on ne peut pas la détruire car on l'a déjà unset).
        session_unset();
        session_destroy();
        ?>
        <script>
            window.location.replace("index.php");
        </script>
        <?php
    }
?>