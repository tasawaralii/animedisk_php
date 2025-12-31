<?php
require __DIR__ . '/_bootstrap.php';

require_once __DIR__ . "/../src/Api.php";
$api = new Api();

if (isset($_GET['keyword']) && $_GET['keyword'] != '') {
    $keyword = urlencode(trim($_GET['keyword']));

    $search = $api->searchAnime($keyword);
    // print_r($search);
} else {
    require('error.php');
    exit;
}
$page = array(
    'title' => "Watch Anime Online, Free Anime Streaming Online on " . $data['domain'] . " Anime Website",
    'description' => $data['name'] . " is a Free anime streaming website which you can watch English Subbed and Dubbed Anime online with No Account and Daily update. WATCH NOW!",
    'keywords' => "anime to watch, watch anime,anime online, free anime online, online anime, anime streaming, stream anime online, english anime, english dubbed anime",
    'header-class' => ''
);

?>
<!DOCTYPE html>
<html lang="en">
<?php require('inc/head.php'); ?>

<body>
    <?php require('inc/sidebar.php'); ?>
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
                                <h2 class="cat-heading">Search results for: <i><?php echo $_GET['keyword'] ?></i></h2>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="tab-content">
                            <div class="block_area-content block_area-list film_list film_list-grid film_list-wfeature">
                                <div class="film_list-wrap">

                                    <?php

                                    if ($search) {

                                        foreach ($search['posts'] as $a) {
                                            echo post($a);
                                        }

                                    } else {
                                        echo "<center><p>No Anime Found</p></center>";
                                    }

                                    ?>
                                </div>
                                <div class="clearfix"></div>
                                <div class="pre-pagination mt-5 mb-5">
                                    <nav aria-label="Page navigation">

                                    </nav>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!--End: Section film list-->
                    <div class="clearfix"></div>
                </div>
                <!--/End: main-content-->
                <!--Begin: main-sidebar-->
                <div id="main-sidebar">
                    <?php require('inc/genre.php') ?>
                    <?php require('inc/top-10.php') ?>
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