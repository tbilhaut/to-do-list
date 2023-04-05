<?php class Database
{
    private $pdo;
    
    public function __construct($host, $dbname, $user, $password)
    {
        $this->pdo = new PDO("mysql:host=".$host.";dbname=".$dbname.";", $user, $password);
    }
    
    public function executeQuery($query, $params = [])
    {
        $statement = $this->pdo->prepare($query);
        $statement->execute($params);
        return $statement;
    }
}
?>