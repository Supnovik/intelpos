<div class="learnCards container">
    
    <div class="learnCards-termin">
        termin
    </div>
    
    <form onsubmit="return false" class="learnCards-input">
        <h2>Enter definition</h2>
        <input type="text" name="definition" placeholder="Definition" class="learnCards-definition input-box">
        <input style="display: none" type="text" name="definition" placeholder="Definition" class="input-box">
        <button class="learnCards-check-button">Check</button>
    </form>
    <div style="display: none" class="learnCards-check">
            <div style="display: none" class="learnCards-check-right">Right</div>
            <div style="display: none" class="learnCards-check-wrong">Wrong</div>
            <button style="display: none" class="learnCards-next-button">Next card</button>
            <?php $uri = explode('/', $_SERVER['REQUEST_URI']);?>
            <button style="display: none" class="learnCards-statistic-button">View statistic</button>
            
    </div>
</div>
<div class="user-content-modal">
    <div class="modal">
        <button class="user-content-close-modal close">×</button>
        <div class="learnCards-modal-content">
            <h2>Statistic</h2>
            <p class="learnCards-modal-content-text"></p>
            <a href="/users/<?=$uri[2]?>/setofcards/<?=$uri[4]?>"  class="learnCards-save-button">Ok</a>
        </div>
        
    </div>
</div>
<script>
    var data = <?php echo json_encode($data);?>;
</script>
<script src="/app/views/LearnCards/learnCard.js">
    
</script>