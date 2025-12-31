<?php
require __DIR__ . '/_bootstrap.php';

require_once __DIR__ . "/../src/Api.php";
$api = new Api();

$genre = $params['g'];
$sg = capitalize($genre);
$page = array(
    'title' => "Watch " . $sg . " Anime Hindi DUBBED Online",
    'description' => "Full list of the " . $sg . " Anime Online Free, with Hindi DUBBED. WATCH NOW",
    'keywords' => "must watch anime, best anime to watch, legendary anime, most popular anime, top anime, anime to watch",
    'header-class' => 'header-home',
);
$limit = 16;
$currentPage = ((isset($_GET['page'])) ? $_GET['page'] : 1);
$offset = ($currentPage - 1) * $limit;
$animes = $api->getByGenre($genre, $limit, $offset);
if (!$animes['animes']) {
    require('error.php');
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<?php require('inc/head.php') ?>

<body>
    <?php require('inc/sidebar.php') ?>

    <div id="wrapper">
        <?php require('inc/header.php') ?>

        <div class="clearfix"></div>
        <!--Begin: Main-->
        <div id="main-wrapper" class="layout-page">
            <div class="container">
                <!--Begin: main-content-->
                <div id="main-content">
                    <!--Begin: Section film list-->
                    <section class="block_area block_area_category">
                        <div class="block_area-header block_area-header-tabs">
                            <div class="float-left bah-heading mr-4">
                                <h2 class="cat-heading"><?php echo $sg ?> Anime</h2>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="tab-content">
                            <div class="block_area-content block_area-list film_list film_list-grid film_list-wfeature">
                                <div class="film_list-wrap">

                                    <?php

                                    $i = 1;
                                    foreach ($animes['animes'] as $a) {
                                        $big = (($i <= 4) ? true : false);
                                        echo post($a, $big, "single");
                                        $i++;
                                    }
                                    ?>
                                </div>
                                <div class="clearfix"></div>

                                <?php
                                $totalPages = $animes['total'][0]['total'] / $limit;
                                $paginationHtml = generatePagination($currentPage, $totalPages);
                                echo $paginationHtml;


                                ?>

                            </div>
                        </div>
                    </section>
                    <!--End: Section film list-->
                    <div class="clearfix"></div>
                </div>
                <!--/End: main-content-->
                <!--Begin: main-sidebar-->
                <div id="main-sidebar">
                    <?php require('inc/top-10.php') ?>
                    <?php require('inc/genre.php') ?>
                </div>
                <!--/End: main-sidebar-->
                <div class="clearfix"></div>
            </div>
        </div>
        <!--End: Main-->
        <?php require('inc/footer.php') ?>
        <div class="modal fade premodal" id="actionModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true"></div>
        <div id="totop"><i class="fas fa-chevron-up"></i></div>

    </div>

</body>

</html>