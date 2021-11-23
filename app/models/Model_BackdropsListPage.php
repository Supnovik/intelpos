<?php

class Model_BackdropsListPage
{
    protected function getData($user, $setofcards)
    {
        $db = new Model_SetOfCards($user, $setofcards);
        return $db->getBackdrops();
    }
}