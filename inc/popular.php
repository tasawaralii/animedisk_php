<section class="block_area block_area_sidebar block_area-realtime">
    <div class="block_area-header">
        <div class="float-left bah-heading mr-4">
            <h2 class="cat-heading">Most Popular</h2>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="block_area-content">
        <div class="cbox cbox-list cbox-realtime">
            <div class="cbox-content">
                <div class="anif-block-ul">
                    <ul class="ulclear">
                        
                    <?php 
                    foreach($popular as $a)
                    echo popular($a);
                    ?>

                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</section>