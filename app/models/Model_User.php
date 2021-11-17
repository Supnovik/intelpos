<?php

class Model_User extends Model_Database
{

    public function createDatabase()
    {
        try {

            $conn = new PDO("mysql:host=localhost", $this->user, $this->password);
            $sql = "CREATE DATABASE $this->database";
            $conn->exec($sql);
            echo "Database $this->database has been created";
            $conn = null;
        } catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }

    }

    public function createTable()
    {
        try {
            $conn = new PDO("mysql:host=localhost;dbname=$this->database", $this->user, $this->password);
            $sql = "create table $this->table (id integer auto_increment primary key, setofcards VARCHAR(30));";
            $conn->exec($sql);
            echo "Table $this->table has been created";
            $conn = null;
        } catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }
    }

    public function addContent($setofcards)
    {

        try {
            $conn = new PDO("mysql:host=localhost;dbname=$this->database", $this->user, $this->password);
            $sql = "INSERT INTO $this->table (setofcards) VALUES ('$setofcards')";
            $affectedRowsNumber = $conn->exec($sql);
            $conn = null;
            echo "В таблицу $this->table добавлено строк: $affectedRowsNumber";
        } catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }
    }

    public function getContent()
    {
        $content = array();
        try {
            $conn = new PDO('mysql:host=localhost;dbname=' . $this->database, $this->user, $this->password);
            $sql = 'SELECT * FROM ' . $this->table;
            $result = $conn->query($sql);
            $conn = null;
            while ($row = $result->fetch()) {
                $content[] = array('setofcards' => $row['setofcards']);
            }
        } catch (PDOException $e) {
            echo 'Database error: ' . $e->getMessage();
        }
        return $content;
    }

    public function checking_setofcards_for_existence($setofcards)
    {
        try {
            $content = array();
            $conn = new PDO("mysql:host=localhost;dbname=$this->database", $this->user, $this->password);
            $sql = "SELECT * FROM $this->table WHERE setofcards = '$setofcards'";
            $result = $conn->query($sql);
            while ($row = $result->fetch()) {
                $content[] = array('setofcards' => (string)$row["setofcards"]);
            }
            if (count($content) != 0)
                return true;
            else
                return false;
        } catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }
    }

    public function deleteContent($setofcards)
    {
        try {
            $conn = new PDO('mysql:host=localhost;dbname=' . $this->database, $this->user, $this->password);
            $sql = "DELETE FROM $this->table WHERE setofcards = '$setofcards'";
            $affectedRowsNumber = $conn->exec($sql);
            $conn = null;
            echo "Удалено строк: $affectedRowsNumber";
        } catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }
    }

}