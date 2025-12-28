<?php

$anime = $params['anime'];
$id = $params['id'];

$archiveDomain = "https://archive.deadtoons.org";
$deaddrive = "https://new2.deaddrive.shop/embed/";

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

        if(isset($episode['error'])) {
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
    'css' => array(
        'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css',
        'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css',
        'https://use.fontawesome.com/releases/v5.3.1/css/all.css',
        'https://fonts.googleapis.com/icon?family=Material+Icons',
        '/css/styles.min.css?v=1.0',
    ),
    'header-class' => '',
);

// $popular = anime($pdo, "Most-Popular", $limit = 10);
// $recommended = anime($pdo, "Random", $limit = 12);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require('inc/head.php'); ?>

<body>
    <?php require('inc/sidebar.php'); ?>
    <div id="wrapper" data-id="<?php echo $a['anime_id'] ?>" data-page="watch">
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
                                        <!--<div class="loading-relative loading-box" id="embed-loading">-->
                                        <!--    <div class="loading">-->
                                        <!--        <div class="span1"></div>-->
                                        <!--        <div class="span2"></div>-->
                                        <!--        <div class="span3"></div>-->
                                        <!--    </div>-->
                                        <!--</div>-->
                                        <iframe id="iframe-embed" src="" frameborder="0"
                                            allow="autoplay; fullscreen; geolocation; display-capture; picture-in-picture"
                                            webkitallowfullscreen mozallowfullscreen></iframe>
                                    </div>
                                    <div class="player-controls" style="padding:5px;text-align: center;">
                                        <span style="color: #ffbade;font-weight: bold;">

                                            <?php

                                            if (isset($_GET['type']) && $_GET['type'] == "movie") {
                                                // echo (($post[0]['note'] != '') ? "Note: ".$post[0]['note'] : '' ) ;
                                            } else {

                                                // echo (($servers[0]['note'] != '') ? "Note: ".$servers[0]['note'] : '' ) ;
                                            }

                                            ?>


                                        </span>
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


                                                    if($epInfo['player_link']) {
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



                                            <div class="">

                                                <?php
                                                if (isset($_GET['type']) && $_GET['type'] == "movie") {
                                                    echo '<div style="    float: left;
    margin-left: 12px;">
                    <a style = "    margin-top: 4px;
    font-size: 13px;
    box-shadow: none!important;
    font-weight: 500;
    padding: 0 10px;
    line-height: 30px;
    min-width: 80px;
    background-color: #ffbade;
    color: #000;
    border: none!important;" class="btn" href="' . $archiveDomain . '/movie/' . $a['slug'] . '">Download</a>
                </div>';
                                                } else {
                                                    echo '<div style="    float: left;
    margin-left: 12px;">
                    <a style = "    margin-top: 4px;
    font-size: 13px;
    box-shadow: none!important;
    font-weight: 500;
    padding: 0 10px;
    line-height: 30px;
    min-width: 80px;
    background-color: #ffbade;
    color: #000;
    border: none!important;" class="btn" href="' . $archiveDomain . '/episode/' . $a['slug'] . "/" . $seasonInfo['my_season_num'] . "x" . $epInfo['epSort'] . '">Download</a>
                </div>';
                                                }
                                                ?>
                                            </div>
                                            <div class="clearfix"></div>

                                        </div>

                                    </div>
                                </div>

                                <!--<div class="schedule-alert">-->
                                <!--    <div class="alert small">-->
                                <!--        <button type="button" class="close" data-dismiss="alert"><span-->
                                <!--                    aria-hidden="true">×</span></button>-->
                                <!--        <span class="icon-16 mr-1">🚀</span> Estimated the next episode will come at-->
                                <!--        <span-->
                                <!--                data-value="2024-05-11 15:00:00"-->
                                <!--                id="schedule-date"></span>-->
                                <!--    </div>-->
                                <!--</div>-->


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
                                                            placeholder="Number of Ep" autocomplete="off">
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
                    </a>
';

                                                    } else {
                                                        foreach ($allEpisodes as $e) {
                                                            $episodeName = $e['episode_name'] ? $e['episode_name'] : "Episode " . $e['epSort'];
                                                            echo '<a title="' . $episodeName . '" class="ssl-item" data-number="' . $e['epSort'] . '" data-id="' . $e['episode_id'] . '" ' . '" href="/watch/' . $a['slug'] . "-" . $seasonInfo['my_season_id'] . "?ep=" . $e['episode_id'] . '">
                        <div class="ssli-order">' . $e['epSort'] . $e['part'] . '</div>
                        <div class="ssli-detail">
                            <div class="ep-name e-dynamic-name" title="' . $episodeName . '">' . $episodeName . '</div>
                        </div>
                        <div class="ssli-btn">
                            <div class="btn btn-circle"><i class="fas fa-play"></i></div>
                        </div>
                        <div class="clearfix"></div>
                    </a>
';
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

                                        <!--<a href="javascript:;" class="dt-comment">-->
                                        <!--    <div class="icon"><i class="fas fa-comment"></i></div>-->
                                        <!--    <div class="number"></div>-->
                                        <!--    <div class="text">Comments</div>-->
                                        <!--</a>-->

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
                    <?php // require('inc/comment.php') ?>

                    <?php // require('inc/recommended.php') ?>
                    <div class="clearfix"></div>
                </div>
                <div id="main-sidebar">

                    <?php // require('inc/popular.php') ?>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <?php require('inc/footer.php') ?>
        <div class="modal fade premodal" id="actionModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true"></div>
        <div id="totop"><i class="fas fa-chevron-up"></i></div>

    </div>
    <div id="mask-overlay"></div>
    <div class="modal fade premodal premodal-login" id="modallogin" tabindex="-1" role="dialog"
        aria-labelledby="modallogintitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="tab-content">
                    <div id="modal-tab-login" class="tab-pane active">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modallogintitle">Welcome back!</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-danger mb-3" id="login-error" style="display: none;"></div>
                            <form class="preform" id="login-form" method="post">
                                <div class="form-group">
                                    <label class="prelabel" for="email">Email address</label>
                                    <input type="email" class="form-control" id="email" placeholder="name@email.com"
                                        name="email" required>
                                </div>
                                <div class="form-group">
                                    <label class="prelabel" for="password">Password</label>
                                    <input type="password" class="form-control" id="password" placeholder="Password"
                                        name="password" required>
                                </div>
                                <div class="form-check custom-control custom-checkbox">
                                    <div class="float-left">
                                        <input type="checkbox" class="custom-control-input" name="remember" value="1"
                                            id="remember" checked>
                                        <label class="custom-control-label" for="remember">Remember me</label>
                                    </div>
                                    <div class="float-right">
                                        <a href="javascript:;" class="link-highlight text-forgot forgot-tab-link">Forgot
                                            password?</a>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div data-theme="dark" class="g-recaptcha mb-3 mt-3" id="login-recaptcha"></div>
                                <div class="form-group login-btn mb-0">
                                    <button id="btn-login" class="btn btn-primary btn-block">Login</button>
                                    <div class="loading-relative" id="login-loading" style="display: none;">
                                        <div class="loading">
                                            <div class="span1"></div>
                                            <div class="span2"></div>
                                            <div class="span3"></div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer text-center">
                            Don't have an account? <a class="link-highlight register-tab-link"
                                title="Register">Register</a> or <a class="link-highlight verify-tab-link"
                                title="Account Verification">Verify</a>
                        </div>
                    </div>
                    <div id="modal-tab-register" class="tab-pane fade">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modallogintitle2">Create an Account</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-danger mb-3" id="register-error" style="display: none;"></div>
                            <div class="alert alert-success mb-3" id="register-success" style="display: none;">
                                An email has been sent to your email address containing an activation link. Please check
                                your email and click on the link to activate your account (It may get in the email spam
                                box).
                            </div>
                            <form class="preform" method="post" id="register-form">
                                <div class="form-group">
                                    <label class="prelabel" for="re-username">Your name</label>
                                    <input type="text" class="form-control" id="re-username" placeholder="Name"
                                        name="name" required>
                                </div>
                                <div class="form-group">
                                    <label class="prelabel" for="re-email">Email address</label>
                                    <input type="email" class="form-control" id="re-email" placeholder="name@email.com"
                                        name="email" required>
                                </div>
                                <div class="form-group">
                                    <label class="prelabel" for="re-password">Password</label>
                                    <input type="password" class="form-control" id="re-password" placeholder="Password"
                                        name="password" required>
                                </div>
                                <div class="form-group">
                                    <label class="prelabel" for="re-confirmpassword">Confirm Password</label>
                                    <input type="password" class="form-control" id="re-confirmpassword"
                                        placeholder="Confirm Password" required>
                                </div>
                                <div data-theme="dark" class="g-recaptcha mb-3" id="register-recaptcha"></div>
                                <div class="form-group login-btn mb-0">
                                    <button id="btn-register" class="btn btn-primary btn-block">Register</button>
                                    <div class="loading-relative" id="register-loading" style="display: none;">
                                        <div class="loading">
                                            <div class="span1"></div>
                                            <div class="span2"></div>
                                            <div class="span3"></div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer text-center">
                            Have an account? <a class="link-highlight login-tab-link" title="Login">Login</a>
                        </div>
                    </div>
                    <div id="modal-tab-forgot" class="tab-pane fade">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modallogintitle3">Reset Password</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" style="padding-bottom: 20px;">
                            <form class="preform" method="post" id="forgot-form">
                                <div class="alert alert-success mb-3" id="forgot-success" style="display:none"></div>
                                <div class="alert alert-danger mb-3" id="forgot-error" style="display:none"></div>
                                <div class="form-group">
                                    <label class="prelabel" for="forgot-email">Your Email</label>
                                    <input required type="text" class="form-control" id="forgot-email" name="email"
                                        placeholder="name@email.com">
                                </div>
                                <div data-theme="dark" class="g-recaptcha mb-3" id="forgot-recaptcha"></div>
                                <div class="form-group login-btn mb-0">
                                    <button class="btn btn-primary btn-block">Submit</button>
                                    <div class="loading-relative" id="forgot-loading" style="display: none;">
                                        <div class="loading">
                                            <div class="span1"></div>
                                            <div class="span2"></div>
                                            <div class="span3"></div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer text-center">
                            <a class="link-highlight login-tab-link" title=""><i class="fas fa-angle-left mr-2"></i>Back
                                to Sign-in</a>
                        </div>
                    </div>
                    <div id="modal-tab-verify" class="tab-pane fade">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modallogintitle3">Send Verification Email</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" style="padding-bottom: 20px;">
                            <form class="preform" method="post" id="verify-form">
                                <div class="alert alert-success mb-3" id="verify-success" style="display:none"></div>
                                <div class="alert alert-danger mb-3" id="verify-error" style="display:none"></div>
                                <div class="form-group">
                                    <label class="prelabel" for="verify-email">Your Email</label>
                                    <input required type="text" class="form-control" id="verify-email" name="email"
                                        placeholder="name@email.com">
                                </div>
                                <div data-theme="dark" class="g-recaptcha mb-3" id="verify-recaptcha"></div>
                                <div class="form-group login-btn mb-0">
                                    <button class="btn btn-primary btn-block">Submit</button>
                                    <div class="loading-relative" id="verify-loading" style="display: none;">
                                        <div class="loading">
                                            <div class="span1"></div>
                                            <div class="span2"></div>
                                            <div class="span3"></div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer text-center">
                            <a class="link-highlight login-tab-link" title=""><i class="fas fa-angle-left mr-2"></i>Back
                                to Sign-in</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade premodal premodal-manga" id="modalmanga" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="d-flex align-items-center cr-title">
                        <div class="manga-icon mr-3"><img src="/images/mgicon.png"></div>Available Manga Version
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div id="manga-list" class="content-related"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade premodal premodal-characters" id="modalcharacters" tabindex="-1" role="dialog"
        aria-labelledby="modalcharacterstitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-left" id="modalcharacterstitle">Characters & Voice Actors</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="modal-characters">
                        <div id="characters-content"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var recaptchaSiteKey = '6Lc7dH8pAAAAAIGw-BOEYDAZvcs3afxf6XHaLsQL',
            recaptchaV2SiteKey = '6LdCdH8pAAAAAMV9Qy_K16Fvm4pWGYWrAEpjRjgD';
    </script>
    <script src="https://www.google.com/recaptcha/api.js?render=6Lc7dH8pAAAAAIGw-BOEYDAZvcs3afxf6XHaLsQL&hl=en">
    </script>

    <script type="text/javascript"
        src="https://platform-api.sharethis.com/js/sharethis.js#property=64a3d891df473b0019d1b0da&product=inline-share-buttons&source=platform"
        async="async"></script>
    <script src="https://cdn.socket.io/4.5.4/socket.io.min.js"
        integrity="sha384-/KNQL8Nu5gCHLqwqfQjA689Hhoqgi2S84SNUxC3roTe4EhJ9AfLkp8QiQcU8AMzI" crossorigin="anonymous">
        </script>
    <script type="text/javascript" src="/js/app.min.js?v=1.4"></script>
    <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', function () {
                navigator.serviceWorker.register('/sw.js?v=0.5');
            });
        }
        $('.anime-request-link').click(function (e) {
            e.preventDefault();
            if (isLoggedIn) {
                window.location.href = $(this).attr('href');
            } else {
                $('#modallogin').modal('show');
            }
        });
    </script>

    <script type="text/javascript" src="/js/watch.min.js?v=3.4"></script>
    <style>
        @media screen and (max-width: 860px) {
            .anis-watch-detail .anis-content {
                padding-right: 0 !important;
                padding-top: 18px !important;
            }
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                // dataEmbed = "<?= $deaddrive ?>" + dataEmbed;
                var iframe = document.getElementById('iframe-embed');
                iframe.src = dataEmbed;
            }, {
                once: false
            }); // Add { once: true } to ensure the event listener is triggered only once
        });

        var firstChild = document.querySelector('.ps__-list .item:first-child');

        var dataEmbed = firstChild.getAttribute('data-embed');
        // dataEmbed = "<?= $deaddrive ?>" + dataEmbed;
        var iframe = document.getElementById('iframe-embed');
        iframe.src = dataEmbed;
        var button = firstChild.querySelector('.btn')
        button.style.backgroundColor = '#ffbade';
        button.style.color = '#111111';
    </script>

</body>

</html>