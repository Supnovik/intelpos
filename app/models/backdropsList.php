<?php
namespace Intelpos\Model;

class backdropsList
{
    public function getData($user, $setofcards)
    {
        $dbSet = new setOfCards($user, $setofcards);
        return $dbSet->getBackdrops();
    }
}