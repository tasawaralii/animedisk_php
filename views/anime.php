<?php
$anime = $params['anime'];
$id = $params['id'];

if (!is_numeric($id)) {
    require('error.php');
    exit;
} else {
    require('functions.php');
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
require('data.php');
$a = $post;
require('data.php');
$page = array(
    'title' => "Watch " . $a['anime_name'] . " Hindi Sub/Dub online Free on " . $data['name'],
    'description' => "Best site to watch " . $a['anime_name'] . " Hindi Sub/Dub online Free and download " . $a['anime_name'] . " Hindi Sub/Dub anime.",
    'keywords' => $a['anime_name'] . " Hindi Sub/Dub, free " . $a['anime_name'] . " online, watch " . $a['anime_name'] . " online, watch " . $a['anime_name'] . " free, download " . $a['anime_name'] . " anime, download " . $a['anime_name'] . " free",
    'css' => array(
        'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css',
        'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css',
        'https://use.fontawesome.com/releases/v5.3.1/css/all.css',
        'https://fonts.googleapis.com/icon?family=Material+Icons',
        '/css/styles.min.css?v=1.0'
    ),
    'header-class' => '',
);

$popular = fetchRemoteData("https://dbase.deaddrive.icu/api/anime/listanime.php?sort=popular&limit=10&key=deadtoonszylith");
$recommended = fetchRemoteData("https://dbase.deaddrive.icu/api/anime/listanime.php?sort=random&limit=24&key=deadtoonszylith");// anime($pdo, "Random", $limit = 12);
?>
<!DOCTYPE html>
<html lang="en">
<?php require('inc/head.php'); ?>

<body>
    <?php require('inc/sidebar.html'); ?>
    <div id="wrapper" data-id="15559" data-page="detail">
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
                                                <?php echo $a['anime_name'] ?></li>
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
    <!--Begin: Modal-->
    <div class="modal fade premodal premodal-video" id="modalpromotion" tabindex="-1" role="dialog"
        aria-labelledby="modalpromotiontitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" src="" id="if-promotion-src" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
    <!--End: Modal-->

    <script
        src="https://www.google.com/recaptcha/api.js?render=6Lc7dH8pAAAAAIGw-BOEYDAZvcs3afxf6XHaLsQL&hl=en"></script>
    <script type="text/javascript" src="/js/app.min.js?v=1.4"></script>

</body>

</html>