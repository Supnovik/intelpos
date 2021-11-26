<?php
namespace Intelpos\Model;

class listOfUsers extends \Intelpos\Model
{

    public function getData($user = null, $data = null)
    {
        $db = new database('data', 'users');
        if (array_key_exists('search-user-button', $_POST)) {
            return $db->serchUsers(filter_var(trim($_POST['search-user']), FILTER_SANITIZE_STRING));
            echo "<meta http-equiv='refresh' content='0'>";
        }
        return $db->getUsers();
    }
}
