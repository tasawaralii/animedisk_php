<?php
http_response_code(404);
require __DIR__ . '/_bootstrap.php';
$page = array(
    'title' => $data['name']." Free Anime Streaming Homepage",
    'description' => "Watch your favorite anime online in Dub or Sub format without registration on ".$data['domain']." fastest Streaming server NOW.",
    'keywords' => "watch anime online, anime site, free anime, anime to watch, online anime, anime streaming, stream anime online, english anime, english dubbed anime",
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
</body>
</html>