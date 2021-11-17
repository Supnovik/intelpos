<?php

class Model_ProfilePage extends Model
{
    public function get_data($user = null, $data = null)
    {
        $db = new Model_User($user, $user);
        return $db->getContent();
    }

    public function create_set_of_cards($user, $set_of_cards_name)
    {
        $database = new Model_User($user, $user);
        $database->addContent($set_of_cards_name, $set_of_cards_name);
        $db = new Model_SetOfCards($user, $set_of_cards_name);
        $db->createTable();
    }
    public function delete_set_of_cards($user, $set_of_cards_name)
    {
        $database = new Model_User($user, $user);
        $database->deleteContent($set_of_cards_name, $set_of_cards_name);
        $db = new Model_SetOfCards($user, $set_of_cards_name);
        $db->deleteSetOfCards();
    }
}
