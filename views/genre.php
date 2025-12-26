<?php
require __DIR__ . '/_bootstrap.php';
$genre = $params['g'];
$sg = capitalize($genre);
$page = array(
    'title' => "Watch " . $sg . " Anime Hindi DUBBED Online",
    'description' => "Full list of the " . $sg . " Anime Online Free, with Hindi DUBBED. WATCH NOW",
    'keywords' => "must watch anime, best anime to watch, legendary anime, most popular anime, top anime, anime to watch",
    'css' => array(
        'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css',
        'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css',
        'https://use.fontawesome.com/releases/v5.3.1/css/all.css',
        'https://fonts.googleapis.com/icon?family=Material+Icons',
        '/css/styles.min.css?v=1.0'
    ),
    'header-class' => 'header-home',
);
$limit = 16;
$currentPage = ((isset($_GET['page'])) ? $_GET['page'] : 1);
$offset = ($currentPage - 1) * $limit;
$animes = fetchRemoteData("https://dbase.deaddrive.icu/api/anime/genre.php?genre=$genre&count=true&limit=$limit&offset=$offset&key=deadtoonszylith");
if (!$animes['animes']) {
    require('error.php');
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<?php require('inc/head.php') ?>

<body>
    <?php require('inc/sidebar.html') ?>

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

    <script>var recaptchaSiteKey = '6Lc7dH8pAAAAAIGw-BOEYDAZvcs3afxf6XHaLsQL',
            recaptchaV2SiteKey = '6LdCdH8pAAAAAMV9Qy_K16Fvm4pWGYWrAEpjRjgD';</script>
    <script
        src="https://www.google.com/recaptcha/api.js?render=6Lc7dH8pAAAAAIGw-BOEYDAZvcs3afxf6XHaLsQL&hl=en"></script>

    <script type="text/javascript"
        src="https://platform-api.sharethis.com/js/sharethis.js#property=64a3d891df473b0019d1b0da&product=inline-share-buttons&source=platform"
        async="async"></script>
    <script src="https://cdn.socket.io/4.5.4/socket.io.min.js"
        integrity="sha384-/KNQL8Nu5gCHLqwqfQjA689Hhoqgi2S84SNUxC3roTe4EhJ9AfLkp8QiQcU8AMzI"
        crossorigin="anonymous"></script>
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

</body>

</html>