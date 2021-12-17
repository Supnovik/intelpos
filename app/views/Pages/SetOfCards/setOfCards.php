<div class="setofcards">
    <div class="setofcards-sidebar">
        <div class="setofcards-sidebar-content">
            <div class="setofcards-sidebar-open">
                <div class="bar1"></div>
                <div class="bar2"></div>
                <div class="bar3"></div>
            </div>
            <div class="setofcards-sidebar-buttons">
                <div class="setofcards-sidebar-buttons-add">
                    <?php
                    if ($GLOBALS["isLogin"]) {
                        if ($GLOBALS['user']['nickname'] == $GLOBALS['uri'][2]): ?>
                            <button class="button-long">Add new card</button>
                        <?php
                        endif;
                    } ?>
                </div>
                <?php
                if (count($data['cards']) !== 0): ?>
                    <a href='/users/<?= $GLOBALS['uri'][2] ?>/learn/<?= $GLOBALS['uri'][4] ?>'
                       class="setofcards-sidebar-buttons-start button-long">Start learning</a>
                <?php
                endif; ?>
                <button class="setofcards-sidebar-buttons-comments button-long">View comments</button>
            </div>
            <div class="setofcards-sidebar-input">
                <form method="post">
                    <input style="display: none" type="text" name="id"
                           class="setofcards-sidebar-input-oldId input-box">
                    <input required type="text" name="termin" placeholder="Termin"
                           class="setofcards-sidebar-input-termin input-box">
                    <input required type="text" name="definition" placeholder="Definition"
                           class="setofcards-sidebar-input-definition input-box">
                    <button type="submit" name="create-card" class="create-card button-long">Create card</button>

                    <div class="save-delete-card">
                        <?php
                        if ($GLOBALS["isLogin"]) {
                            if ($GLOBALS['user']['nickname'] == $GLOBALS['uri'][2]): ?>
                                <div>
                                    <button type="submit" name="save-card" class="save-card button-long">Save card
                                    </button>
                                    <button type="submit" name="delete-card" class="delete-card button-long">Delete card
                                    </button>
                                </div>
                            <?php
                            endif;
                        } ?>
                    </div>


                </form>
                <button class="setofcards-sidebar-input-cancel button-long">Cancel</button>
            </div>

            <div class="setofcards-sidebar-comments">
                <div class="setofcards-sidebar-comments-content">
                    <?php
                    foreach ($data['comments'] as $value): ?>
                        <div class="setofcards-sidebar-comment">
                            <a class="setofcards-sidebar-comment-nickname"><?= $value['nickname'] ?></a>
                            <div class="setofcards-sidebar-comment-text"><?= $value['text'] ?></div>
                        </div>
                    <?php
                    endforeach; ?>
                </div>
                <?php
                if ($GLOBALS["isLogin"]): ?>
                    <form class="setofcards-sidebar-comments-input" method="post">
                        <input type="text" name="comment-nickname" style="display: none"
                               value="<?= $GLOBALS['user']['nickname'] ?>">
                        <input type="text" name="comment-text" class="comment-text input-box">
                        <button type="submit" name="comment-button" class="comment-button button-long"> send</button>
                    </form>
                <?php
                endif; ?>
                <button class="setofcards-sidebar-input-cancel button-long">Cancel</button>
            </div>
        </div>

    </div>
    <div class="setofcards-content">
        <div class="setofcards-header">
            <form method="post" class="setofcards-search">
                <input type="text" name="search-card" placeholder="Search cards by term" class="input-box">
                <div class="setofcards-search-buttons">
                    <button type="submit" name="search-card-button" class="search-card-button button-short">Search
                    </button>
                    <button type="submit" name="sortByAlphabet" class="sort-byAlphabet-button button-short">Sort by
                        alphabet
                    </button>
                </div>

            </form>
        </div>
        <div class="setofcards-table">
            <?php
            foreach ($data['cards'] as $value):?>
                <button class="setofcards-table-card">
                    <div class="setofcards-table-card-termin text"><?= $value['termin'] ?></div>
                    <div class="setofcards-table-card-definition"><?= $value['definition'] ?></div>
                    <div style="display: none" class="setofcards-table-card-id"><?= $value['id'] ?></div>
                </button>
            <?php
            endforeach; ?>
        </div>
    </div>
</div>

