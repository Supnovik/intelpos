<?php

class Model_Database
{
    protected $user = "Supnovik";
    protected $password = "qwe123";
    protected $database = "data";
    protected $table = "users";
    protected $isConnected = false;
    protected $databaseConnection;
    

    public function __construct($database, $table)
    {
        $this->database = $database;
        $this->table = $table;
        try{
            $connection = new PDO('mysql:host=localhost;dbname=' . $this->database, $this->user, $this->password);
            if ($connection)
            {
                $this->databaseConnection = $connection;
                $this->isConnected = true;
            }
            else
                $this->isConnected = false;
        }catch (PDOException $e) {
            echo 'Database error: ' . $e->getMessage();
        }
    }


    public function createDatabase($databaseName)
    {
        try {
            $sql = "CREATE DATABASE $databaseName";
            $this->databaseConnection->exec($sql);
             
        } catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }

    }

    public function addUser($nickname, $mail, $password)
    {
        try {
            
            $sql = "INSERT INTO $this->table (nickname, mail ,password) VALUES ('$nickname','$mail','$password')";
             $this->databaseConnection->exec($sql);
            
        } catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }
    }

    public function getUsers()
    {
        $content = [];
        try {
            
            $sql = "SELECT * FROM $this->table";
            $result = $this->databaseConnection->query($sql);
            while ($row = $result->fetch()) {
                $content[] = ['nickname' => (string)$row["nickname"], 'mail' => (string)$row["mail"]];
            }
        } catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }
        return $content;
    }

    public function serchUsers($uset)
    {
        $content = [];
        try {
            
            $sql = 'SELECT * FROM ' . $this->table . ' WHERE nickname like "'. $uset .'%"' ;
            $result = $this->databaseConnection->query($sql);
            while ($row = $result->fetch()) {
                $content[] = ['nickname' => (string)$row["nickname"], 'mail' => (string)$row["mail"]];
            }
        } catch (PDOException $e) {
            echo 'Database error: ' . $e->getMessage();
        }
        return $content;
    }


    public function checking_for_existence($nickname,$password=null)
    {
        try {
            $content = [];
            
            if ($password == null)
                $sql = "SELECT * FROM $this->table WHERE nickname = '$nickname'";
            else
                $sql = "SELECT * FROM $this->table WHERE nickname = '$nickname' AND password = '$password'";
            $result = $this->databaseConnection->query($sql);
            while ($row = $result->fetch()) {
                $content[] = ['nickname' => (string)$row["nickname"], 'mail' => (string)$row["mail"]];
            }
            if (count($content)!=0)
                return true;
            else
                return false;
        } catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }
    }

    /*

        public function createTable(){
            try {
                
                $sql = "create table $this->table (id integer auto_increment primary key, nickname VARCHAR(30), mail VARCHAR(30), password VARCHAR(30));";
                $conn->exec($sql);
                 
            }
            catch (PDOException $e) {
                echo "Database error: " . $e->getMessage();
            }
        }

        public function getContent(){
            $content = array(array('nickname'=> 'Supnovik','mail'=>'Sup'));
            try {
                
                $sql = "SELECT * FROM $this->table";
                $result = $conn->query($sql);
                while($row = $result->fetch()){
                    $content[] = array('nickname' => (string)$row["nickname"],'mail' =>(string)$row["mail"]);
                }
            }
            catch (PDOException $e) {
                echo "Database error: " . $e->getMessage();
            }
            return $content;
        }

        public function deleteContent($mail){
            try {
                
                $sql = "DELETE FROM $this->table WHERE mail = '$mail'";
                 $conn->exec($sql);
                 
            }
            catch (PDOException $e) {
                echo "Database error: " . $e->getMessage();
            }
        }
        */
}

        

       