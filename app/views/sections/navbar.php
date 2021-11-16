<div class="navbar">
    <a class="logo" href="/"></a>
    <?php if($GLOBALS["isLogin"]):?>
    <div class="sign-user">
            <div class="sign-user-img">
                <img src="http://user-life.com/uploads/posts/2018-08/1535608847_kak-udalit-avatarku-ubrat-postavit-sdelat-zagruzit-dobavit-foto-vkontakte-dlya-telegramma-skaypa-vayber-diskorda.jpg" />
            </div>
            <a class="my-profile" href='/users/<?=$GLOBALS["user"];?>'>My profile</a>
            <form  method="post"><button type="submit" class="sign-out" name="sign-out">Sign out</button ></form>
    </div>
    <?php else: ?>
    <div class="sign-buttons">
        <a href="/login" class="sign-in">Log in</a>
        <a href="/registration" class="sign-up">Sign up</a>
    </div>
    <?php endif;?>
</div>
<script src="/app/views/sections/navbar.js"></script>
<?php 
    if(array_key_exists('sign-out', $_POST)) {
                setcookie('user',$GLOBALS["user"],time()-3600,'/');
                echo "<meta http-equiv='refresh' content='0'>";
            } 
        ?>