<div class="backdrop">
    <div class="backdrop-sidebar">
            <?php
            foreach ($data['allCards'] as $value):?>
                <div class="backdrop-card">
                    <div class="backdrop-card-termin"><?= $value['termin'] ?></div>
                    <div style="display: none" class="backdrop-card-definition"><?= $value['definition'] ?></div>
                </div>
            <?php endforeach;?>
    </div>
    <div class="backdrop-content">
        <form method="post" class="">
            <input name="backdrop-card" type="text" >
            <button name="backdrop-addCard" type="submit">create</button>
        </form>
    </div>
</div>

<?php
    print_r($data);