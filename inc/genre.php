<?php

$allgenres = $api->getAllGenres();
?>
<section class="block_area block_area_sidebar block_area-genres">
    <div class="block_area-header">
        <div class="float-left bah-heading mr-4">
            <h2 class="cat-heading">Genres</h2>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="block_area-content">
        <div class="cbox cbox-genres">
            <ul class="ulclear color-list sb-genre-list sb-genre-less">
                <?php
                foreach ($allgenres as $g) {
                    echo '<li><a href="/genre/' . $g['slug'] . '" title="' . $g['name'] . '">' . $g['name'] . '</a></li>';
                }
                ?>
            </ul>
            <div class="clearfix"></div>
            <button class="btn btn-sm btn-block btn-showmore mt-2"></button>
        </div>
    </div>
</section>