<?php

namespace Intelpos\Model;

use PDOException;

class setOfCards extends database
{
    public function getData($user = null, $data = null)
    {
        return $this->getCards();
    }

    public function createSetOfCards()
    {
        try {
            $sql = 'create table '.$this->table.' (id integer auto_increment primary key, termin VARCHAR(30), definition VARCHAR(30), level INT DEFAULT 0);';
            $this->databaseConnection->exec($sql);
            $sql = 'create table '.$this->table.'_BackdropsList (id integer auto_increment primary key, backdrop VARCHAR(30), image BLOB DEFAULT null);';
            $this->databaseConnection->exec($sql);
            $sql = 'create table '.$this->table.'_Comments (id integer auto_increment primary key, nickname VARCHAR(30), text VARCHAR(30));';
            $this->databaseConnection->exec($sql);
        } catch (PDOException $e) {
            echo 'Database error: '.$e->getMessage();
        }
    }

    public function addCard($termin, $definition)
    {
        try {
            $sql = 'INSERT INTO '.$this->table.' (termin, definition) VALUES ("'.$termin.'","'.$definition.'")';
            $this->databaseConnection->exec($sql);
        } catch (PDOException $e) {
            echo 'Database error: '.$e->getMessage();
        }
    }

    public function addComment($nickname, $text)
    {
        try {
            $sql = 'INSERT INTO '.$this->table.'_Comments (nickname, text) VALUES ("'.$nickname.'","'.$text.'")';
            $this->databaseConnection->exec($sql);
        } catch (PDOException $e) {
            echo 'Database error: '.$e->getMessage();
        }
    }

    public function getCards()
    {
        $content = [];
        try {
            $sql = 'SELECT * FROM '.$this->table;
            $result = $this->databaseConnection->query($sql);
            while ($row = $result->fetch()) {
                $content[] = ['termin' => $row['termin'], 'definition' => $row['definition'], 'level' => $row['level']];
            }
        } catch (PDOException $e) {
            echo 'Database error: '.$e->getMessage();
        }

        return $content;
    }

    public function getComments()
    {
        $content = [];
        try {
            $sql = 'SELECT * FROM '.$this->table.'_Comments';
            $result = $this->databaseConnection->query($sql);
            while ($row = $result->fetch()) {
                $content[] = ['nickname' => $row['nickname'], 'text' => $row['text']];
            }
        } catch (PDOException $e) {
            echo 'Database error: '.$e->getMessage();
        }

        return $content;
    }

    public function sortByAlphabet()
    {
        $content = [];
        try {
            $sql = 'SELECT * FROM '.$this->table.' ORDER BY termin';
            $result = $this->databaseConnection->query($sql);
            while ($row = $result->fetch()) {
                $content[] = ['termin' => $row['termin'], 'definition' => $row['definition'], 'level' => $row['level']];
            }
        } catch (PDOException $e) {
            echo 'Database error: '.$e->getMessage();
        }

        return $content;
    }

    public function searchCards($card)
    {
        $content = [];
        try {
            $sql = 'SELECT * FROM '.$this->table.' WHERE termin like "'.$card.'%"';
            $result = $this->databaseConnection->query($sql);
            while ($row = $result->fetch()) {
                $content[] = ['termin' => $row['termin'], 'definition' => $row['definition'], 'level' => $row['level']];
            }
        } catch (PDOException $e) {
            echo 'Database error: '.$e->getMessage();
        }

        return $content;
    }

    public function updateCard($oldtermin, $termin, $definition)
    {
        try {
            $sql = 'UPDATE '.$this->table.' SET definition = "'.$definition.'" WHERE termin = "'.$oldtermin.'"';
            $this->databaseConnection->exec($sql);
            $sql = 'UPDATE '.$this->table.' SET termin = "'.$termin.'" WHERE termin = "'.$oldtermin.'"';
            $this->databaseConnection->exec($sql);
        } catch (PDOException $e) {
            echo 'Database error: '.$e->getMessage();
        }
    }

    public function deleteCard($termin)
    {
        try {
            $sql = 'DELETE FROM '.$this->table.' WHERE termin = "'.$termin.'"';
            $this->databaseConnection->exec($sql);
        } catch (PDOException $e) {
            echo 'Database error: '.$e->getMessage();
        }
    }


    public function deleteSetOfCards()
    {
        try {
            $sql = 'Drop TABLE '.$this->table.'_BackdropsList';
            $this->databaseConnection->exec($sql);
            $sql = 'Drop TABLE '.$this->table.'_Comments';
            $this->databaseConnection->exec($sql);
            $sql = 'Drop TABLE '.$this->table;
            $this->databaseConnection->exec($sql);
        } catch (PDOException $e) {
            echo 'Database error: '.$e->getMessage();
        }
    }

    public function createBackdrop($backdrop)
    {
        try {
            $sql = 'INSERT INTO '.$this->table.'_BackdropsList (backdrop) VALUES ("'.$backdrop.'")';
            $this->databaseConnection->exec($sql);
        } catch (PDOException $e) {
            echo 'Database error: '.$e->getMessage();
        }
    }

    public function getBackdrops()
    {
        $content = [];
        try {
            $sql = 'SELECT * FROM '.$this->table.'_BackdropsList';
            $result = $this->databaseConnection->query($sql);
            while ($row = $result->fetch()) {
                $content[] = ['backdrop' => $row['backdrop']];
            }
        } catch (PDOException $e) {
            echo 'Database error: '.$e->getMessage();
        }

        return $content;
    }

    public function deleteAllBackdrops()
    {
        try {
            $backdrops = $this->getBackdrops();
            foreach ($backdrops as $backdrop) {
                $sql = 'Drop TABLE '.$backdrop['backdrop'].'_Backdrop';
                $this->databaseConnection->exec($sql);
            }
        } catch (PDOException $e) {
            echo 'Database error: '.$e->getMessage();
        }
    }
}