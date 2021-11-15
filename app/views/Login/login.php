<div class="login-page">       
        <form class="login-block">
            <div class="login-container">
                <h1>Welcome</h1>
                    <div class="textField">
                        <input type="email" required placeholder="Email" class="input-box">
                    </div>

                    <div class="textField">
                        <input type="password" required placeholder="Пароль" class="input-box">
                    </div>

                    <input type="submit" name="button1" class="button-long" value="sign in" />

                    <div class="login-footer">
                        <p>No account on Intelpos?</p>
                        <a href="/registration" class="button-short">create</a>
                    </div>
            </div>
        </form>
</div>

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

        function button3() {
            $database = new Controller_database;

            $database->createDatabase("data");
        }
        function button4() {
            $database = new Controller_database;

            $database->createTable("users");
        }
        function button5() {
            $database = new Controller_database;

            $database->deleteContent(filter_var(trim($_POST['mail']),FILTER_SANITIZE_STRING));
        }
    ?>
  
  