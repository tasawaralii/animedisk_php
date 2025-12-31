<head>
    <title><?php echo $page['title'] ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="robots" content="index,follow" />
    <meta http-equiv="content-language" content="en" />
    <meta name="description" content="<?php echo $page['description'] ?>" />
    <meta name="keywords" content="<?php echo $page['keywords'] ?>" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://<?php echo $data['domain'] ?>/" />
    <meta property="og:title" content="<?php echo $page['title'] ?>" />
    <meta property="og:image" content="https://<?php echo $data['domain'] ?>/public/capture.png" />
    <meta property="og:image:width" content="650">
    <meta property="og:image:height" content="350">
    <meta property="og:description" content="<?php echo $page['description'] ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
    <meta name="apple-mobile-web-app-status-bar" content="#202125">
    <meta name="theme-color" content="#202125">
    <link rel="shortcut icon" href="/public/favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon" sizes="180x180" href="/public/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/public/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/public/favicon-16x16.png">
    <meta name="msapplication-TileColor" content="#da532c">
    <link rel="icon" sizes="192x192" href="/public/icons-192.png">
    <link rel="icon" sizes="512x512" href="/public/icons-512.png">
    <link rel="manifest" href="/public/site.webmanifest">

    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "WebSite",
            "url": "https://<?php echo $data['domain'] ?>/",
            "potentialAction": {
                "@type": "SearchAction",
                "target": "https://<?php echo $data['domain'] ?>/search?keyword={keyword}",
                "query-input": "required name=keyword"
            }
        }
    </script>

    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css'>
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.3.1/css/all.css'>
    <?= isset($isHomePage) ? "<link rel='stylesheet' href='/css/home.css'>" : "" ?>
    <link rel='stylesheet' href='/css/styles.min.css'>
    <link rel='stylesheet' href='https://fonts.googleapis.com/icon?family=Material+Icons'>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css'>

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://unpkg.com/swiper@6.8.4/swiper-bundle.min.js"></script>
    <script type="text/javascript" src="/js/new.js"></script>

</head>