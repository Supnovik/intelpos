<?php
include 'app\models\Model_Database.php';
class Model_ProfilePage extends Model
{
    public function get_data($data=null)
	{	
		$db = new Model_database("data",$data);
		return $db->getContent();
	}
	public function checking_for_existence($data)
	{	
        $data= (string)$data;
        $db = new Model_database("data","users");
        $flag =  false;
        foreach ($db->getContent() as $value)
            {
                if(array_search($data, $value))
                    $flag =  true;
            }
        return $flag;
	}

   
}
