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
        } catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }

    }

    public function createTable()
    {
        try {
            $conn = new PDO("mysql:host=localhost;dbname=$this->database", $this->user, $this->password);
            $sql = "create table $this->table (id integer auto_increment primary key, setofcards VARCHAR(30), backdrop VARCHAR(30));";
            $conn->exec($sql);
            echo "Table $this->table has been created";
        } catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }
    }

    public function addContent($setofcards, $backdrop)
    {

        try {
            $conn = new PDO("mysql:host=localhost;dbname=$this->database", $this->user, $this->password);
            $sql = "INSERT INTO $this->table (setofcards, backdrop) VALUES ('$setofcards','$backdrop')";
            $affectedRowsNumber = $conn->exec($sql);
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
            while ($row = $result->fetch()) {
                $content[] = array('setofcards' => $row['setofcards'], 'backdrop' => $row['backdrop']);
            }
        } catch (PDOException $e) {
            echo 'Database error: ' . $e->getMessage();
        }
        return $content;
    }

    public function deleteContent($setofcards)
    {
        try {
            $conn = new PDO('mysql:host=localhost;dbname=' . $this->database, $this->user, $this->password);
            $sql = "DELETE FROM $this->table WHERE setofcards = '$setofcards'";
            $affectedRowsNumber = $conn->exec($sql);
            echo "Удалено строк: $affectedRowsNumber";
        } catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }
    }

}