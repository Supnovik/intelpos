<?php
include 'app\models\Model_Database.php';
class Model_List_of_usersPage extends Model
{
	
	public function get_data($data=null)
	{	
		$db = new Model_database("data","users");
		return $db->getContent();
	}
}
