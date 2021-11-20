<div class="page_of_users container">
    
    <div class="our_users">
        <h1>
            Users created by our team and possibly interesting sets of cards for you
        </h1>
        <div class="our_users-list">
            <a href='/users/Mathematic' class="our_users-block mathematic">Mathematic</a>
            <a href='/users/Rules of the Russian language' class="our_users-block russian_language">Rules of the Russian language</a>
            <a href='/users/Rules of the English language' class="our_users-block english_language">Rules of the English language</a>
        </div>
        
    </div>
    <div class="all_users">
            <form method="post"  class="all_users-search">
                    <input type="text" name="search-user" placeholder="Search users by nickname" class="input-box">
                    <button type="submit" name="search-user-button" class="button-short">Search</button>
            </form>
            <div class="all_users-list">
                <?php 
                    foreach ($data as $value) {
                            echo "<a href='/users/" . (string)$value['nickname'] ."' class='all_users-user'>".  (string)$value['nickname'] . "</a>";
                    }
                ?>
            </div>
        </div>
</div>