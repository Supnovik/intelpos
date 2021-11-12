<?php
class Model_List_of_usersPage extends Model
{
	
	public function get_data($user=null,$data=null)
	{	
		$db = new Model_Database("data","users");
		return $db->getUsers();
	}
}
