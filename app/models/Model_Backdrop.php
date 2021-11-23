<?php

class Model_Backdrop extends Model_Database
{

    protected function createBackdropTable($table)
    {
        try {
            $sql = 'create table ' . $table . ' (id integer auto_increment primary key, termin VARCHAR(30), definition VARCHAR(30), x_coordinate INT DEFAULT 0, y_coordinate INT DEFAULT 0);';
            $this->databaseConnection->exec($sql);
        } catch (PDOException $e) {
            echo 'Database error: ' . $e->getMessage();
        }
    }

    protected function addCard($termin, $definition, $x_coordinate, $y_coordinate)
    {
        try {
            $sql = 'INSERT INTO ' . $this->table . ' (termin, definition,x_coordinate,y_coordinate) VALUES ("' . $termin . '","' . $definition . '","' . $x_coordinate . '","' . $y_coordinate . '")';
            $this->databaseConnection->exec($sql);

        } catch (PDOException $e) {
            echo 'Database error: ' . $e->getMessage();
        }
    }

    protected function getCards()
    {
        $content = [];
        try {

            $sql = 'SELECT * FROM ' . $this->table;
            $result = $this->databaseConnection->query($sql);
            while ($row = $result->fetch()) {
                $content[] = ['termin' => $row['termin'], 'definition' => $row['definition'], 'x_coordinate' => $row['x_coordinate'], 'y_coordinate' => $row['y_coordinate']];
            }
        } catch (PDOException $e) {
            echo 'Database error: ' . $e->getMessage();
        }
        return $content;
    }

    protected function deleteCard($termin)
    {
        try {
            $sql = 'DELETE FROM ' . $this->table . ' WHERE termin = "' . $termin . '"';
            $this->databaseConnection->exec($sql);
        } catch (PDOException $e) {
            echo 'Database error: ' . $e->getMessage();
        }
    }

    protected function deleteBackdrop()
    {
        try {
            $sql = 'Drop TABLE ' . $this->table;
            $this->databaseConnection->exec($sql);
        } catch (PDOException $e) {
            echo 'Database error: ' . $e->getMessage();
        }
    }


}