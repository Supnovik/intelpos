<div class="learnCards container">
    
    <div class="learnCards-termin">
        termin
    </div>
    
    <form onsubmit="return false" class="learnCards-input">
        <h2>Enter definition</h2>
        <input type="text" name="definition" placeholder="Definition" class="learnCards-definition input-box">
        <button class="learnCards-check-button">Check</button>
    </form>
    <div class="learnCards-userAnswer">
            <h2 class="learnCards-userAnswer-user"></h2>
            <h2 class="learnCards-userAnswer-right"></h2>
    </div>
    <div style="display: none" class="learnCards-check">
            <div style="display: none" class="learnCards-check-right">Right</div>
            <div style="display: none" class="learnCards-check-wrong">Wrong</div>
            <div class="learnCards-check-buttons" >
                <button style="display: none" class="learnCards-right-button">It's right</button>
                <button style="display: none" class="learnCards-next-button">Next card</button>
                <?php ?>
                <button style="display: none" class="learnCards-statistic-button">View statistic</button>
            </div>
    </div>
</div>
<div class="user-content-modal">
    <div class="modal">
        <button class="user-content-close-modal close">×</button>
        <div class="learnCards-modal-content">
            <h2>Statistic</h2>
            <p class="learnCards-modal-content-text"></p>
            <a href="/users/<?=$GLOBALS['uri'][2]?>/setofcards/<?=$GLOBALS['uri'][4]?>"  class="learnCards-save-button">Ok</a>
        </div>
        
    </div>
</div>
<script>
    var data = <?php echo json_encode($data);?>;
</script>
<script src="/app/views/LearnCards/learnCard.js">
    
</script>