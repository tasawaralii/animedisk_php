<?php
require __DIR__ . '/_bootstrap.php';

require_once __DIR__ . "/../src/Api.php";
$api = new Api();

$anime = $params['anime'];
$id = $params['id'];

if (!is_numeric($id)) {
    require('error.php');
    exit;
} else {
    $post = single_anime($anime, $id, "info");
    if (!$post) {
        require('error.php');
        exit;
    }

    if ($post['slug'] != $anime) {
        header("Location: " . $post['slug'] . "-" . $id);
        exit;
    }
}
$a = $post;
$page = array(
    'title' => "Watch " . $a['anime_name'] . " Hindi Sub/Dub online Free on " . $data['name'],
    'description' => "Best site to watch " . $a['anime_name'] . " Hindi Sub/Dub online Free and download " . $a['anime_name'] . " Hindi Sub/Dub anime.",
    'keywords' => $a['anime_name'] . " Hindi Sub/Dub, free " . $a['anime_name'] . " online, watch " . $a['anime_name'] . " online, watch " . $a['anime_name'] . " free, download " . $a['anime_name'] . " anime, download " . $a['anime_name'] . " free",
    'header-class' => '',
);

$popular = $api->getList(['sort' => 'popular', 'limit' => 10]);
$recommended = $api->getList(['sort' => 'random', 'limit' => 24]);

?>
<!DOCTYPE html>
<html lang="en">
<?php require('inc/head.php'); ?>

<body>
    <?php require('inc/sidebar.php'); ?>
    <div id="wrapper" data-page="detail">
        <?php require('inc/header.php'); ?>
        <div class="clearfix"></div>
        <!--Begin: Main-->
        <div id="main-wrapper" class="layout-page layout-page-detail">
            <!-- Detail -->
            <div id="ani_detail">
                <div class="ani_detail-stage">
                    <div class="container">
                        <div class="anis-cover-wrap">
                            <div class="anis-cover"
                                style="background-image: url(<?php echo img($a, "backdrop", "mid") ?>)"></div>
                        </div>
                        <div class="anis-content">
                            <div class="anisc-poster">
                                <div class="film-poster">

                                    <img src="<?php echo img($a, "poster", "mid") ?>" class="film-poster-img">

                                </div>
                            </div>
                            <div class="anisc-detail">
                                <div class="prebreadcrumb">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="/home">Home</a></li>
                                            <li class="breadcrumb-item"><a
                                                    href="/<?php echo ($a['type']) ?>"><?php echo strtoupper($a['type']) ?></a>
                                            </li>
                                            <li class="breadcrumb-item dynamic-name active">
                                                <?php echo $a['anime_name'] ?>
                                            </li>
                                        </ol>
                                    </nav>
                                </div>
                                <h2 class="film-name dynamic-name"><?php echo $a['anime_name'] ?></h2>
                                <div id="mal-sync"></div>
                                <div class="film-stats">
                                    <div class="tick">

                                        <div class="tick-item tick-pg"><?php echo $a['age_name'] ?></div>


                                        <div class="tick-item tick-quality">HD</div>
                                        <?php
                                        if ($a['type'] == 'tv') {
                                            echo '<div class="tick-item tick-dub"><i class="fas fa-microphone mr-1">' . $a['total_episodes'] . '</i></div>';
                                        }
                                        ?>

                                        <span class="dot"></span>
                                        <span class="item"><?php echo strtoupper($a['type']) ?></span>
                                        <span class="dot"></span>
                                        <span class="item"><?php echo $a['duration'] ?>m</span>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>

                                <div class="film-buttons" style="display:block;">

                                    <?php
                                    if ($a['type'] == "tv") {
                                        if (isset($a['seasons'])) {
                                            foreach ($a['seasons'] as $s) {
                                                echo "<a style='margin-top:15px' href='/watch/" . $a['slug'] . "-" . $s['my_season_id'] . "' class='btn btn-radius btn-primary btn-play'><i class='fas fa-play mr-2'></i> Season " . str_pad($s['my_season_num'], 2, 0, STR_PAD_LEFT) . "</a>";
                                            }
                                        } else {
                                            echo "<a class='btn btn-radius btn-primary btn-play'><i class='fas fa-play mr-2'></i> Not Available </a>";
                                        }
                                    } else {
                                        if ($a) {
                                            echo "<a href='/watch/" . $a['slug'] . "-" . $a['anime_id'] . "?type=movie' class='btn btn-radius btn-primary btn-play'><i class='fas fa-play mr-2'></i> Watch Now </a>";
                                        }
                                    }
                                    ?>

                                    <div class="dr-fav" id="watch-list-content"></div>
                                </div>
                                <div class="film-description m-hide">
                                    <div class="text">
                                        <?php echo $a['overview'] ?>
                                    </div>
                                </div>
                                <div class="film-text m-hide">
                                    <?php echo $data['name'] ?> is the best site to watch
                                    <strong><?php echo $a['anime_name'] ?></strong> SUB online, or
                                    you can even watch <strong><?php echo $a['anime_name'] ?></strong> DUB in HD
                                    quality.

                                    You can also find

                                    <a class="name" href="/producer/production-ig"><strong>Production I.G</strong></a>

                                    anime on <?php echo $data['name'] ?> website.

                                </div>

                            </div>
                            <div class="anisc-info-wrap">
                                <div class="anisc-info">
                                    <div class="item item-title w-hide">
                                        <span class="item-head">Overview:</span>
                                        <div class="text">
                                            <?php echo $a['overview'] ?>
                                        </div>
                                    </div>

                                    <?php
                                    if ($a['indian_name'] != '') {
                                        echo '<div class="item item-title">
                                    <span class="item-head">Hindi Name:</span>
                                    <span class="name">' . $a['indian_name'] . '</span>
                                </div>';
                                    }

                                    ?>
                                    <?php
                                    if ($a['type'] == "tv") {
                                        echo '<div class="item item-title">';
                                        echo '<span class="item-head">Aired:</span>';
                                        echo '<span class="name">' . (date('M j, Y', strtotime($a['anime_rel_date'])) . " to " . (($a['anime_com_date'] == '0000-00-00') ? "??" : date('M j, Y', strtotime($a['anime_com_date'])))) . '</span>';
                                        echo '</div>';
                                    } else {
                                        echo '<div class="item item-title">';
                                        echo '<span class="item-head">Released:</span>';
                                        echo '<span class="name">' . date('M j, Y', strtotime($a['anime_rel_date'])) . '</span>';
                                        echo '</div>';
                                    }
                                    ?>
                                    <div class="item item-title">
                                        <span class="item-head">Duration:</span>
                                        <span class="name"><?php echo $a['duration'] ?>m</span>
                                    </div>
                                    <?php
                                    if ($a['type'] == "tv") {
                                        echo '<div class="item item-title">';
                                        echo '<span class="item-head">Status:</span>';
                                        echo '<a href="/list/' . (($a['completed'] == 1) ? "completed" : "top-airing") . '"><span class="name">' . (($a['completed'] == 1) ? "Completed" : "Ongoing") . '</span></a>';
                                        echo '</div>';
                                    }
                                    ?>
                                    <div class="item item-title">
                                        <span class="item-head">Score:</span>
                                        <span class="name"><?php echo $a['rating'] ?></span>
                                    </div>
                                    <div class="item item-title">
                                        <span class="item-head">Age Rating:</span>
                                        <span class="name"><?php echo $a['age_name'] . ' - ' . $a['age_des'] ?></span>
                                    </div>

                                    <div class="item item-list">
                                        <span class="item-head">Genres:</span>

                                        <?php
                                        foreach ($post['genres'] as $g) {
                                            echo '<a href="/genre/' . $g['slug'] . '"
                                               title="' . $g['name'] . '">' . $g['name'] . '</a>';
                                        }
                                        ?>
                                    </div>


                                    <!--<div class="item item-list">-->
                                    <!--    <span class="item-head">Sorces:</span>-->

                                    <?php
                                    // foreach($post['source'] as $s) {
                                    //     echo '<a class="name" href="//'.$s['source_domain'].$s["source_".$a['type']."_path"].$s['external_id'].'" target="_blank">'.$s['source_name'].'</a>';
                                    // }
                                    ?>


                                    <!--</div>-->

                                    <?php
                                    // $words = trim($a['keywords'], ',');
                                    // $words = explode(',', $words);
                                    // if($words[0] != '') {
                                    //     echo '<div class="item item-list">';
                                    //     echo '<span class="item-head">Keywords:</span>';
                                    //     foreach($words as $k) {
                                    
                                    //         echo '<a href="/keyword/'.$k.'" title="'.$k.'">'.$k.'</a>';
                                    //     }
                                    
                                    // echo '</div>';
                                    //         }
                                    
                                    ?>

                                    <div class="film-text w-hide">
                                        <?php echo $data['name'] ?> is the best site to watch
                                        <strong><?php echo $a['anime_name'] ?></strong> SUB
                                        online, or you can even watch <strong><?php echo $a['anime_name'] ?></strong>
                                        DUB in HD
                                        quality.

                                        You can also find

                                        <a class="name" href="/producer/production-ig"><strong>Production
                                                I.G</strong></a>

                                        anime on <?php echo $data['name'] ?> website.

                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div id="main-content">
                    <?php require('inc/recommended.php') ?>

                    <div class="clearfix"></div>
                </div>
                <div id="main-sidebar">

                    <?php require('inc/popular.php') ?>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <?php require('inc/footer.php') ?>
        <div class="modal fade premodal" id="actionModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true"></div>
        <div id="totop"><i class="fas fa-chevron-up"></i></div>

    </div>

</body>

</html>