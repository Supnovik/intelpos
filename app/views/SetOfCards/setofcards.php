<div class="setofcards">
    <div class="setofcards-sidebar">
        <div class="setofcards-sidebar-buttons">
            <button class="setofcards-sidebar-buttons-add button-long">Add new card</button>
            <button class="setofcards-sidebar-buttons-start button-long">Start learning</button>
            <button class="setofcards-sidebar-buttons-view button-long">View comments</button>
        </div>
        <div class="setofcards-sidebar-input">
        <form method="post">
            <input style="display: none" type="text" name="oldtermin"class="setofcards-sidebar-input-oldtermin input-box">
            <input required type="text" name="termin" placeholder="Termin" class="setofcards-sidebar-input-termin input-box">
            <input required type="text" name="definition" placeholder="Definition" class="setofcards-sidebar-input-definition input-box">
            <button type="submit" name="create-card" class="create-card button-long">Create card</button>
            <div class="save-delete-card">
                <button type="submit" name="save-card" class="save-card button-long">Save card</button>
                <button type="submit" name="delete-card" class="delete-card button-long">Delete card</button>
            </div>
        </form>
            <button class="setofcards-sidebar-input-cancel button-long">Cancel</button>
        </div>
        
    </div>
    <div class="setofcards-content">
        <div class="setofcards-header">
            <form method="post" class="setofcards-search">
                    <input type="text" name="search-card" placeholder="Search cards by term" class="input-box">
                    <button type="submit" name="search-card-button" class="button-short">Search</button>
            </form>
        </div>
        <div class="setofcards-table">
            <?php 
            foreach($data as $value):?>
                <button class="setofcards-table-card">
                    <div class="setofcards-table-card-termin"><?=$value['termin']?></div>
                    <div  class="setofcards-table-card-definition"><?=$value['definition']?></div>
                </button>
            <?php  endforeach;?>
        </div>
    </div>
</div>
<script src="/app/views/SetOfCards/setofcards.js"> </script>