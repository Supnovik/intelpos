<?php
include 'app\models\model_database.php';
class Model_List_of_users extends Model
{
	
	public function get_data($data=null)
	{	
		$db = new Model_database("data","users");
		return $db->getContent();
	}
}
