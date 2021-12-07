<?php

namespace Intelpos\Model;

use Intelpos\Model;

class profile extends Model
{
    public function getData($user = null, $data = null)
    {
        
        $db =  new dbConstructor();
        $content = $db->getContent('setofcards',['id','name'],[['type'=>'usersId','content'=>$user['id']]],true);
        return $content;
    }

    public function createSetOfCard($usersId, $set_of_cards_name)
    {
        $db =  new dbConstructor();
        $db->addContent('setofcards',[['usersId',$usersId],['name',$set_of_cards_name]]);
    }

    public function deleteSetOfCard($set_of_cards_id)
    {
        $db =  new dbConstructor();
        $db->deleteContent('setofcards',$set_of_cards_id);
    }

    public function deleteUser($user)
    {
        $db =  new dbConstructor();
        $db->deleteContent('users',$user);
    }
}
