<?php
class Model_BackdropsListPage{
    public function get_data($user,$setofcards)
    {
        $db = new Model_SetOfCards($user,$setofcards);
        return $db->getBackdrops();
    }
}