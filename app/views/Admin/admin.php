<form method="post">
    <input  name="mail" id="test" value="" /><br/>
    <input  name="nickname" id="test" value="" /><br/>
    <input  name="password" id="test" value="" /><br/>
    <input type="submit" name="button3"
            class="button" value="createDatabase" />
    <input type="submit" name="button4"
            class="button" value="createTable" />
    <input type="submit" name="button1"
            class="button" value="addContent" />
    <input type="submit" name="button2"
            class="button" value="getContent" />
    <input type="submit" name="button5"
            class="button" value="delete" />
</form>

<?php
        require_once( "app/controllers/controller_database.php" );

        if(array_key_exists('button1', $_POST)) {
            button1();
        }
        else if(array_key_exists('button2', $_POST)) {
            button2();
        }else if(array_key_exists('button3', $_POST)) {
            button3();
        }else if(array_key_exists('button4', $_POST)) {
            button4();
        }if (array_key_exists('button5', $_POST)) {
            button5();
        }
        function button1() {
            $database = new Controller_database;
            $database->addContent(filter_var(trim($_POST['nickname']),FILTER_SANITIZE_STRING),filter_var(trim($_POST['mail']),FILTER_SANITIZE_STRING),filter_var(trim($_POST['password']),FILTER_SANITIZE_STRING));
        }

        function button2() {
            $database = new Controller_database;

            $database->getContent();
        }

        function button3() {
            $database = new Controller_database;

            $database->createDatabase("data");
        }
        function button4() {
            $database = new Controller_database;

            $database->createTable();
        }
        function button5() {
            $database = new Controller_database;

            $database->deleteContent(filter_var(trim($_POST['mail']),FILTER_SANITIZE_STRING));
        }
    ?>