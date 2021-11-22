<?php

class Model_ProfilePage extends Model
{
    public function get_data($user = null, $data = null)
    {
        if(array_key_exists('createSetofcards', $_POST)) {
            
            $this->createSetOfCard($GLOBALS['user'],filter_var(trim($_POST['setofcardsName']),FILTER_SANITIZE_STRING));
            echo "<meta http-equiv='refresh' content='0'>";
        }

        if(array_key_exists('delete-card', $_POST)) {
            $this->deleteSetOfCard($GLOBALS['user'],filter_var(trim($_POST['setofcardsName']),FILTER_SANITIZE_STRING));
            echo "<meta http-equiv='refresh' content='0'>";
        }

        if(array_key_exists('add-card', $_POST)) {
            $this->createSetOfCard($GLOBALS['user'],filter_var(trim($_POST['setofcardsName']),FILTER_SANITIZE_STRING));
            echo "<meta http-equiv='refresh' content='0'>";
        }
        if(array_key_exists('delete-user', $_POST)) {
            $this->deleteUser($GLOBALS['user']);
            setcookie('user',$GLOBALS["user"],time()-3600,'/');
            header('Location: /');
        }
        $db = new Model_User($user, $user);
        return $db->getSetOfCardsList();
    }

    public function createSetOfCard($user, $set_of_cards_name)
    {
        $User = new Model_User($user, $user);
        $User->addSetOfCards($set_of_cards_name, $set_of_cards_name);
        $SetOfCards = new Model_SetOfCards($user, $set_of_cards_name);
        $SetOfCards->create_SetOfCards();
    }
    public function deleteSetOfCard($user, $set_of_cards_name)
    {
        $User = new Model_User($user, $user);
        $User->deleteSetOfCards($set_of_cards_name);
        $SetOfCards = new Model_SetOfCards($user, $set_of_cards_name.'_BackdropsList');
        $SetOfCards->deleteAllBackdrops();
        $SetOfCards = new Model_SetOfCards($user, $set_of_cards_name);
        $SetOfCards->deleteSetOfCards();
    }
    public function deleteUser($user){
        $db = new Model_Database('data','users');
        if($db->checking_for_existence($user))
        {
            $db->deleteUser($user);
        }
    }
}
