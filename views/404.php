<?php
http_response_code(404);
require('data.php');
$page = array(
    'title' => $data['name']." Free Anime Streaming Homepage",
    'description' => "Watch your favorite anime online in Dub or Sub format without registration on ".$data['domain']." fastest Streaming server NOW.",
    'keywords' => "watch anime online, anime site, free anime, anime to watch, online anime, anime streaming, stream anime online, english anime, english dubbed anime",
    'css' => array(
        'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css',
        'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css',
        'https://use.fontawesome.com/releases/v5.3.1/css/all.css',
        'https://fonts.googleapis.com/icon?family=Material+Icons',
        '/css/styles.min.css?v=1.0'
    ),
    'header-class' => 'header-home',
);
?>
<!DOCTYPE html>
<html lang="en">
<?php require('inc/head.php'); ?>
<body>
<div id="wrapper">
    <div id="main-wrapper" class="layout-page layout-page-404">
        <div class="container">
            <div class="container-404 text-center">
                <div class="c4-big-img"><img src="/public/404.png?v=0.2" alt="404 image"></div>
                <div class="c4-medium">404 Error</div>
                <div class="c4-small">Oops! We can&#39;t find this page.</div>
                <div class="c4-button">
                    <a href="/home" class="btn btn-radius btn-focus">
                        <i class="fa fa-chevron-circle-left mr-2"></i>Back to homepage
                    </a>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>

    
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