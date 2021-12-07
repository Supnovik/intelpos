<?php

namespace Intelpos\Model;

use PDOException;

class user extends database
{

    public function createTable()
    {
        $array = ['setofcards VARCHAR(90)'];
        $string = '';
        foreach($array as $value){
            $string = "$string, $value";
        }
        try {
            $sql = "CREATE TABLE $this->table (id integer auto_increment primary key $string)";
            $this->databaseConnection->exec($sql);
        } catch (PDOException $e) {
            echo 'Database error: '.$e->getMessage();
        }
    }

    public function addSetOfCards($setofcards)
    {
        $content = [['setofcards',$setofcards]];
        $type ='';
        $value = '';
        foreach($content as $val){
            $type ="$type,". $val[0];
            $value = "$value,". $val[1].'"';
        }
        $type = substr($type, 1);
        $value = substr($value, 1);
        try {
            $sql = "INSERT INTO $this->table ($type) VALUES ($value)";
            $this->databaseConnection->exec($sql);
        } catch (PDOException $e) {
            echo 'Database error: '.$e->getMessage();
        }
    }

    public function getSetOfCardsList()
    {
        $content = [];
        try {
            $sql = 'SELECT * FROM '.$this->table;
            $result = $this->databaseConnection->query($sql);
            while ($row = $result->fetch()) {
                $content[] = ['setofcards' => $row['setofcards']];
            }
        } catch (PDOException $e) {
            echo 'Database error: '.$e->getMessage();
        }

        return $content;
    }

    public function checkingSetofcardsForExistence($setofcards)
    {
        try {
            $content = [];

            $sql = 'SELECT * FROM '.$this->table.' WHERE setofcards = "'.$setofcards.'"';
            $result = $this->databaseConnection->query($sql);
            while ($row = $result->fetch()) {
                $content[] = ['setofcards' => (string)$row['setofcards']];
            }
            if (count($content) != 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo 'Database error: '.$e->getMessage();
        }
    }

    public function deleteSetOfCards($setofcards)
    {
        try {
            $sql = 'DELETE FROM '.$this->table.' WHERE setofcards = "'.$setofcards.'"';
            $this->databaseConnection->exec($sql);
        } catch (PDOException $e) {
            echo 'Database error: '.$e->getMessage();
        }
    }
}