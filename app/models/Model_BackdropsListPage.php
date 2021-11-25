<?php

class Model_BackdropsListPage
{
    public function getData($user, $setofcards)
    {
        $dbSet = new Model_SetOfCards($user, $setofcards);
        
        if (array_key_exists('createBackdrop', $_POST)) {
            $dbSet->createBackdrop(filter_var(trim($_POST['BackdropName']), FILTER_SANITIZE_STRING));
            $dbBack = new Model_Backdrop($user,filter_var(trim($_POST['BackdropName']), FILTER_SANITIZE_STRING));
            $dbBack->createBackdropTable();
        }
        return $dbSet->getBackdrops();
    }
}