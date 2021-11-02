<?php 
        
class Controller_database extends Controller{
    private $user = "user";
    private $password = "password";
    private $database = "users";
    private $table = "todo_list";


    public function __construct(){

    }

    public function createDatabase($database){
        try {
            // подключаемся к серверу
            $conn = new PDO("mysql:host=localhost", $this->user, $this->password);
             
            // SQL-выражение для создания базы данных
            $sql = "CREATE DATABASE $database";
            // выполняем SQL-выражение
            $conn->exec($sql);
            echo "Database $database has been created";
        }
        catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }

    }



    public function createTable($table){
        try {
            // подключаемся к серверу
            $conn = new PDO("mysql:host=localhost;dbname=$this->database", $this->user, $this->password);
             
            // SQL-выражение для создания таблицы
            $sql = "create table $table (id integer auto_increment primary key, name varchar(30), age integer);";
            // выполняем SQL-выражение
            $conn->exec($sql);
            echo "Table $table has been created";
        }
        catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }

    }

    public function addContent($nickname,$mail,$password){
        try {
            $conn = new PDO("mysql:host=localhost;dbname=$this->database", $this->user, $this->password);

            // SQL-выражение для добавления данных
            $sql = "INSERT INTO $this->table (name, mail ,password) VALUES ($nickname,$mail,$password)";
             
            $affectedRowsNumber = $conn->exec($sql);
            echo "В таблицу $this->table добавлено строк: $affectedRowsNumber";
        }
        catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }
    }

    public function getContent(){
        try {
            $conn = new PDO("mysql:host=localhost;dbname=$this->database", $this->user, $this->password);
            $sql = "SELECT * FROM $this->database";
            $result = $conn->query($sql);
            echo "<table><tr><th>Id</th><th>Name</th><th>Age</th></tr>";
            while($row = $result->fetch()){
                echo "<tr>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["nickname"] . "</td>";
                    echo "<td>" . $row["password"] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        }
        catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }
    }

    public function deleteContent($id){
        try {
            $conn = new PDO("mysql:host=localhost;dbname=$this->database", $this->user, $this->password);
            $sql = "DELETE FROM $this->database WHERE id = $id";
            $affectedRowsNumber = $conn->exec($sql);
            echo "Удалено строк: $affectedRowsNumber";
        }
        catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }
    }
}

        

       