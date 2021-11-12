<?php 
        
class Controller_database extends Controller{
    private $user = "supnovik";
    private $password = "qwe123";
    private $database = "Supnovik";
    private $table = "Supnovik";

    public function createDatabase($database){
        try {
            
            $conn = new PDO("mysql:host=localhost", $this->user, $this->password);
            $sql = "CREATE DATABASE $database";
            $conn->exec($sql);
            echo "Database $database has been created";
        }
        catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }

    }



    /*public function createTable(){
        try {
            $conn = new PDO("mysql:host=localhost;dbname=$this->database", $this->user, $this->password);
            $sql = "create table $this->table (id integer auto_increment primary key, nickname VARCHAR(30), mail VARCHAR(30), password VARCHAR(30));";
            
            $conn->exec($sql);
            echo "Table $this->table has been created";
        }
        catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }

    }*/

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

    public function addContent($nickname,$mail,$password){
        echo $nickname;
        try {
            $conn = new PDO("mysql:host=localhost;dbname=$this->database", $this->user, $this->password);
            $sql = "INSERT INTO $this->table (nickname, mail ,password) VALUES ('$nickname','$mail','$password')";
            $affectedRowsNumber = $conn->exec($sql);
            echo "В таблицу $this->table добавлено строк: $affectedRowsNumber";
        }
        catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }
    }

    public function getContent($table){
        try {
            $conn = new PDO("mysql:host=localhost;dbname=$this->database", $this->user, $this->password);
            $sql = "SELECT * FROM $table";
            $result = $conn->query($sql);
            echo "<table><tr><th>Nickname</th><th>Mail</th><th>Password</th></tr>";
            while($row = $result->fetch()){
                echo "<tr>";
                    echo "<td>" . $row["nickname"] . "</td>";
                    echo "<td>" . $row["mail"] . "</td>";
                    echo "<td>" . $row["password"] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        }
        catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }
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

        

       