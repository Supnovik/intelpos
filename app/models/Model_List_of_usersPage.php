<?php

class Model_List_of_usersPage extends Model
{

    public function get_data($user = null, $data = null)
    {
        $db = new Model_Database('data', 'users');
        if(array_key_exists('search-user-button', $_POST)) {
            return $db->serchUsers(filter_var(trim($_POST['search-user']),FILTER_SANITIZE_STRING));
            echo "<meta http-equiv='refresh' content='0'>";
        }
        return $db->getUsers();
    }
}
