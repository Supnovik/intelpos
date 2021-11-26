<?php

namespace Intelpos\Model;

use Config;
use PDO;
use PDOException;

class database
{
    public $user = '';
    public $password = '';
    public $database = 'data';
    public $table = 'users';
    public $isConnected = false;
    public $databaseConnection;

    public function __construct($database, $table)
    {
        $config = new Config;
        $this->user = $config->user;
        $this->password = $config->password;
        $this->database = $database;
        $this->table = $table;
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

    public function addUser($nickname, $mail, $password)
    {
        try {
            $sql = 'INSERT INTO '.$this->table.' (nickname, mail ,password) VALUES ("'.$nickname.'","'.$mail.'","'.$password.'")';
            $this->databaseConnection->exec($sql);
        } catch (PDOException $e) {
            echo 'Database error: '.$e->getMessage();
        }
    }

    public function getUsers()
    {
        $content = [];
        try {
            $sql = 'SELECT * FROM '.$this->table;
            $result = $this->databaseConnection->query($sql);
            while ($row = $result->fetch()) {
                $content[] = ['nickname' => $row['nickname'], 'mail' => $row['mail']];
            }
        } catch (PDOException $e) {
            echo 'Database error: '.$e->getMessage();
        }

        return $content;
    }

    public function serchUsers($uset)
    {
        $content = [];
        try {
            $sql = 'SELECT * FROM '.$this->table.' WHERE nickname like "'.$uset.'%"';
            $result = $this->databaseConnection->query($sql);
            while ($row = $result->fetch()) {
                $content[] = ['nickname' => $row['nickname'], 'mail' => $row['mail']];
            }
        } catch (PDOException $e) {
            echo 'Database error: '.$e->getMessage();
        }

        return $content;
    }


    public function checkingForExistence($nickname, $password = null)
    {
        try {
            $content = [];

            if ($password == null) {
                $sql = 'SELECT * FROM '.$this->table.' WHERE nickname = "'.$nickname.'"';
            } else {
                $sql = 'SELECT * FROM '.$this->table.' WHERE nickname = "'.$nickname.'" AND password = "'.$password.'"';
            }
            $result = $this->databaseConnection->query($sql);
            while ($row = $result->fetch()) {
                $content[] = ['nickname' => $row['nickname'], 'mail' => $row['mail']];
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

    public function deleteUser($user)
    {
        try {
            $sql = 'DELETE FROM '.$this->table.' WHERE nickname = "'.$user.'"';
            $this->databaseConnection->exec($sql);
            $sql = 'DROP DATABASE '.$user;
            $this->databaseConnection->exec($sql);
        } catch (PDOException $e) {
            echo 'Database error: '.$e->getMessage();
        }
    }
}

        

       