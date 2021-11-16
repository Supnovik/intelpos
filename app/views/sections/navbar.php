<div class="navbar">
    <a class="logo" href="/"></a>
    <ul class="sign">
        <?php if($GLOBALS["isLogin"]):?>
        <div>
            <?php echo $GLOBALS["user"]; ?> 
        </div>
        
        <?php else: ?>
            <a href="/login" class="sign-in">Log in</a>
            <a href="/registration" class="sign-up">Sign up</a>
        <?php endif;?>
    </ul>
</div>