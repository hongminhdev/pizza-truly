<?php
session_start();
class Database
{   
    private $host = 'us-cdbr-east-05.cleardb.net';
    private $db   = 'heroku_f55ec0edf93c70b';
    private $user = 'b6ad707a2c511c';
    private $pass = '96cfec98';
    private $port = "3306";
    private $charset = 'utf8mb4';
    private $options = [
        \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
        \PDO::ATTR_EMULATE_PREPARES   => false,
        \PDO::ATTR_STRINGIFY_FETCHES  => false
    ];
    private $conn;

    public function getConnection() {
        $this->conn = null;
        
        $dsn = "mysql:host=".$this->host.";dbname=".$this->db.";charset=".$this->charset.";port=".$this->port."";

        try {
            $this->conn = new \PDO($dsn, $this->user, $this->pass, $this->options);
            // echo "Connected successfully";
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }

        return $this->conn;
    }
}

?>