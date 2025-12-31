<section class="block_area block_area_category">
    <div class="block_area-header">
        <div class="float-left bah-heading mr-4">
            <h2 class="cat-heading">Recommended for you</h2>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="tab-content">
        <div class="block_area-content block_area-list film_list film_list-grid film_list-wfeature">
            <div class="film_list-wrap">
                <?php
                foreach ($recommended as $a) {
                    echo post($a, false, $page = "home");
                }
                ?>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</section>