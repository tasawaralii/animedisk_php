<head>
    <title><?php echo $page['title'] ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<meta name="robots" content="index,follow"/>
<meta http-equiv="content-language" content="en"/>
<meta name="description" content="<?php echo $page['description'] ?>"/>
<meta name="keywords" content="<?php echo $page['keywords'] ?>"/>
<meta property="og:type" content="website"/>
<meta property="og:url" content="https://<?php echo $data['domain'] ?>/"/>
<meta property="og:title" content="<?php echo $page['title'] ?>"/>
<meta property="og:image" content="https://<?php echo $data['domain'] ?>/images/capture.png"/>
<meta property="og:image:width" content="650">
<meta property="og:image:height" content="350">
<meta property="og:description" content="<?php echo $page['description'] ?>"/>
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1"/>
<meta name="apple-mobile-web-app-status-bar" content="#202125">
<meta name="theme-color" content="#202125">
<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon"/>
<link rel="apple-touch-icon" sizes="180x180" href="/images/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="mask-icon" href="/images/safari-pinned-tab.svg" color="#ffbade">
<meta name="msapplication-TileColor" content="#da532c">
<link rel="icon" sizes="192x192" href="/images/icons-192.png">
<link rel="icon" sizes="512x512" href="/images/icons-512.png">
<link rel="manifest" href="/site.webmanifest">

<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-R34F2GCSBW');
</script>

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

<?php

    foreach($page['css'] as $css) {
        echo "<link rel='stylesheet' href='{$css}'>\n";
    }

?>
</head>