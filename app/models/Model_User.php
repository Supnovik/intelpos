<?php

class Model_User extends Model_Database
{

    public function createDatabase()
    {
        try {
            $sql = "CREATE DATABASE $this->database";
            $this->databaseConnection->exec($sql);
            echo "Database $this->database has been created";
        } catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }
    }

    public function createTable()
    {
        try {
            $sql = "create table $this->table (id integer auto_increment primary key, setofcards VARCHAR(30));";
            $this->databaseConnection->exec($sql);
            echo "Table $this->table has been created";
        } catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }
    }

    public function addContent($setofcards)
    {

        try {
            
            $sql = "INSERT INTO $this->table (setofcards) VALUES ('$setofcards')";
            $affectedRowsNumber = $this->databaseConnection->exec($sql);
            echo "В таблицу $this->table добавлено строк: $affectedRowsNumber";
        } catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }
    }

    public function getContent()
    {
        $content = array();
        try {
            
            $sql = 'SELECT * FROM ' . $this->table;
            $result = $this->databaseConnection->query($sql);
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
            
            $sql = "SELECT * FROM $this->table WHERE setofcards = '$setofcards'";
            $result = $this->databaseConnection->query($sql);
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
            
            $sql = "DELETE FROM $this->table WHERE setofcards = '$setofcards'";
            $affectedRowsNumber = $this->databaseConnection->exec($sql);
            echo "Удалено строк: $affectedRowsNumber";
        } catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }
    }

}