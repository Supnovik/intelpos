<div class="page_of_backdrops container">

    <div class="page_of_backdrops-title">
        <h1>
            Backdrops
        </h1>
        <button class="page_of_backdrops-open-modal button-short">Create new backdrop</button>
    </div>
    <div class="backdrops">
        <div class="backdrops-list">
            <?php
            foreach ($data as $value): ?>
                <a href='/users/<?= $GLOBALS['uri'][2] ?>/backdrop/<?= $value['backdrop'] ?>'
                   class="backdrops-list-backdrop">
                    <?= $value['backdrop'] ?>
                </a>
            <?php
            endforeach; ?>

        </div>
    </div>
</div>
<div class="page_of_backdrops-modal">
    <div class="modal">
        <button class="page_of_backdrops-close-modal close">×</button>
        <form method="post">
            <h2>Enter the name of the Backdrop</h2>
            <input maxlength="12" name="BackdropName" class="page_of_backdrops-modal-input input-box" required
                   autocomplete="off"
                   placeholder="Backdrop name"/>
            <button type="submit" name="createBackdrop" class="button-long page_of_backdrops-close-modal">Create
            </button>
        </form>
    </div>
</div>
<script src="/app/views/BackdropsList/backdropsList.js"></script>