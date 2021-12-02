<div class="backdropPage">
    <div class="backdropPage-sidebar">
        <?php
        foreach ($data['allCards'] as $value):?>
            <div class="backdropPage-card" draggable="true">
                <div class="backdropPage-card-termin"><?= $value['termin'] ?></div>
                <div style="display: none" class="backdropPage-card-definition"><?= $value['definition'] ?></div>
            </div>
        <?php
        endforeach; ?>
    </div>
    <div class="backdropPage-content">
        <form method="post" class="">
            <input name="backdropPage-card" type="text">
            <button name="backdropPage-addCard" type="submit">create</button>
        </form>
        <div  class="backdropPage-content-backdrop">
            <div  style="top: 50%;left: 50%;" class="card-onBackdrop">
                <div class="backdropPage-card-termin">termin</div>
                <div style="display: none" class="backdropPage-card-definition">definition</div>
            </div>
        </div>
    </div>
</div>
<script src="/app/views/Backdrop/backdrop.js"></script>
