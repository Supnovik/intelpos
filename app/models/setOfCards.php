<?php

namespace Intelpos\Model;

use PDOException;

class setOfCards
{
    public $setofcards;
    function __construct($setofcards)
    {
        $this->setofcards=$setofcards;
    }
    public function getData($user = null, $data = null)
    {
        
        $cards = $this->getCards();
        $comments = $this->getComments();
        return ['cards' => $cards , 'comments' => $comments];
    }
    
    public function getCards()
    {
        $db = new dbConstructor();
        return $db->getContent('cards',['id','setofcardsId','termin','definition'],[['type'=>'setofcardsId','content'=>$this->setofcards['id']]]);
    }

    public function getComments()
    {
        $db = new dbConstructor();
        return $db->getContent('comments',['id','setofcardsId','userName','comment']);
    }

    public function addCard($termin, $definition)
    {
        $setofcardsId = $this->setofcards['id'];
        $db = new dbConstructor();
        $db->addContent('cards',[['setofcardsId',$setofcardsId],['termin',$termin],['definition',$definition]]);
    }

    public function addComment($nickname, $text)
    {
        $db = new dbConstructor();
        $db->addContent('cards',[['user',$nickname],['text',$text]]);
    }

    public function sortByAlphabet()
    {
        $db = new dbConstructor();
        $sortObj = 'termin';
        $pattern = ['id','setofcardsId','termin','definition'];
        return $db->sortContent('cards',$pattern,$sortObj);
    }

    public function searchCards($termin)
    {
        $db = new dbConstructor();
        return $db->getContent('cards',['setofcardsId','termin','definition'],[['type'=>'termin','content'=>$termin]]);
    }
    
    public function updateCard($id,$pattern, $newValue)
    {
        $db = new dbConstructor();
        $db->updateContent('cards',$id,$pattern, $newValue);
    }

    public function deleteCard($id)
    {
        $db = new dbConstructor();
        $db->deleteContent('cards',$id);
    }


    public function deleteSetOfCards()
    {
        
    }

    public function createBackdrop($backdrop, $imagePath)
    {
        
    }

    public function getBackdropImage($backdrop)
    {
        
    }

    

    public function deleteBackdrop($backdrop)
    {
       
    }

    public function deleteAllBackdrops()
    {
        
    }
}