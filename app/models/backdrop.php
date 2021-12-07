<?php

namespace Intelpos\Model;

use PDOException;

class backdrop
{
    public $setofcards;
    public $backdrop;

    public function __construct($setofcards,$backdrop)
    {
        $this->setofcards =$setofcards;
        $this->backdrop =$backdrop;
    }

    public function addCard($termin, $definition, $x_coordinate, $y_coordinate)
    {
        $db = new dbConstructor();
        $db->addContent('cardsOnBackdrop',[['backdropsId',$this->backdrop['id']],['termin',$termin],['definition',$definition],['x_coordinate',$x_coordinate],['y_coordinate',$y_coordinate]]);
    }

    public function getCards()
    {
        $db = new dbConstructor();
        return $db->getContent('cardsOnBackdrop',['id','backdropsId','termin','definition','x_coordinate','y_coordinate'],[['type'=>'backdropsId','content'=>$this->backdrop['id']]]);
    }

    public function changeCardPos($id, $termin, $definition, $x_coordinate, $y_coordinate)
    {
        $db = new dbConstructor();
        $db->updateContent('cardsOnBackdrop',$id,['termin','definition','x_coordinate','y_coordinate'],['termin'=>$termin,'definition'=>$definition,'x_coordinate'=>$x_coordinate,'y_coordinate'=>$y_coordinate]);
    }

    public function removeCard($id)
    {
        $db = new dbConstructor();
        $db->deleteContent('cardsOnBackdrop',$id);
    }

    public function deleteBackdrop()
    {
        
    }


}