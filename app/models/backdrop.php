<?php

namespace Intelpos\Model;

use PDOException;

class backdrop extends database
{

    public function createBackdropTable()
    {
        try {
            $sql = 'create table '.$this->table.'_Backdrop (id integer auto_increment primary key, termin VARCHAR(30), definition VARCHAR(30), x_coordinate INT DEFAULT 0, y_coordinate INT DEFAULT 0,is_set BOOL DEFAULT FALSE);';
            $this->databaseConnection->exec($sql);
        } catch (PDOException $e) {
            echo 'Database error: '.$e->getMessage();
        }
    }

    public function addCard($termin, $definition, $x_coordinate, $y_coordinate)
    {
        try {
            $sql = 'INSERT INTO '.$this->table.'_Backdrop (termin, definition,x_coordinate,y_coordinate) VALUES ("'.$termin.'","'.$definition.'","'.$x_coordinate.'","'.$y_coordinate.'")';
            $this->databaseConnection->exec($sql);
        } catch (PDOException $e) {
            echo 'Database error: '.$e->getMessage();
        }
    }

    public function getCards()
    {
        $content = [];
        try {
            $sql = 'SELECT * FROM '.$this->table.'_Backdrop';
            $result = $this->databaseConnection->query($sql);
            while ($row = $result->fetch()) {
                $content[] = [
                    'termin' => $row['termin'],
                    'definition' => $row['definition'],
                    'x_coordinate' => $row['x_coordinate'],
                    'y_coordinate' => $row['y_coordinate'],
                ];
            }
        } catch (PDOException $e) {
            echo 'Database error: '.$e->getMessage();
        }

        return $content;
    }

    public function deleteCard($termin)
    {
        try {
            $sql = 'DELETE FROM '.$this->table.'_Backdrop WHERE termin = "'.$termin.'"';
            $this->databaseConnection->exec($sql);
        } catch (PDOException $e) {
            echo 'Database error: '.$e->getMessage();
        }
    }

    public function deleteBackdrop()
    {
        try {
            $sql = 'Drop TABLE '.$this->table.'_Backdrop';
            $this->databaseConnection->exec($sql);
        } catch (PDOException $e) {
            echo 'Database error: '.$e->getMessage();
        }
    }


}