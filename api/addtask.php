<?php
include("../classes/Database.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Vérifier si le nom de la tâche a été envoyé
    if (isset($_POST['name'])) {

        $database = new Database("192.168.65.36", "to_do_list", "root", "root");


        // Récupérer le nom de la tâche envoyée en POST
        $taskName = $_POST['tache'];

        // Écrire la requête SQL pour insérer la nouvelle tâche
        $query = "INSERT INTO tache (nomtache, `date-heure`, idUser) VALUES (?, ?, ?)";

        // Exécuter la requête avec le nom de la tâche comme paramètre
        $PDOstatement = $database->executeQuery($query, array($taskName));

        // Vérifier si la requête a réussi
        if ($PDOstatement->rowCount() > 0) {
            // Retourner une réponse JSON avec un message de réussite
            echo json_encode(array("message" => "La tâche a été ajoutée avec succès"));
        } else {
            // Retourner une réponse JSON avec un message d'échec
            echo json_encode(array("message" => "Impossible d'ajouter la tâche"));
        }
    } else {
        // Retourner une réponse JSON avec un message d'erreur si le nom de la tâche n'a pas été envoyé
        echo json_encode(array("message" => "Le nom de la tâche n'a pas été envoyé"));
    }
} else {
    // Retourner une réponse JSON avec un message d'erreur si la méthode de requête HTTP n'est pas POST
    echo json_encode(array("message" => "Méthode de requête invalide"));
}




 