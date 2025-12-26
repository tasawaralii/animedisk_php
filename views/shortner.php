<?php

// https://animedisk.in/shortner?solved=true&hash=b4b3b003xd34dt00n

if (isset($_GET['solved']) && $_GET['solved'] == "true" && $_GET['hash'] == "b4b3b003xd34dt00n") {

    if (!isset($_COOKIE['fallback'])) {
        header("Location: /home");
        exit;
    }

    setcookie("dst", base64_encode(time() + 25 * 60 * 60), time() + 30 * 24 * 60 * 60, "/");
    $fallback = $_COOKIE['fallback'];
    setcookie("fallback", "", time() - 24 * 60 * 60, "/");
    header("Location: " . $fallback);
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" type="text/css" href="cid:css-e44f8cf8-ebaa-453a-9ec2-fb0dc41dfcfc@mhtml.blink" />
    <title>PureToons Free Anime Streaming Homepage</title>

    <meta name="robots" content="index,follow">
    <meta http-equiv="content-language" content="en">
    <meta name="description"
        content="Watch your favorite anime online in Dub or Sub format without registration on animedisk.in fastest Streaming server NOW.">
    <meta name="keywords"
        content="watch anime online, anime site, free anime, anime to watch, online anime, anime streaming, stream anime online, english anime, english dubbed anime">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://animedisk.in/">
    <meta property="og:title" content="PureToons Free Anime Streaming Homepage">
    <meta property="og:image" content="https://animedisk.in/images/capture.png">
    <meta property="og:image:width" content="650">
    <meta property="og:image:height" content="350">
    <meta property="og:description"
        content="Watch your favorite anime online in Dub or Sub format without registration on animedisk.in fastest Streaming server NOW.">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar" content="#202125">
    <meta name="theme-color" content="#202125">
    <link rel="shortcut icon" href="https://animedisk.in/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" sizes="180x180" href="https://animedisk.in/images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="https://animedisk.in/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="https://animedisk.in/favicon-16x16.png">
    <link rel="mask-icon" href="https://animedisk.in/images/safari-pinned-tab.svg" color="#ffbade">
    <meta name="msapplication-TileColor" content="#da532c">
    <link rel="icon" sizes="192x192" href="https://animedisk.in/images/icons-192.png">
    <link rel="icon" sizes="512x512" href="https://animedisk.in/images/icons-512.png">
    <link rel="manifest" href="https://animedisk.in/site.webmanifest">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://animedisk.in/css/styles.min.css?v=1.0">
</head>
<style>
    .video-container {
        position: relative;
        aspect-ratio: 9 / 16;
        max-width: 300px;
        margin: 0px auto;
        overflow: hidden;
        border: 2px solid rgb(148, 148, 148);
        border-radius: 15px;
    }

    .video-container iframe {
        position: absolute;
        top: 0px;
        left: 0px;
        width: 100%;
        height: 100%;
    }
</style>

<body>
    <div id="wrapper">
        <div id="main-wrapper" class="layout-page layout-page-404">
            <div class="container">
                <div class="text-center mt-5">
                    <div class="c4-medium"><strong>Solve Link Shortner</strong></div>
                    <br>
                    <div class="c4-small">You Need to Solve 1 Link Shortner per 24 hours</div>
                    <div class="c4-button">
                        <a href="https://krownlinks.me/CPdxsO" class="btn btn-radius btn-focus mt-3 mb-3">Solve (Krown)
                            V1</a>
                        <br>
                        <a href="https://cuty.io/8f9Kq" class="btn btn-radius btn-focus mt-3 mb-3">Solve (Cutty) V2</a>
                        <br>
                        <a href="https://hyp.sh/hMsnKEKV" class="btn btn-radius btn-focus mt-3 mb-3">Solve (Hyper)
                            V3</a>
                    </div>
                    <div>
                        <a class="btn bg-primary btn-radius mt-3 mb-3" href="https://telegram.dog/deadstream_anime"><i
                                class="fa fa-telegram" aria-hidden="true"></i>Report Problem</a>
                    </div>
                    <strong>How to Solve Shortner</strong>
                    <br><br>
                    <div class="video-container">
                        <iframe src="/images/cutty.mp4" title="How to Skip Ads" frameborder="0" allowfullscreen="">
                        </iframe>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</body>

</html>