<div class="backdropPage">
    <div class="backdropPage-sidebar">
        <div class="backdropPage-sidebar-cardsList">
            <?php
            foreach ($data['allCards'] as $value):?>
                <div class="backdropPage-card" draggable="true">
                    <div class="backdropPage-card-termin"><?= $value['termin'] ?></div>
                    <div style="display: none" class="backdropPage-card-definition"><?= $value['definition'] ?></div>
                    <div style="display: none" class="backdropPage-card-id"><?= $value['id'] ?></div>
                </div>
            <?php
            endforeach; ?>
        </div>
        <div style="display: none" class="backdropPage-sidebar-cardInfo">
            <form method="post">
                <div>
                    <h3>Termin:</h3>
                    <h2 class="backdropPage-sidebar-cardInfo-termin"></h2>
                </div>
                <div>
                    <h3>Definition:</h3>
                    <h2 class="backdropPage-sidebar-cardInfo-definition"></h2>
                </div>
                <input type="text" style="display: none" id="id" name="id">

                <?php
                if ($GLOBALS["user"] == $GLOBALS['uri'][2]): ?>
                    <button type="submit" name="removeCard"
                            class="removeCard backdropPage-sidebar-cardInfo-remove button-long">Remove card
                    </button>
                <?php
                endif; ?>

            </form>
            <button class="backdropPage-sidebar-cardInfo-close button-long">Close</button>
        </div>
    </div>
    <div class="backdropPage-content">
        <div class="backdropPage-content-backdrop">
            <img src="/<?= $data['imagePath'] ?>">
            <?php
            foreach ($data['backdropCards'] as $value):?>
                <form method="post" draggable="true"
                      style="top: <?= $value['y_coordinate'] ?>%;left: <?= $value['x_coordinate'] ?>%;"
                      class="card-onBackdrop">
                    <div class="backdropPage-card-termin"><?= $value['termin'] ?></div>
                    <input type="text" style="display: none" id="id" name="id" value="<?= $value['id'] ?>">
                    <input type="text" style="display: none" id="termin" name="termin" value="<?= $value['termin'] ?>">
                    <input type="text" style="display: none" id="definition" name="definition"
                           value="<?= $value['definition'] ?>">
                    <input type="text" style="display: none" name="x_coordinate" class="x_coordinate"
                           value="<?= $value['x_coordinate'] ?>">
                    <input type="text" style="display: none" name="y_coordinate" class="y_coordinate"
                           value="<?= $value['y_coordinate'] ?>">
                    <button name="changeCardPos" class="changeCardPos" style="display: none">click to save</button>
                </form>
            <?php
            endforeach; ?>
        </div>
    </div>
</div>
<script> 
    var user = <?php echo json_encode($GLOBALS["user"]);?>;
    var setOwner = <?php echo json_encode($GLOBALS['uri'][2]);?>;
</script>
<script src="/app/views/Backdrop/backdrop.js"></script>
