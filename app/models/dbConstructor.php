<?php

namespace Intelpos\Model;

use Config;
use PDO;
use PDOException;


class dbConstructor{
    public $user = '';
    public $password = '';
    public $database = 'data';
    public $table = 'users';
    public $isConnected = false;
    public $databaseConnection;

    public function __construct()
    {
        $config = new Config;
        $this->user = $config->user;
        $this->password = $config->password;
        try {
            $connection = new PDO('mysql:host=localhost;dbname='.$this->database, $this->user, $this->password);
            if ($connection) {
                $this->databaseConnection = $connection;
                $this->isConnected = true;
            } else {
                $this->isConnected = false;
            }
        } catch (PDOException $e) {
            echo 'Database error: '.$e->getMessage();
        }
    }

    public function createDatabase($databaseName)
    {
        try {
            $sql = 'CREATE DATABASE '.$databaseName;
            $this->databaseConnection->exec($sql);
        } catch (PDOException $e) {
            echo 'Database error: '.$e->getMessage();
        }
    }
    
    public function createTable($tableName,$array)
    {
        $array = ['setofcards VARCHAR(90)'];
        $string = '';
        foreach($array as $value){
            $string = "$string, $value";
        }
        try {
            $sql = "CREATE TABLE $tableName (id integer auto_increment primary key $string)";
            $this->databaseConnection->exec($sql);
        } catch (PDOException $e) {
            echo 'Database error: '.$e->getMessage();
        }
    }

    public function addContent($tableName,$content)
    {
        
        $type ='';
        $value = '';
        foreach($content as $val){
            $type ="$type,". $val[0];
            $value = "$value,'". $val[1]."'";
        }
        $type = substr($type, 1);
        $value = substr($value, 1);
        try {
            $sql = "INSERT INTO $tableName ($type) VALUES ($value)";
            $this->databaseConnection->exec($sql);
        } catch (PDOException $e) {
            echo 'Database error: '.$e->getMessage();
        }
    }

    public function getContent($tableName,$pattern,$search=null,$isStrongSearch = false,$byId = false)
    {
        $output = [];

        if ($search==null){
            $sql = "SELECT * FROM $tableName";
        }
        else{
            if($byId)
                $sql = "SELECT * FROM $tableName WHERE id = '$search'";
            else
            {
                $string='';
                foreach($search as $val){
                    if ($isStrongSearch)
                        $string = $string . $val['type']." like '".$val['content']."' AND ";
                    else
                        $string = $string . $val['type']." like '".$val['content']."%' AND ";
                }
                $string = rtrim($string, "AND ");
                $sql = "SELECT * FROM $tableName WHERE $string";
            }
        }
        try {
            $result = $this->databaseConnection->query($sql);
            while ($row = $result->fetch()) {
                $content = [];
                foreach($pattern as $type){
                    $content[$type] = $row[$type];
                }
                $output[] = $content;
            }
        } catch (PDOException $e) {
            echo 'Database error: '.$e->getMessage();
        }
        return $output;
    }

    public function sortContent($tableName,$pattern,$sortObj)
    {
        $output = [];
        try {
            $sql = "SELECT * FROM $tableName ORDER BY $sortObj";
            $result = $this->databaseConnection->query($sql);
            while ($row = $result->fetch()) {
                $content = [];
                foreach($pattern as $type){
                    $content[$type] = $row[$type];
                }
                $output[] = $content;
            }
        } catch (PDOException $e) {
            echo 'Database error: '.$e->getMessage();
        }
        return $output;
    }

    public function updateContent($tableName,$id,$pattern, $newValue)
    {
        try {
            foreach($pattern as $value){
                $sql = "UPDATE $tableName SET $value = '".$newValue[$value]."' WHERE id = '".$id."'";
                $this->databaseConnection->exec($sql);
            }
        } catch (PDOException $e) {
            echo 'Database error: '.$e->getMessage();
        }
    }

    public function deleteContent($tableName,$id)
    {
        try {
            $sql = 'DELETE FROM '.$tableName.' WHERE id = "'.$id.'"';
            $this->databaseConnection->exec($sql);
        } catch (PDOException $e) {
            echo 'Database error: '.$e->getMessage();
        }
    }

}
?>