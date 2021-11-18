<div class="setofcards">
    <div class="setofcards-sidebar">
        <div class="setofcards-sidebar-buttons">
            <button class="setofcards-sidebar-buttons-add button-long">Add new card</button>
            <button class="setofcards-sidebar-buttons-start button-long">Start learning</button>
            <button class="setofcards-sidebar-buttons-view button-long">View comments</button>
        </div>
        <form method="post" class="setofcards-sidebar-input">
            <input required type="text" name=termin placeholder="Termin" class="setofcards-sidebar-input-termin input-box">
            <input required type="text" name=definition placeholder="Definition" class="setofcards-sidebar-input-definition input-box">

            <button type="submit" name=delete class="delete-card button-long">Delete card</button>

            <button type="submit" name=create-card class="create-card button-long">Create card</button>

            <button class="setofcards-sidebar-input-cancel button-long">Cancel</button>
        </form>
    </div>
    <div class="setofcards-content">
        <div class="setofcards-header">
            <div class="setofcards-search">
                    <input type="text" placeholder="Search cards by term" class="input-box">
            </div>
            
        </div>
        <div class="setofcards-table">
            <?php 
            foreach($data as $value):?>
                <div class="setofcards-table-card"><?=$value['termin']?></div>
            <?php  endforeach;?>
        </div>
    </div>
</div>
<script src="/app/views/SetOfCards/setofcards.js"> </script>
