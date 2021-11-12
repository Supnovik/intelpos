<?php 
class Model_Profile{
    protected $user = "supnovik";
    protected $password = "qwe123";
    protected $database = "data";
    protected $table = "users";

    public function __construct($database,$table){
        $this->database=$database;
        $this->table =$table;
    }
    
    public function createTable(){
        try {
            $conn = new PDO("mysql:host=localhost;dbname=$this->database", $this->user, $this->password);
            $sql = "create table $this->table (id integer auto_increment primary key, setofcardsName VARCHAR(30), backdropName VARCHAR(30));";
            $conn->exec($sql);
            echo "Table $this->table has been created";
        }
        catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }
    }

    public function getContent(){
        
        $content = array(array('setofcards'=> 'Supnovik','backdrop'=>'Sup'));
        try {
            $conn = new PDO("mysql:host=localhost;dbname=$this->database", $this->user, $this->password);
            $sql = "SELECT * FROM $this->table";
            $result = $conn->query($sql);
            while($row = $result->fetch()){
                $content[] = array('setofcards' => (string)$row["setofcards"],'backdrop' =>(string)$row["backdrop"]);
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

        

       