<div class="setofcards">
    <div class="setofcards-sidebar">
        <div class="setofcards-sidebar-buttons">
            <?php
            $uri = explode('/', $_SERVER['REQUEST_URI']);
            if ($GLOBALS["user"] == $uri[2]):?>
                <button class="setofcards-sidebar-buttons-add button-long">Add new card</button>
            <?php else: ?>
                <button style="display: none" class="setofcards-sidebar-buttons-add button-long">Add new card</button>
            <?php endif; ?>
            <a href='/users/<?= $uri[2] ?>/learn/<?=$uri[4]?>' class="setofcards-sidebar-buttons-start button-long">Start learning</a>
            <button class="setofcards-sidebar-buttons-comments button-long">View comments</button>
        </div>
        <div class="setofcards-sidebar-input">
            <form method="post">
                <input style="display: none" type="text" name="oldtermin"
                       class="setofcards-sidebar-input-oldtermin input-box">
                <input required type="text" name="termin" placeholder="Termin"
                       class="setofcards-sidebar-input-termin input-box">
                <input required type="text" name="definition" placeholder="Definition"
                       class="setofcards-sidebar-input-definition input-box">
                <button type="submit" name="create-card" class="create-card button-long">Create card</button>
                
                <div class="save-delete-card">
                    <?php if ($GLOBALS["user"] == $uri[2]): ?>
                        <button type="submit" name="save-card" class="save-card button-long">Save card</button>
                        <button type="submit" name="delete-card" class="delete-card button-long">Delete card</button>
                    <?php endif;?>
                </div>
                

            </form>
            <button class="setofcards-sidebar-input-cancel button-long">Cancel</button>
        </div>

        <div class="setofcards-sidebar-comments">
            <div class="setofcards-sidebar-comments-content">
                <?php foreach ($data['comments'] as $value):?>
                    <div class="setofcards-sidebar-comment">
                        <a class="setofcards-sidebar-comment-nickname"><?=$value['nickname']?></a>
                        <div class="setofcards-sidebar-comment-text"><?=$value['text']?></div>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php if ($GLOBALS["isLogin"]):?>
                <form class="setofcards-sidebar-comments-input" method="post">
                    <input type="text" name="comment-nickname" style="display: none" value="<?=$GLOBALS["user"]?>" >
                    <input type="text" name="comment-text" class="comment-text input-box" >
                    <button type="submit" name="comment-button" class="comment-button button-long"> send</button>
                </form>
            <?php endif; ?>
            <button class="setofcards-sidebar-input-cancel button-long">Cancel</button>
        </div>
        
    </div>
    <div class="setofcards-content">
        <div class="setofcards-header">
            <form method="post" class="setofcards-search">
                <input type="text" name="search-card" placeholder="Search cards by term" class="input-box">
                <button type="submit" name="search-card-button" class="button-short">Search</button>
                <button type="submit" name="sortByAlphabet" class="button-short">Sort by alphabet</button>
            </form>
        </div>
        <div class="setofcards-table">
            <?php
            foreach ($data['cards'] as $value):?>
                <button class="setofcards-table-card">
                    <div class="setofcards-table-card-termin"><?= $value['termin'] ?></div>
                    <div class="setofcards-table-card-definition"><?= $value['definition'] ?></div>
                </button>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<script src="/app/views/SetOfCards/setofcards.js">
    
</script>

