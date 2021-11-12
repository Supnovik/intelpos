<?php 
        
class Model_Database{
    protected $user = "supnovik";
    protected $password = "qwe123";
    protected $database = "data";
    protected $table = "users";


    public function __construct($database,$table){
        $this->database=$database;
        $this->table =$table;
    }

    public function createDatabase(){
        try {
            $conn = new PDO("mysql:host=localhost", $this->user, $this->password);
            $sql = "CREATE DATABASE $this->database";
            
            $conn->exec($sql);
            echo "Database $this->database has been created";
        }
        catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }

    }


    public function createTable(){
        try {
            $conn = new PDO("mysql:host=localhost;dbname=$this->database", $this->user, $this->password);
            $sql = "create table $this->table (id integer auto_increment primary key, nickname VARCHAR(30), mail VARCHAR(30), password VARCHAR(30));";
            $conn->exec($sql);
            echo "Table $this->table has been created";
        }
        catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }
    }

    public function getContent(){
        $content = array(array('nickname'=> 'Supnovik','mail'=>'Sup'));
        try {
            $conn = new PDO("mysql:host=localhost;dbname=$this->database", $this->user, $this->password);
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
            $conn = new PDO("mysql:host=localhost;dbname=$this->database", $this->user, $this->password);
            $sql = "DELETE FROM $this->table WHERE mail = '$mail'";
            $affectedRowsNumber = $conn->exec($sql);
            echo "Удалено строк: $affectedRowsNumber";
        }
        catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }
    }
}

        

       