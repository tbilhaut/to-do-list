<?php  include("../classes/Database.php");

if(isset($_POST["idTaches"])){

    $ids = explode(",", $_POST["idTaches"]);

    if(count($ids)>0){
       

        try {
            $ParamAsupprimer = "";

            foreach ($ids as $id) {
                $ParamAsupprimer =  $ParamAsupprimer.'?,';
            }
            $ParamAsupprimer = substr($ParamAsupprimer, 0, strlen($ParamAsupprimer)-1);
            $database = new Database("192.168.65.36", "to_do_list", "root", "root");
            $query = "DELETE FROM `tache` WHERE id in (".$ParamAsupprimer.")";
            $PDOstatement = $database->executeQuery($query, $ids );
            if($PDOstatement->rowCount()>0){
                $retour[0] = "ok";
            }
        } catch (\Throwable $th) {
            $retour[0]= "ko";
        }

       


        

    }else{
        $retour[0] = "ko";
    }
}else{
    $retour[0] = "ko";
}



//il est preferable de retourner un string compatible JSON qui sera encodé via la méthode json_encode.

echo  json_encode($retour);


?>