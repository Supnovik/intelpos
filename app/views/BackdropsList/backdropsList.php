<div class="page_of_backdrops container">

    <div class="page_of_backdrops-title">
        <h1>
            Backdrops
        </h1>
        <form method="post" class="all_backdrops-search">
            <input type="text" name="search-backdrop" placeholder="Search backdrops by nickname" class="input-box">
            <button type="submit" name="search-backdrop-button" class="button-short">Search</button>
        </form>

    </div>
    <div class="all_backdrops">

        <div class="all_backdrops-list">
            <?php
            foreach ($data as $value) {
                echo "<a href='/backdrops/" . $value['backdrop'] . "' class='all_backdrops-backdrop'>" . $value['backdrop'] . "</a>";
            }
            ?>
        </div>
    </div>
</div>