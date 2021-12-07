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
                <form class="backdrops-list-backdrop" method="post">
                    <input  style="display: none" type="text" name="id" value="<?= $value['id'] ?>"/>
                    <input  style="display: none" type="text" name="imagePath" value="<?= $value['imagePath'] ?>"/>
                    <h2><?= $value['name'] ?></h2>
                    <button type="submit" name="delete-backdrop" class="button-short">Delete</button>
                </form>

                <a href='/users/<?= $GLOBALS['uri'][2] ?>/backdropsList/<?= $GLOBALS['uri'][4] ?>/backdrop/<?= $value['name'] ?>'
                   class="backdrops-list-backdrop-img" style="background-image: url(/<?= $value['imagePath'] ?>)">

                </a>
            <?php
            endforeach; ?>
        </div>
    </div>
</div>
<div class="page_of_backdrops-modal">
    <div class="modal">
        <button class="page_of_backdrops-close-modal close">×</button>
        <form method="post" enctype="multipart/form-data">
            <h2>Enter the name of the Backdrop</h2>
            <input required maxlength="12" name="BackdropName" class="page_of_backdrops-modal-input input-box"
                   autocomplete="off"
                   placeholder="Backdrop name"/>
            <div style="display: flex">
                <label for="backdrop-img" class="button-short">Upload file</label>
                <input required style="display: none" type="file" name="file" id="backdrop-img">
                <button type="submit" name="createBackdrop" class="button-long page_of_backdrops-close-modal">Create
                </button>
            </div>
        </form>
    </div>
</div>
<script src="/app/views/BackdropsList/backdropsList.js"></script>