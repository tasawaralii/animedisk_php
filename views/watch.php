<?php

$anime = $params['anime'];
$id = $params['id'];

$archiveDomain = "https://archive.deadtoons.org";

if (!is_numeric($id)) {
    require('error.php');
    exit;
}

require __DIR__ . '/_bootstrap.php';

require_once __DIR__ . "/../src/Api.php";
$api = new Api();

if (isset($_GET['type']) && $_GET['type'] == "movie") {

    $dumyId = $id;

    $post = $api->getAnimeByDummyId($dumyId);



} else {

    $mySeasonId = $id;

    $post = $api->getAnimeBySeasonId($mySeasonId);

}

if (!$post) {
    require('error.php');
    exit;
}

if ($anime != $post['slug']) {

    header("Location: /watch/" . $post['slug'] . "-" . $id);
    exit;

}

$anime_id = $post['anime_id'];

$a = $post;


if (!isset($_GET['type'])) {

    if (!isset($_GET['ep'])) {

        $allEpisodes = $api->getEpisodes($mySeasonId);


        $firstEpisode = $allEpisodes[0];

        header("Location: /watch/" . $a['slug'] . "-" . $mySeasonId . "?ep=" . $firstEpisode['episode_id']);
        exit;
    } else {

        $episodeId = $_GET['ep'];

        $episodeApiUrl = API_DOMAIN . "/api/anime/episode.php?animeid=$anime_id&seasonid=$mySeasonId&episodeid=$episodeId&links=true&limit=1&key=deadtoonszylith";

        $episode = $api->getEpisodeByUrl($episodeApiUrl);

        if (isset($episode['error'])) {
            $errorMessage = $episode['error'];
            require('error.php');
            exit;
        }

        $allEpisodes = $api->getEpisodes($mySeasonId);

        $seasonInfo = $api->getSeasonInfo($mySeasonId);
        $seasonInfo = $seasonInfo[0];

        // print_r($episodeApiUrl);

        $epInfo = $episode['detail'];
        $servers = $episode['links'];
        // if(!$servers)
        //     header("Location: /watch/".$a['slug']."-".$a['my_season_id']."?ep=".$a['episode_id']);
    }
} else {
    $servers = $api->getMovieServers($dumyId);
}


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

<head>
    <?php require('inc/head.php'); ?>

<body>
    <?php require('inc/sidebar.php'); ?>
    <div id="wrapper" data-page="watch">
        <?php require('inc/header.php') ?>
        <div class="clearfix"></div>
        <div id="main-wrapper" class="layout-page layout-page-detail layout-page-watchtv">
            <div id="ani_detail">
                <div class="ani_detail-stage">
                    <div class="container">
                        <div class="anis-cover-wrap">
                            <div class="anis-cover"
                                style="background-image: url(<?php echo img($a, "backdrop", "mid") ?>)"></div>
                        </div>
                        <div class="anis-watch-wrap">
                            <div class="prebreadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="/home" title="Home">Home</a></li>
                                        <li class="breadcrumb-item"><a
                                                href="/<?php echo $a['type'] ?>"><?php echo strtoupper($a['type']) ?></a>
                                        </li>
                                        <li class="breadcrumb-item dynamic-name active"
                                            data-jname="Watching <?php echo $a['anime_name'] ?>">
                                            Watching
                                            <?php echo $a['anime_name'] . (((isset($_GET['type']) && $_GET['type'] == "movie") ? '' : (" (Season " . (str_pad($seasonInfo['my_season_num'], 2, '0', STR_PAD_LEFT)) . ")"))) ?>
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                            <div class="anis-watch anis-watch-tv">
                                <div class="watch-player">
                                    <div class="player-frame">
                                        <iframe id="iframe-embed" src="" title="Anime video player" frameborder="0"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                            allowfullscreen>
                                        </iframe>
                                    </div>
                                </div>
                                <div class="player-servers">
                                    <div id="servers-content">
                                        <div class="ps_-status">
                                            <div class="content">
                                                <div class="server-notice">

                                                    <strong>You are watching
                                                        <b><?php echo ((isset($_GET['type']) && $_GET['type'] == "movie") ? $post['anime_name'] : "Episode " . $epInfo['epSort'] . $epInfo['part']) ?></b></strong>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="ps_-block ps_-block-sub servers-dub">
                                            <div class="ps__-title"><i class="fas fa-microphone-alt mr-2"></i>DUB:</div>
                                            <div class="ps__-list">
                                                <?php
                                                $movie_single = true;

                                                if (isset($_GET['type']) && $_GET['type'] == "movie") {
                                                    $movie_single = false;

                                                    foreach ($servers as $s) {
                                                        echo '<div class="item" data-embed="https://deaddrive.shop/embed/' . $s['uid'] . '">
                                                        <a style = "margin-top:4px" class="btn">' . ($movie_single && $s['Hindi_Only'] == 1 ? 'Hindi Only' : $s['quality']) . '</a>
                                                        </div>';
                                                    }
                                                } else {

                                                    $deaddrive = $servers['deaddrive']['embed'];


                                                    if ($epInfo['player_link']) {
                                                        $blazePlayer = $epInfo['player_link'];
                                                        echo '<div class="item" data-embed="' . $blazePlayer . '"><a style = "margin-top:4px" class="btn">Blaze</a></div>';
                                                    }

                                                    echo '<div class="item" data-embed="' . $deaddrive . '"><a style = "margin-top:4px" class="btn">DeadDrive</a></div>';

                                                }
                                                ?>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="ps_-block ps_-block-sub servers-dub">
                                            <div class="ps__-title"><i class="fas fa-download mr-2"></i>Download:</div>
                                            <div>

                                                <?php
                                                if (isset($_GET['type']) && $_GET['type'] == "movie") {
                                                    echo '<div style="float: left;margin-left: 12px;">
                                                            <a class="btn download-button" href="' . $archiveDomain . '/movie/' . $a['slug'] . '">Download</a>
                                                        </div>';
                                                } else {
                                                    echo '<div style="float: left;margin-left: 12px;">
                                                            <a class="btn download-button" href="' . $archiveDomain . '/episode/' . $a['slug'] . "/" . $seasonInfo['my_season_num'] . "x" . $epInfo['epSort'] . '">Download</a>
                                                        </div>';
                                                }
                                                ?>
                                            </div>
                                            <div class="clearfix"></div>

                                        </div>

                                    </div>
                                </div>

                                <div id="episodes-content">
                                    <div class="seasons-block ">
                                        <div id="detail-ss-list" class="detail-seasons">
                                            <div class="detail-infor-content">
                                                <div class="ss-choice">
                                                    <div class="ssc-list">
                                                        <div id="ssc-list" class="ssc-button">
                                                            <div class="ssc-label">List of episodes:</div>
                                                        </div>
                                                    </div>

                                                    <div class="ssc-quick">
                                                        <div class="sscq-icon"><i class="fas fa-search"></i></div>
                                                        <input id="search-ep" class="form-control" type="text"
                                                            placeholder="Number of Ep" autocomplete="off" />
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>

                                                <div class="ss-list">

                                                    <?php
                                                    if (isset($_GET['type']) && $_GET['type'] == "movie") {
                                                        $e = $post;
                                                        echo '<a title="' . $e['anime_name'] . '" class="ssl-item active" " data-id="' . $e['anime_id'] . '">
                                                                <div class="ssli-order">1</div>
                                                                <div class="ssli-detail">
                                                                    <div class="ep-name e-dynamic-name" title="' . $e['anime_name'] . '">' . $e['anime_name'] . '</div>
                                                                </div>
                                                                <div class="ssli-btn">
                                                                    <div class="btn btn-circle"><i class="fas fa-play"></i></div>
                                                                </div>
                                                                <div class="clearfix"></div>
                                                            </a>';

                                                    } else {
                                                        foreach ($allEpisodes as $e) {
                                                            $episodeName = $e['episode_name'] ? $e['episode_name'] : "Episode " . $e['epSort'];
                                                            echo '<a title="' . $episodeName . '" class="ssl-item" data-number="' . $e['epSort'] . '" data-id="' . $e['episode_id'] . '" ' . '" href="/watch/' . $a['slug'] . "-" . $seasonInfo['my_season_id'] . "?ep=" . $e['episode_id'] . '">
                                                                    <div class="ssli-order">' . $e['epSort'] . '</div>
                                                                    <div class="ssli-detail">
                                                                        <div class="ep-name e-dynamic-name" title="' . $episodeName . '">' . $episodeName . '</div>
                                                                    </div>
                                                                    <div class="ssli-btn">
                                                                        <div class="btn btn-circle"><i class="fas fa-play"></i></div>
                                                                    </div>
                                                                    <div class="clearfix"></div>
                                                                </a>';
                                                        }
                                                    }
                                                    ?>

                                                </div>

                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="anis-watch-detail">
                                <div class="anis-content">
                                    <div class="anisc-poster">
                                        <div class="film-poster">

                                            <img src="<?php echo img($a, "poster", "low") ?>" class="film-poster-img"
                                                alt="<?php echo $a['anime_name'] ?>">
                                        </div>
                                    </div>
                                    <div class="anisc-detail">
                                        <h2 class="film-name">
                                            <a href="/<?php echo $a['slug'] . "-" . $a['anime_id'] ?>"
                                                class="text-white dynamic-name"
                                                title="<?php echo $a['anime_name'] ?>"><?php echo $a['anime_name'] ?></a>
                                        </h2>
                                        <div class="film-stats">
                                            <div class="tick">

                                                <div class="tick-item tick-pg"><?php echo $a['age_name'] ?></div>


                                                <div class="tick-item tick-quality">HD</div>


                                                <div class="tick-item tick-dub"><i
                                                        class="fas fa-microphone mr-1"></i><?php echo count($post) ?>
                                                </div>


                                                <span class="dot"></span>
                                                <span class="item"><?php echo strtoupper($a['type']) ?></span>
                                                <span class="dot"></span>
                                                <span class="item"><?php echo $a['duration'] ?>m</span>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                        <div class="film-description m-hide">
                                            <div class="text">
                                                <?php echo $a['overview'] ?>
                                            </div>
                                        </div>
                                        <div class="film-text m-hide mb-3">
                                            <?php echo $data['name'] ?> is the best site to watch
                                            <strong><?php echo $a['anime_name'] ?></strong> SUB
                                            online, or you can even watch
                                            <strong><?php echo $a['anime_name'] ?></strong> DUB in
                                            HD quality.

                                        </div>
                                        <div class="block"><a href="/<?php echo $a['slug'] . "-" . $a['anime_id'] ?>"
                                                class="btn btn-xs btn-light">View detail</a></div>

                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
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
        <div id="totop"><i class="fas fa-chevron-up"></i></div>
    </div>
    <style>
        @media screen and (max-width: 860px) {
            .anis-watch-detail .anis-content {
                padding-right: 0 !important;
                padding-top: 18px !important;
            }
        }

        .download-button {
            margin-top: 4px;
            font-size: 13px;
            box-shadow: none !important;
            font-weight: 500;
            padding: 0 10px;
            line-height: 30px;
            min-width: 80px;
            background-color: #ffbade;
            color: #000;
            border: none !important;
        }
    </style>
    <script>
        $(document).ready(function () {
            // Function to get URL parameter by name
            function getUrlParameter(name) {
                name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
                var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
                var results = regex.exec(location.search);
                return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
            }

            // Get the value of the 'ep' parameter from the URL
            var epId = getUrlParameter('ep');

            // Find the anchor tag with the matching data-id attribute
            $('a.ssl-item[data-id="' + epId + '"]').addClass('active');
        });

        // Get all elements with class ".ps__-list .item"
        var items = document.querySelectorAll('.ps__-list .item');

        items.forEach(function (item) {
            item.addEventListener('click', function (event) {
                event.stopPropagation();
                var buttons = document.querySelectorAll('.ps__-list .btn');
                buttons.forEach(function (button) {
                    button.style.backgroundColor = '';
                    button.style.color = '';
                });

                var button = this.querySelector('.btn');
                button.style.backgroundColor = '#ffbade';
                button.style.color = '#111111';
                var dataEmbed = this.getAttribute('data-embed');
                var iframe = document.getElementById('iframe-embed');
                iframe.src = dataEmbed;
            }, {
                once: false
            }); // Add { once: true } to ensure the event listener is triggered only once
        });

        var firstChild = document.querySelector('.ps__-list .item:first-child');

        var dataEmbed = firstChild.getAttribute('data-embed');
        var iframe = document.getElementById('iframe-embed');
        iframe.src = dataEmbed;
        var button = firstChild.querySelector('.btn')
        button.style.backgroundColor = '#ffbade';
        button.style.color = '#111111';
    </script>

</body>

</html>