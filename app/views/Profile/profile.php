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
                             <button id="addnew" class="user-content-list-block">
                                Add new set of cards
                             </button>';
                ?>
                
    </div>
</div>