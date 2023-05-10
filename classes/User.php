<?php
class User
{
    //propriétés private
    private $id_;
    private $pseudo_;
    private $email_;

    //méthodes publiques
    public function __construct($id, $pseudo, $email)
    {
        $this->id_ = $id;
        $this->pseudo_ = $pseudo;
        $this->email_ = $email;

        $host = "192.168.65.36";
        $dbname = "to_do_list";
        $user = "root";
        $password = "root";

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

        // requête permettant re récuperer l'id du User afin de pouvoir ajouter une tache dans la to do list
        $requete2 = "select `id` from user where `email` = '" . $email . "' && `mdp` = '" . $hashed_password . "'";
        $resultat2 = $GLOBALS["pdo"]->query($requete2);
        $resultat2 = $resultat2->fetch();

        $count = $resultat->rowCount();
        // si il n'y a qu'un seul résultat
        if ($count == 1) {
            $_SESSION["trueconnect"] = true;
            // On créer une variable session afin de faciliter l'envoi des informations
            $_SESSION["idUser"] = $resultat2[0];
?>
            <script>
                window.location.replace("phpObj.php");
            </script>
        <?php
        } else {
            $_SESSION["erreur"] = 1;
        }
    }

    public function Register($pseudo, $email, $password)
    {
        //cryptage du mot de passe pour l'envoyer en crypté dans la BDD
        $hashed_password = hash('sha512', $password);

        $requete3 = "select `pseudo` from user where `email` = '" . $email . "' && `pseudo` = '" . $pseudo . "'";
        $resultat3 = $GLOBALS["pdo"]->query($requete3);
        $resultat3 = $resultat3->fetchall();
        // Le résultat est donc un tableau de tableau

        // boucle qui permet de comparer chaque indice du tableau de tableau résultat3
        for ($i = 0; $i < sizeof($resultat3); $i++) {

            // si le pseudo est déjà utilisé
            if ($pseudo == $resultat3[$i][0]) {
                $_SESSION["erreurpseudo"] = 1;
            }
           
        }
        if ($_SESSION["erreurpseudo"] != 1) {
   
            // $requete qui permet d'inscrire l'utilisateur en insérant les valeurs données
            $requete = "INSERT INTO `user`(pseudo, email, mdp) VALUES ('" . $pseudo . "','" . $email . "','" . $hashed_password . "')";
            $resultat = $GLOBALS["pdo"]->query($requete);
            //resultat est du coup un objet de type PDOStatement

            $requete2 = "select `id` from user where `email` = '" . $email . "' && `mdp` = '" . $hashed_password . "'";
            $resultat2 = $GLOBALS["pdo"]->query($requete2);
            $resultat2 = $resultat2->fetch();

            $_SESSION["trueconnect"] = true;
            $_SESSION["idUser"] = $resultat2[0];
        ?>
            <script>
                window.location.replace("phpObj.php");
            </script>
<?php
        }
    }
}
?>