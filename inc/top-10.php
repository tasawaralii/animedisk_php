<?php

$today = $api->popularToday();
$weekly = $api->popularWeek();
$monthly = $api->popularMonth();

?>
<section class="block_area block_area_sidebar block_area-realtime">
    <div class="block_area-header">
        <div class="float-left bah-heading mr-2">
            <h2 class="cat-heading">Top 10</h2>
        </div>
        <div class="float-right bah-tab-min">
            <ul class="nav nav-pills nav-fill nav-tabs anw-tabs">
                <li class="nav-item"><a data-toggle="tab" href="#top-viewed-day" class="nav-link active">Today</a></li>
                <li class="nav-item"><a data-toggle="tab" href="#top-viewed-week" class="nav-link">Week</a></li>
                <li class="nav-item"><a data-toggle="tab" href="#top-viewed-month" class="nav-link">Month</a></li>
            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="block_area-content">
        <div class="cbox cbox-list cbox-realtime">
            <div class="cbox-content">
                <div class="tab-content">
                    <div id="top-viewed-day" class="anif-block-ul anif-block-chart tab-pane active">
                        <ul class="ulclear">
                            
                            <?php
                            $i = 0;
                            foreach($today as $a) {
                            $i++;
                            echo top($a, $i);
                            }
                            ?>

                        </ul>
                    </div>
                    <div id="top-viewed-week" class="anif-block-ul anif-block-chart tab-pane">
                        <ul class="ulclear">
                            
                            <?php
                            $i = 0;
                            foreach($weekly as $a) {
                            $i++;
                            echo top($a, $i);
                            }
                            ?>

                        </ul>
                    </div>
                    <div id="top-viewed-month" class="anif-block-ul anif-block-chart tab-pane">
                        <ul class="ulclear">
                           
                         <?php
                            $i = 0;
                            foreach($monthly as $a) {
                            $i++;
                            echo top($a, $i);
                            }
                            ?>
                         
                        </ul>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</section>