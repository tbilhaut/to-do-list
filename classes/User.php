<?php

class User
{

    //propriétés private
    private $id_;
    private $pseudo_;
    private $email_;

    //méthodes public

    public function __construct($id, $pseudo, $email)
    {
        $this->id_ = $id;
        $this->pseudo_ = $pseudo;
        $this->email_ = $email;


        //              VERSION A LA PROVIDENCE
        $host= "192.168.65.36";
        $dbname = "todolist";
        $user = "root";
        $password= "root";


        /*              AVEC WAMP (A CHANGER)
        $ipserver = "localhost";
        $nomBase = "to_do_list";
        $loginPrivilege = "root";
        $passPrivilege = "";
 */
        $GLOBALS["pdo"] = new PDO('mysql:host=' .  $host . ';dbname=' .  $dbname . '', $user, $password);
    }

    public function seConnecter($email, $password)
    {
        //encryptage du mot de passe pour savoir si il correspond au mot de passe de la BDD
       
        $hashed_password = hash('sha512', $password);
        // $requete = "select * from user";
        $requete = "select * from user where `email` = '" . $email . "' && `mdp` = '" . $hashed_password . "'";
        $resultat = $GLOBALS["pdo"]->query($requete);
        //resultat est du coup un objet de type PDOStatement

        $count = $resultat->rowCount();
        // si il n'y a qu'un seul résultat
        if ($count == 1) {
            $_SESSION["trueconnect"] = true;
?>
            <script>
                window.location.replace("phpObjV2Junior.php");
            </script>
        <?php
        } else {
            $_SESSION["erreur"] = 1;
        }
    }

    public function Register($pseudo,$email, $password)
    {
        //cryptage du mot de passe pour l'envoyer en crypté dans la BDD
        $hashed_password = hash('sha512', $password);
     
        // $requete 
        $requete = "INSERT INTO `user`(pseudo, email, mdp) VALUES ('" . $pseudo . "','" . $email . "','" .$hashed_password . "')";
        $resultat = $GLOBALS["pdo"]->query($requete);
        //resultat est du coup un objet de type PDOStatement
        $_SESSION["trueconnect"] = true;
        


        ?>
        <script>
            window.location.replace("phpObjV2Junior.php");
        </script>
<?php
    }
}

?>