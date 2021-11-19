<?php

class Model_ProfilePage extends Model
{
    
    
    public function updateState(){
        echo "<meta http-equiv='refresh' content='0'>";
    }
    public function get_data($user = null, $data = null)
    {
        if(array_key_exists('createSetofcards', $_POST)) {
            
            $this->create_set_of_cards($GLOBALS["user"],filter_var(trim($_POST['setofcardsName']),FILTER_SANITIZE_STRING));
            $this->updateState();
        }

        if(array_key_exists('delete', $_POST)) {
            $this->delete_set_of_cards($GLOBALS["user"],filter_var(trim($_POST['setofcardsName']),FILTER_SANITIZE_STRING));
            $this->updateState();
        }

        if(array_key_exists('add', $_POST)) {
            $this->create_set_of_cards($GLOBALS["user"],filter_var(trim($_POST['setofcardsName']),FILTER_SANITIZE_STRING));
            $this->updateState();
        }
        
        $db = new Model_User($user, $user);
        return $db->getContent();
    }

    public function create_set_of_cards($user, $set_of_cards_name)
    {
        $database = new Model_User($user, $user);
        $database->addContent($set_of_cards_name, $set_of_cards_name);
        $db = new Model_SetOfCards($user, $set_of_cards_name);
        $db->create_SetOfCards_Table();
    }
    public function delete_set_of_cards($user, $set_of_cards_name)
    {
        $database = new Model_User($user, $user);
        $database->deleteContent($set_of_cards_name, $set_of_cards_name);
        $db = new Model_SetOfCards($user, $set_of_cards_name);
        $db->deleteSetOfCards();
    }
}
