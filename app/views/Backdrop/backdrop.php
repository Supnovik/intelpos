<div class="backdropPage">
    <div class="backdropPage-sidebar">
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
    <div class="backdropPage-content">
        <div style="background-image: url('/<?= $data['imagePath'][0]['imagePath']?>');" class="backdropPage-content-backdrop">
            <?php
            foreach ($data['backdropCards'] as $value):?>
                <form method="post" draggable="true" style="top: <?= $value['y_coordinate']?>%;left: <?= $value['x_coordinate']?>%;" class="card-onBackdrop">
                    <div class="backdropPage-card-termin"><?= $value['termin'] ?></div>
                    <input type="text" style="display: none" name="id" value="<?=$value['id']?>">
                    <input type="text" style="display: none" name="termin" value="<?=$value['termin']?>">
                    <input type="text" style="display: none" name="definition" value="<?=$value['definition']?>">
                    <input type="text" style="display: none" name="x_coordinate" class="x_coordinate" value="<?= $value['x_coordinate']?>">
                    <input type="text" style="display: none" name="y_coordinate" class="y_coordinate" value="<?= $value['y_coordinate']?>">
                    <button name="changeCardPos" class="changeCardPos" style="display: none">click to save</button>
                </form>
            <?php
            endforeach; ?>
        </div>
    </div>
</div>
<script src="/app/views/Backdrop/backdrop.js"></script>
