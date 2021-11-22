<div class="navbar">
    <div class="navbar-content container">
        <div class="navbar-left">
            <a class="logo" href="/"></a>
            <div class="navbar-hrefs">
                <a href="/" class="navbar-main_page">Main</a>
                <a href="/list_of_users" class="navbar-list_of_users_page">List of users</a>
            </div>
        </div>
        <?php if($GLOBALS["isLogin"]):?>
        <div class="sign-user">
                <div class="sign-user-img">
                    <img src="http://user-life.com/uploads/posts/2018-08/1535608847_kak-udalit-avatarku-ubrat-postavit-sdelat-zagruzit-dobavit-foto-vkontakte-dlya-telegramma-skaypa-vayber-diskorda.jpg" />
                </div>
                <a class="my-profile" href='/users/<?=$GLOBALS["user"];?>'>My profile</a>
                <form  action="/app/models/Model_Auth.php" method="post"><button type="submit" class="sign-out" name="sign-out">Sign out</button ></form>
        </div>
        <?php else: ?>
        <div class="sign-buttons">
            <a href="/login" class="sign-in">Log in</a>
            <a href="/registration" class="sign-up">Sign up</a>
        </div>
        <?php endif;?>
    </div>
</div>
<script src="/app/views/sections/navbar.js"></script>

