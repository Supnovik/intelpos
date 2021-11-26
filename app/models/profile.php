<?php
namespace Intelpos\Model;

class profile extends \Intelpos\Model
{
    public function getData($user = null, $data = null)
    {
        $db = new user($user, $user);
        return $db->getSetOfCardsList();
    }

    public function createSetOfCard($user, $set_of_cards_name)
    {
        $User = new user($user, $user);
        $User->addSetOfCards($set_of_cards_name, $set_of_cards_name);
        $SetOfCards = new setOfCards($user, $set_of_cards_name);
        $SetOfCards->createSetOfCards();
    }

    public function deleteSetOfCard($user, $set_of_cards_name)
    {
        $User = new user($user, $user);
        $User->deleteSetOfCards($set_of_cards_name);
        $SetOfCards = new setOfCards($user, $set_of_cards_name);
        $SetOfCards->deleteAllBackdrops();
        $SetOfCards = new setOfCards($user, $set_of_cards_name);
        $SetOfCards->deleteSetOfCards();
    }

    public function deleteUser($user)
    {
        $db = new database('data', 'users');
        if ($db->checkingForExistence($user)) {
            $db->deleteUser($user);
        }
    }
}
