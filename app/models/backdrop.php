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
            $sql = 'INSERT INTO '.$this->table.'_Backdrop (termin, definition, x_coordinate, y_coordinate) VALUES ("'.$termin.'","'.$definition.'","'.$x_coordinate.'","'.$y_coordinate.'")';
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
                    'id' => $row['id'],
                    'termin' => $row['termin'],
                    'definition' => $row['definition'],
                    'x_coordinate' => $row['x_coordinate'],
                    'y_coordinate' => $row['y_coordinate'],
                    'is_set' => $row['is_set'],
                ];
            }
        } catch (PDOException $e) {
            echo 'Database error: '.$e->getMessage();
        }

        return $content;
    }

    public function changeCardPos($id, $termin, $definition, $x_coordinate, $y_coordinate)
    {
        try {
            $sql = 'UPDATE '.$this->table.'_Backdrop SET x_coordinate = "'.$x_coordinate.'"  WHERE id = "'.$id.'"';
            $this->databaseConnection->exec($sql);
            $sql = 'UPDATE '.$this->table.'_Backdrop SET y_coordinate = "'.$y_coordinate.'"  WHERE id = "'.$id.'"';
            $this->databaseConnection->exec($sql);
        } catch (PDOException $e) {
            echo 'Database error: '.$e->getMessage();
        }
    }

    public function removeCard($id)
    {
        try {
            $sql = 'DELETE FROM '.$this->table.'_Backdrop WHERE id = "'.$id.'"';
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