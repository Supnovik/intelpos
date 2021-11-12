<?php
include 'app\models\Model_Database.php';
include 'app\models\Model_Profile.php';
class Model_ProfilePage extends Model
{
    public function get_data($user=null,$data=null)
	{	
		$db = new Model_Database($user,$data);
		return $db->getContent();
	}

    public function create_set_of_cards($user,$set_of_cards_name){
        $db = new Model_Profile($user,$set_of_cards_name);
        $db->createTable();
		return $db->getContent();
    }

	public function checking_for_existence($data)
	{	
        $data= (string)$data;
        $db = new Model_Database("data","users");
        $flag =  false;
        foreach ($db->getContent() as $value)
            {
                if(array_search($data, $value))
                    $flag =  true;
            }
        return $flag;
	}
}
