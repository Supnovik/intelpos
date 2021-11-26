<?php
namespace Intelpos\Model;

class backdropsList
{
    public function getData($user, $setofcards)
    {
        $dbSet = new setOfCards($user, $setofcards);
        
        if (array_key_exists('createBackdrop', $_POST)) {
            $dbSet->createBackdrop(filter_var(trim($_POST['BackdropName']), FILTER_SANITIZE_STRING));
            $dbBack = new backdrop($user,filter_var(trim($_POST['BackdropName']), FILTER_SANITIZE_STRING));
            $dbBack->createBackdropTable();
        }
        return $dbSet->getBackdrops();
    }
}