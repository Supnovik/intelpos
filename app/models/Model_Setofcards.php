<?php
class Model_Setofcards extends Model_Database{

    public function createTable(){
        try {
            $conn = new PDO("mysql:host=localhost;dbname=$this->database", $this->user, $this->password);
            $sql = "create table $this->table (id integer auto_increment primary key, termin VARCHAR(30), definition VARCHAR(30), level INT DEFAULT 0);";
            $conn->exec($sql);
            echo "Table $this->table has been created";
        }
        catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }
    }

    public function addContent($termin,$definition){
        try {
            $conn = new PDO("mysql:host=localhost;dbname=$this->database", $this->user, $this->password);
            $sql = "INSERT INTO $this->table (termin, definition, level) VALUES ('$termin','$definition')";
            $affectedRowsNumber = $conn->exec($sql);
            echo "В таблицу $this->table добавлено строк: $affectedRowsNumber";
        }
        catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }
    }

    public function getContent(){
        $content = array(array('termin'=> 'Supnovik','definition'=>'Sup','level'=>10));
        try {
            $conn = new PDO('mysql:host=localhost;dbname='.$this->database, $this->user, $this->password);
            $sql = 'SELECT * FROM '. $this->table;
            $result = $conn->query($sql);
            while($row = $result->fetch()){
                $content[] = array('termin' => $row['termin'],'definition' =>$row['definition'],'level' =>$row['level']);
            }
        }
        catch (PDOException $e) {
            echo 'Database error: ' . $e->getMessage();
        }
        return $content;
    }

    public function deleteContent($termin){
        try {
            $conn = new PDO('mysql:host=localhost;dbname='.$this->database, $this->user, $this->password);
            $sql = "DELETE FROM $this->table WHERE termin = '$termin'";
            $affectedRowsNumber = $conn->exec($sql);
            echo "Удалено строк: $affectedRowsNumber";
        }
        catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }
    }

}