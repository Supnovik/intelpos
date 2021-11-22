<?php

class Model_ProfilePage extends Model
{
    public function get_data($user = null, $data = null)
    {
        if(array_key_exists('createSetofcards', $_POST)) {
            
            $this->create_set_of_cards($GLOBALS['user'],filter_var(trim($_POST['setofcardsName']),FILTER_SANITIZE_STRING));
            echo "<meta http-equiv='refresh' content='0'>";
        }

        if(array_key_exists('delete', $_POST)) {
            $this->delete_set_of_cards($GLOBALS['user'],filter_var(trim($_POST['setofcardsName']),FILTER_SANITIZE_STRING));
            echo "<meta http-equiv='refresh' content='0'>";
        }

        if(array_key_exists('add', $_POST)) {
            $this->create_set_of_cards($GLOBALS['user'],filter_var(trim($_POST['setofcardsName']),FILTER_SANITIZE_STRING));
            echo "<meta http-equiv='refresh' content='0'>";
        }
        $db = new Model_User($user, $user);
        return $db->getSetOfCardsList();
    }

    public function create_set_of_cards($user, $set_of_cards_name)
    {
        $User = new Model_User($user, $user);
        $User->addSetOfCards($set_of_cards_name, $set_of_cards_name);
        $SetOfCards = new Model_SetOfCards($user, $set_of_cards_name);
        $SetOfCards->create_SetOfCards();
    }
    public function delete_set_of_cards($user, $set_of_cards_name)
    {
        $User = new Model_User($user, $user);
        $User->deleteSetOfCards($set_of_cards_name);
        $SetOfCards = new Model_SetOfCards($user, $set_of_cards_name.'_BackdropsList');
        $SetOfCards->deleteAllBackdrops();
        $SetOfCards = new Model_SetOfCards($user, $set_of_cards_name);
        $SetOfCards->deleteSetOfCards();
    }
}
