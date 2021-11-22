<?php

class Model_SetOfCards extends Model_Database
{
    public function getData($user = null, $data = null)
    {
        if (array_key_exists('create-card', $_POST)) {
            $this->addCard(filter_var(trim($_POST['termin']), FILTER_SANITIZE_STRING), filter_var(trim($_POST['definition']), FILTER_SANITIZE_STRING));
            echo "<meta http-equiv='refresh' content='0'>";
        }
        if (array_key_exists('save-card', $_POST)) {
            $this->updateCard(filter_var(trim($_POST['oldtermin']), FILTER_SANITIZE_STRING), filter_var(trim($_POST['termin']), FILTER_SANITIZE_STRING), filter_var(trim($_POST['newdefinition']), FILTER_SANITIZE_STRING));
            echo "<meta http-equiv='refresh' content='0'>";
        }
        if (array_key_exists('delete-card', $_POST)) {
            $this->deleteCard(filter_var(trim($_POST['termin']), FILTER_SANITIZE_STRING));
            echo "<meta http-equiv='refresh' content='0'>";
        }
        if (array_key_exists('search-card-button', $_POST)) {
            return $this->searchCards(filter_var(trim($_POST['search-card']), FILTER_SANITIZE_STRING));
        }
        if (array_key_exists('sortByAlphabet', $_POST)) {
            return $this->sortByAlphabet();
        }

        return $this->getCards();
    }

    public function createSetOfCards()
    {
        try {
            $sql = 'create table ' . $this->table . ' (id integer auto_increment primary key, termin VARCHAR(30), definition VARCHAR(30), level INT DEFAULT 0);';
            $this->databaseConnection->exec($sql);
            $sql = 'create table ' . $this->table . '_BackdropsList (id integer auto_increment primary key, backdrop VARCHAR(30), image BLOB);';
            $this->databaseConnection->exec($sql);
        } catch (PDOException $e) {
            echo 'Database error: ' . $e->getMessage();
        }
    }

    public function addCard($termin, $definition)
    {
        try {

            $sql = 'INSERT INTO ' . $this->table . ' (termin, definition) VALUES ("' . $termin . '","' . $definition . '")';
            $this->databaseConnection->exec($sql);

        } catch (PDOException $e) {
            echo 'Database error: ' . $e->getMessage();
        }
    }

    public function getCards()
    {
        $content = [];
        try {

            $sql = 'SELECT * FROM ' . $this->table;
            $result = $this->databaseConnection->query($sql);
            while ($row = $result->fetch()) {
                $content[] = ['termin' => $row['termin'], 'definition' => $row['definition'], 'level' => $row['level']];
            }
        } catch (PDOException $e) {
            echo 'Database error: ' . $e->getMessage();
        }
        return $content;
    }

    public function sortByAlphabet()
    {
        $content = [];
        try {

            $sql = 'SELECT * FROM ' . $this->table . ' ORDER BY termin DESC';
            $result = $this->databaseConnection->query($sql);
            while ($row = $result->fetch()) {
                $content[] = ['termin' => $row['termin'], 'definition' => $row['definition'], 'level' => $row['level']];
            }
        } catch (PDOException $e) {
            echo 'Database error: ' . $e->getMessage();
        }
        return $content;
    }

    public function searchCards($card)
    {
        $content = [];
        try {

            $sql = 'SELECT * FROM ' . $this->table . ' WHERE termin like "' . $card . '%"';
            $result = $this->databaseConnection->query($sql);
            while ($row = $result->fetch()) {
                $content[] = ['termin' => $row['termin'], 'definition' => $row['definition'], 'level' => $row['level']];
            }
        } catch (PDOException $e) {
            echo 'Database error: ' . $e->getMessage();
        }
        return $content;
    }

    public function updateCard($oldtermin, $termin, $defition)
    {
        try {

            $sql = 'UPDATE ' . $this->table . ' SET defition = "' . $defition . '" WHERE termin = "' . $oldtermin . '"';
            $sql = 'UPDATE ' . $this->table . ' SET defition = "' . $termin . '" WHERE termin = "' . $oldtermin . '"';
            $this->databaseConnection->exec($sql);

        } catch (PDOException $e) {
            echo 'Database error: ' . $e->getMessage();
        }
    }

    public function deleteCard($termin)
    {
        try {

            $sql = 'DELETE FROM ' . $this->table . ' WHERE termin = "' . $termin . '"';
            $this->databaseConnection->exec($sql);

        } catch (PDOException $e) {
            echo 'Database error: ' . $e->getMessage();
        }
    }


    public function deleteSetOfCards()
    {
        try {
            $sql = 'Drop TABLE ' . $this->table . '_BackdropsList';
            $this->databaseConnection->exec($sql);
            $sql = 'Drop TABLE ' . $this->table;
            $this->databaseConnection->exec($sql);
        } catch (PDOException $e) {
            echo 'Database error: ' . $e->getMessage();
        }
    }

    public function getBackdrops()
    {
        $content = [];
        try {
            $sql = 'SELECT * FROM ' . $this->table;
            $result = $this->databaseConnection->query($sql);
            while ($row = $result->fetch()) {
                $content[] = ['backdrop' => $row['backdrop']];
            }
        } catch (PDOException $e) {
            echo 'Database error: ' . $e->getMessage();
        }
        return $content;
    }


    public function deleteAllBackdrops()
    {
        try {
            $backdrops = $this->getBackdrops();
            foreach ($backdrops as $backdrop) {
                $sql = 'Drop TABLE ' . $backdrop;
                $this->databaseConnection->exec($sql);
            }

        } catch (PDOException $e) {
            echo 'Database error: ' . $e->getMessage();
        }
    }
}