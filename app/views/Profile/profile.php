<div class="profile_page container">
    <div class="user-infomation">
        <img src="http://user-life.com/uploads/posts/2018-08/1535608847_kak-udalit-avatarku-ubrat-postavit-sdelat-zagruzit-dobavit-foto-vkontakte-dlya-telegramma-skaypa-vayber-diskorda.jpg">
        <div class="user-nickname">
            <h2>
                <?php
                echo $GLOBALS['uri'][2]; ?>
            </h2>
        </div>
        <?php
        if ($GLOBALS["user"] == $GLOBALS['uri'][2]): ?>
            <form method="post">
                <input type="submit" name="delete-user" class="delete-user" value="Delete user"/>
            </form>
        <?php
        endif; ?>
    </div>
    <div class="user-content-list">
        <?php
        foreach ($data as $value): ?>
            <form method="post" class="user-content-list-block">
                <h2><?= $value['setofcards'] ?></h2>
                <input type="text" style="display: none" name="setofcardsName"
                       value="<?= $value['setofcards'] ?>"></input>
                <div>
                    <a href="/users/<?= $GLOBALS['uri'][2] ?>/setofcards/<?= $value['setofcards'] ?>"
                       class="user-content-list-block-setofcards">Set of cards</a>
                    <a href="/users/<?= $GLOBALS['uri'][2] ?>/backdrops/<?= $value['setofcards'] ?>"
                       class="user-content-list-block-backdrop">
                        Backdrops
                    </a>
                    <?php
                    if ($GLOBALS["user"] == $GLOBALS['uri'][2]): ?>
                        <input type="submit" name="edit-cardsSet" id="edit" class="user-content-list-block-button"
                               value="edit"/>
                        <input type="submit" name="delete-cardsSet" id="delete" class="user-content-list-block-button"
                               value="delete"/>

                    <?php
                    else: if ($GLOBALS["isLogin"]): ?>
                        <input type="submit" name="add-cardsSet" id="edit" class="user-content-list-block-button"
                               value="add"/>

                    <?php
                    endif; ?>

                    <?php
                    endif; ?></div>
            </form>
        <?php
        endforeach;
        if ($GLOBALS["user"] == $GLOBALS['uri'][2]): ?>
            <button id="addnew" class="button-long user-content-open-modal">
                Add new set of cards
            </button>
        <?php
        endif; ?>
    </div>

    <div class="user-content-modal">
        <div class="modal">
            <button class="user-content-close-modal close">×</button>
            <form method="post">
                <h2>Enter the name of the set of cards</h2>
                <input maxlength="12" name="setofcardsName" class="user-content-list-block" required autocomplete="off"
                       placeholder="Set of cards name"/>
                <input type="submit" name="createSetofcards" class="button-long user-content-close-modal"
                       value="Create"/>
            </form>
        </div>
    </div>
</div>
<script src="/app/views/Profile/profile.js"></script>