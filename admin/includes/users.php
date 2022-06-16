<?php

class UserClass 
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function userLogin($username, $password)
    {
        try {
            $sql = "SELECT * FROM `users` WHERE `username` = :username AND `password` = :password";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":username", $username, PDO::PARAM_STR);
            $stmt->bindParam(":password", $password, PDO::PARAM_STR);
            $stmt->execute();
    
            $count = $stmt->rowCount();
            $data = $stmt->fetch(PDO::FETCH_OBJ);
            if ($count) {
                $_SESSION['id'] = $data->id;
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo '{error:{"text":'. $e->getMessage() .'}}';
        }
        
    }
}

?>