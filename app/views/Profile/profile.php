<div class="profile_page container">
    <div class="user-infomation">
        <img src="http://user-life.com/uploads/posts/2018-08/1535608847_kak-udalit-avatarku-ubrat-postavit-sdelat-zagruzit-dobavit-foto-vkontakte-dlya-telegramma-skaypa-vayber-diskorda.jpg">
        <div class="user-nickname">
            <h2>
                <?php 
                $uri = explode('/', $_SERVER['REQUEST_URI']);
                echo $uri[2];
                ?>
            </h2>
        </div>
    </div>
    <div class="user-content-list">
                <?php 
                    foreach ($data as $value) {
                        echo '<div class="user-content-list-block">
                        <div>
                            <a href="/set_of_cards" class="user-content-list-block-setofcards">'
                                . $value['setofcards'] .
                            '</a>
                            <a href="/backdrops" class="user-content-list-block-backdrop">'
                                . $value['backdrop'] .
                            '</a>
                        </div>';
                        $isLogin =  true;
                        if ($isLogin)
                        echo'<form method="post">
                                <input type="submit" name="add" id="edit" class="user-content-list-block-button" value="edit" />
                                <input type="submit" name="add" id="delete" class="user-content-list-block-button" value="delete" />
                             </form></div>';
                        else
                        echo'<form method="post">
                                <input type="submit" name="add" id="edit" class="user-content-list-block-button" value="add" />
                             </form></div>';
                        
                    }
                    if ($isLogin)
                        echo'
                             <button id="addnew" class="button-long user-content-open-modal">
                                Add new set of cards
                             </button>';
                ?>
                
    </div>

    <div class="user-content-modal">
        <div class="modal">
        <button class="user-content-close-modal close">×</button>
            <form method="post">
                <h2>Create new SET OF CARDS and BACKDROP</h2>
                <input name="setofcardsName" class="user-content-list-block" placeholder="Set of cards name" />
                <input name="backdropName" class="user-content-list-block"  placeholder="Backdrop name" />
                <input type="submit" name="createSetofcards" class="button-long user-content-close-modal" value="Create"/>
            </form>
        </div>
    </div>
</div>
<script src="/app/views/Profile/profile.js"></script>

<?php
        if(array_key_exists('createSetofcards', $_POST)) {
            createUser();
        }
        
        function createUser() {
            $uri = explode('/', $_SERVER['REQUEST_URI']);
            $db = new Model_ProfilePage();
            $db->create_set_of_cards($uri[2],filter_var(trim($_POST['setofcardsName']),FILTER_SANITIZE_STRING));
        }
    ?>