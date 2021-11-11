<div class="page_of_users container">
    
    <div class="our_users">
        <h1>
            Users created by our team and possibly interesting sets of cards for you
        </h1>
        <div class="our_users-list">
            <a href='/users/mathematic' class="our_users-block mathematic">Mathematic</a>
            <a href='/users/russian_language' class="our_users-block russian_language">Rules of the Russian language</a>
            <a href='/users/english_language' class="our_users-block english_language">Rules of the English language</a>
        </div>
        <div class="all_users">
            <div class="all_users-search">
               
                    <input type="text" placeholder="Search users by nickname" class="input-box">
            </div>
            <div class="all_users-list">
                <?php 
                    foreach ($data as $value) {
                        echo "<a href='/users/" . $value['nickname'] ."' class='all_users-user'>".  $value['nickname'] . "</a>";
                    }
                ?>
            </div>
        </div>
    </div>
</div>