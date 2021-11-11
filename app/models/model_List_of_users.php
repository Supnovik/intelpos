<?php
include 'app\models\model_database.php';
class Model_List_of_users extends Model
{
	
	public function get_data()
	{	
		$db = new Model_database();
		$c = $db->getContent();
		echo $c;
		return $db->getContent();
	}

}
