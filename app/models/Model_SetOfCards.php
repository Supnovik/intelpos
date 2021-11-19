<?php

class Model_SetOfCards extends Model_Database
{
    public function get_data($user = null, $data = null)
    {
        if(array_key_exists('create-card', $_POST)) {
            $this->addCard(filter_var(trim($_POST['termin']),FILTER_SANITIZE_STRING),filter_var(trim($_POST['definition']),FILTER_SANITIZE_STRING));
            echo "<meta http-equiv='refresh' content='0'>";
        }
        if(array_key_exists('save-card', $_POST)) {
            $this->updateCard(filter_var(trim($_POST['oldtermin']),FILTER_SANITIZE_STRING),filter_var(trim($_POST['termin']),FILTER_SANITIZE_STRING),filter_var(trim($_POST['newdefinition']),FILTER_SANITIZE_STRING));
            echo "<meta http-equiv='refresh' content='0'>";
        }
        if(array_key_exists('delete-card', $_POST)) {
            $this->deleteCard(filter_var(trim($_POST['termin']),FILTER_SANITIZE_STRING));
            echo "<meta http-equiv='refresh' content='0'>";
        }
        if(array_key_exists('search-card-button', $_POST)) {
            return $this->serchCards(filter_var(trim($_POST['search-card']),FILTER_SANITIZE_STRING));

            //echo "<meta http-equiv='refresh' content='0'>";
        }
        return $this->getCards();
    }
    
    public function create_SetOfCards_Table()
    {
        try {
            $conn = new PDO("mysql:host=localhost;dbname=$this->database", $this->user, $this->password);
            $sql = "create table $this->table (id integer auto_increment primary key, termin VARCHAR(30), definition VARCHAR(30), level INT DEFAULT 0);";
            $conn->exec($sql);
            echo "Table $this->table has been created";
        } catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }
    }

    public function addCard($termin, $definition)
    {
        try {
            $conn = new PDO("mysql:host=localhost;dbname=$this->database", $this->user, $this->password);
            $sql = "INSERT INTO $this->table (termin, definition) VALUES ('$termin','$definition')";
            $affectedRowsNumber = $conn->exec($sql);
            echo "В таблицу $this->table добавлено строк: $affectedRowsNumber";
        } catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }
    }

    public function getCards()
    {
        $content = [];
        try {
            $conn = new PDO('mysql:host=localhost;dbname=' . $this->database, $this->user, $this->password);
            $sql = 'SELECT * FROM ' . $this->table;
            $result = $conn->query($sql);
            while ($row = $result->fetch()) {
                $content[] = ['termin' => $row['termin'], 'definition' => $row['definition'], 'level' => $row['level']];
            }
        } catch (PDOException $e) {
            echo 'Database error: ' . $e->getMessage();
        }
        return $content;
    }

    public function serchCards($card)
    {
        $content = [];
        try {
            $conn = new PDO('mysql:host=localhost;dbname=' . $this->database, $this->user, $this->password);
            $sql = 'SELECT * FROM ' . $this->table . ' WHERE termin like "'. $card .'%"' ;
            $result = $conn->query($sql);
            while ($row = $result->fetch()) {
                $content[] = ['termin' => $row['termin'], 'definition' => $row['definition'], 'level' => $row['level']];
            }
        } catch (PDOException $e) {
            echo 'Database error: ' . $e->getMessage();
        }
        return $content;
    }

    public function updateCard($oldtermin,$termin,$defition)
    {
        try {
            $conn = new PDO("mysql:host=localhost;dbname=$this->database", $this->user, $this->password);
            $sql = "UPDATE $this->table SET defition = '$defition' WHERE termin = '$oldtermin'";
            $sql = "UPDATE $this->table SET termin = '$termin' WHERE termin = '$oldtermin'";
            $affectedRowsNumber = $conn->exec($sql);
            echo "Удалено строк: $affectedRowsNumber";
        }
        catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }
    }

    public function deleteCard($termin)
    {
        try {
            $conn = new PDO("mysql:host=localhost;dbname=$this->database", $this->user, $this->password);
            $sql = "DELETE FROM $this->table WHERE termin = '$termin'";
            $affectedRowsNumber = $conn->exec($sql);
            echo "Удалено строк: $affectedRowsNumber";
        }
        catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }
    }


    public function deleteSetOfCards()
    {
        try {
            $conn = new PDO('mysql:host=localhost;dbname=' . $this->database, $this->user, $this->password);
            $sql = "Drop TABLE $this->table";
            $affectedRowsNumber = $conn->exec($sql);
            echo "Удалена таблица: $this->table";
        } catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }
    }

}