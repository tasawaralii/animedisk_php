<?php
require('data.php');
require('functions.php');

require_once __DIR__ . "/../src/Api.php";

$api = new Api();

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
$animes = fetchRemoteData("https://dbase.deaddrive.icu/api/anime/listanime.php?sort=new&type=tv&key=deadtoonszylith"); // Latest Episode
$new_animes = fetchRemoteData("https://dbase.deaddrive.icu/api/anime/listanime.php?key=deadtoonszylith");
$movies = fetchRemoteData("https://dbase.deaddrive.icu/api/anime/listanime.php?type=movie&sort=new&key=deadtoonszylith"); // anime("Movie");

$daily = $api->popularToday();
$weekly = $api->popularWeek();

?>
<!DOCTYPE html>
<html lang="en">
<?php require('inc/head.php'); ?>
<body>
<?php require('inc/sidebar.html'); ?>
<div id="wrapper">
<?php require('inc/header.php'); ?>    
    <!--Begin: Slider-->
    <div class="deslide-wrap">
        <div class="container">
            <div id="slider">
                <div class="swiper-wrapper">
                    
                    <?php
                    $i = 0;
                    foreach($weekly as $a) {
                        $i++;
                    ?>
                    
                    <div class="swiper-slide">
                        <div class="deslide-item">
                            <div class="deslide-cover">
                                <div class="deslide-cover-img">
                                    <img class="film-poster-img lazyload"
                                         data-src="<?php echo img($a , "backdrop" , "high")?>"
                                         alt="<?php echo $a['anime_name'] ?>">
                                </div>
                            </div>
                            <div class="deslide-item-content">
                                <div class="desi-sub-text">#<?php echo $i ?> Spotlight</div>
                                <div class="desi-head-title dynamic-name"><?php echo $a['anime_name'] ?></div>
                                <div class="sc-detail">
                                    <div class="scd-item"><i
                                                class="fas fa-play-circle mr-1"></i><?php echo strtoupper($a['type']) ?>
                                    </div>
                                    <div class="scd-item"><i
                                                class="fas fa-clock mr-1"></i><?php echo $a['duration']."m" ?>
                                    </div>
                                    <div class="scd-item m-hide"><i
                                                class="fas fa-calendar mr-1"></i><?php echo $a['anime_rel_date'] ?>
                                    </div>
                                    <div class="scd-item mr-1"><span
                                                class="quality">HD</span>
                                    </div>
                                    <div class="scd-item">
                                        <div class="tick">
                                            
    <div class="tick-item tick-dub"><i
                class="fas fa-microphone mr-1"></i><?php echo ($a['type'] == "tv") ? $a['total_episodes'] : "Movie" ; ?></div>


                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="desi-description">
                                    <?php echo $a['overview'] ?>
                                </div>
                                <div class="desi-buttons">
                                    <a href="/<?php echo $a['slug']."-".$a['anime_id'].(($a['type'] != 'tv') ? "?type=movie" : ''); ?>" class="btn btn-primary btn-radius mr-2"><i
                                                class="fas fa-play-circle mr-2"></i>Watch Now</a>
                                    <a href="/<?php echo $a['slug']."-".$a['anime_id'] ?>" class="btn btn-secondary btn-radius">Detail<i
                                                class="fas fa-angle-right ml-2"></i></a>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    
                    <?php
                    }
                    ?>
                    
                    
                </div>
                <div class="swiper-pagination"></div>
                <div class="swiper-navigation">
                    <div class="swiper-button swiper-button-next"><i class="fas fa-angle-right"></i></div>
                    <div class="swiper-button swiper-button-prev"><i class="fas fa-angle-left"></i></div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <!--/End: Slider-->
    <style>
    .tick.tick-sub {
    position: absolute;
    right: 10px;
    bottom: 10px;
    line-height: 1.1;
    background: #ff5700;
    color: #fff;
    font-weight: 600;
    border-radius: 5px;
    padding: 4px 6px;
    box-shadow: 0 0 5px 0 rgba(0,0,0,.3);
    min-width: 36px;
    text-align: center;
    font-size: 12px;
}
    .intro-app{ position: relative; font-size: 14px; margin: 2rem auto; max-width: 700px; overflow: hidden; background: rgb(69,12,14); background: linear-gradient(148deg, rgba(69,12,14,1) 0%, rgba(163,23,28,1) 100%);}
    .intro-app::before{ content: ""; position: absolute; top: 10px; left: 10px; right: 10px; bottom: 10px; border: 1px solid rgba(255,255,255,.2); z-index: 1;}
    .intro-app .ina-flex{ display: flex; align-items: stretch; flex-direction: row-reverse; position: relative; padding: 2rem; z-index: 3;}
    .intro-app .ina-flex .ina-screen{ width: 240px; flex-shrink: 0; position: absolute; right: 30px; top: 20px; animation: app-screen 1s infinite linear;}
    @keyframes app-screen {
        0% { transform: scale(1.05);}
        50% { transform: scale(1);}
        100% { transform: scale(1.05);}
    }
    .intro-app .ina-flex .ina-screen img{ width: 100%;}
    .intro-app .ina-flex .ina-content{ flex-grow: 1;}
    .ina-head-lg{ font-size: 1.6em; line-height: 1.4; color: #fff; font-weight: 600; margin-bottom: .5rem;}
    .ina-head-md{ font-size: 1em; line-height: 1.4; color: #fff; font-weight: 500; margin-bottom: 1.5rem; opacity: .8;}
    .is-fea{ padding: 1rem 0 3rem;}
    .is-fea .ina-ul{ padding: 0; margin: 0; list-style: none;}
    .is-fea .ina-ul li{ position: relative; padding: .5rem 0 .5rem 1.2rem; font-size: 15px;}
    .is-fea .ina-ul li:before{ content: ""; width: 6px; height: 6px; border-radius: 50%; background-color: #fff; display: block; position: absolute; top: calc(50% - 3px); left: 0;}
    .ina-buttons{ display: flex; flex-direction: column; gap: 1rem; max-width: 500px;}
    .ina-buttons .btn{ padding: .75rem 1rem; border-radius: .4rem; font-size: 14px; font-weight: 500; max-width: 180px; background-color: #fff; color: #111 !important;}
    @media screen and (max-width: 740px){
        .intro-app{ border-radius: 0;}
        .intro-app .ina-flex{ padding: 1.5rem; padding-right: 160px;}
        .intro-app .ina-flex .ina-screen{ width: 160px; right: -10px; top: 10px;}
        .ina-head-lg{ font-size: 1.2em;}
        .ina-head-md{ font-size: .9em; margin-bottom: 1rem;}
        .ina-buttons .btn{ padding: 0; background-color: transparent; color: #fff !important; width: auto !important;}
        .ina-buttons .btn > div{ justify-content: flex-start !important;}
    }
</style>
<div class="intro-app" style="display: none">
    <div class="ina-flex">
        <div class="ina-screen">
            <img src="/public/download-apk.webp">
        </div>
        <div class="ina-content">
            <h1 class="ina-head-lg">BEST Free Anime App</h1>
            <h2 class="ina-head-md">Watch all Anime in HD on your Android devices</h2>
            <div class="ina-buttons">
                <a class="btn" href="/app-download">
                    <div class="d-flex align-items-center justify-content-center">
                        <span class="mr-3">Download Now</span>
                        <i class="fas fa-angle-right"></i>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
    <!--Begin: trending-->
    <div id="anime-trending">
        <div class="container">
            <section class="block_area block_area_trending">
                <div class="block_area-header">
                    <div class="bah-heading">
                        <h2 class="cat-heading">Trending</h2>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="block_area-content">
                    <div class="trending-list" id="trending-home" style="display: none;">
                        <div class="swiper-container">
                            <div class="swiper-wrapper">
                                
                                <?php
                                $i = 0;
                                foreach ($daily as $a) {
                                    $i++;
                                ?>
                                
                                <div class="swiper-slide item-qtip" data-id="<?php echo $a['anime_id'] ?>">
                                    <div class="item">
                                        <div class="number">
                                            <span><?php echo str_pad($i, 2, 0, STR_PAD_LEFT) ?></span>
                                            <div class="film-title dynamic-name"><?php echo $a['anime_name'] ?></div>
                                        </div>
                                        <a href="/<?php echo $a['slug']."-".$a['anime_id'] ?>" class="film-poster">
                                            <img data-src="<?php echo img($a , "poster" , "low") ?>"
                                                 class="film-poster-img lazyload" title="<?php echo $a['anime_name'] ?>"
                                                 alt="<?php echo $a['anime_name'] ?>">
                                        </a>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                
                                <?php
                                }
                                ?>
                                
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="trending-navi">
                            <div class="navi-next"><i class="fas fa-angle-right"></i></div>
                            <div class="navi-prev"><i class="fas fa-angle-left"></i></div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <!--/End: trending-->
    
    <!--Begin: Events-->
    
    <!--/End: Events-->
    <!-- Begin: featured -->
<!--    <div id="anime-featured">-->
<!--        <div class="container">-->
<!--            <div class="anif-blocks">-->
<!--                <div class="row">-->
<!--                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-xs-12">-->
<!--                        <div class="anif-block anif-block-01">-->
<!--                            <div class="anif-block-header">Top Airing</div>-->
<!--                            <div class="anif-block-ul">-->
<!--                                <ul class="ulclear">-->
                                    
                                    
<!--<li>-->
<!--    <div class="film-poster item-qtip" data-id="100">-->
<!--        <a href="/one-piece-100">-->
<!--            <img data-src="https://cdn.noitatnemucod.net/thumbnail/300x400/100/bcd84731a3eda4f4a306250769675065.jpg"-->
<!--                 class="film-poster-img lazyload" alt="One Piece">-->
<!--        </a>-->
<!--    </div>-->
<!--    <div class="film-detail">-->
<!--        <h3 class="film-name"><a href="/one-piece-100"-->
<!--                                 title="One Piece" class="dynamic-name"-->
<!--                                 data-jname="One Piece">One Piece</a></h3>-->
<!--        <div class="fd-infor">-->
<!--            <div class="tick">-->
                


<!--    <div class="tick-item tick-sub"><i-->
<!--                class="fas fa-closed-captioning mr-1"></i>1103</div>-->


<!--    <div class="tick-item tick-dub"><i-->
<!--                class="fas fa-microphone mr-1"></i>1073</div>-->


<!--                <span class="dot"></span>-->
<!--                <span class="fdi-item">TV</span>-->
                
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="clearfix"></div>-->
<!--</li>-->

<!--<li>-->
<!--    <div class="film-poster item-qtip" data-id="18877">-->
<!--        <a href="/tsukimichi-moonlit-fantasy-season-2-18877">-->
<!--            <img data-src="https://cdn.noitatnemucod.net/thumbnail/300x400/100/74738a6fa2c6303f2da0603d58c67671.jpg"-->
<!--                 class="film-poster-img lazyload" alt="Tsukimichi -Moonlit Fantasy- Season 2">-->
<!--        </a>-->
<!--    </div>-->
<!--    <div class="film-detail">-->
<!--        <h3 class="film-name"><a href="/tsukimichi-moonlit-fantasy-season-2-18877"-->
<!--                                 title="Tsukimichi -Moonlit Fantasy- Season 2" class="dynamic-name"-->
<!--                                 data-jname="Tsuki ga Michibiku Isekai Douchuu 2nd Season">Tsukimichi -Moonlit Fantasy- Season 2</a></h3>-->
<!--        <div class="fd-infor">-->
<!--            <div class="tick">-->
                


<!--    <div class="tick-item tick-sub"><i-->
<!--                class="fas fa-closed-captioning mr-1"></i>18</div>-->


<!--    <div class="tick-item tick-dub"><i-->
<!--                class="fas fa-microphone mr-1"></i>16</div>-->


<!--                <span class="dot"></span>-->
<!--                <span class="fdi-item">TV</span>-->
                
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="clearfix"></div>-->
<!--</li>-->

<!--<li>-->
<!--    <div class="film-poster item-qtip" data-id="323">-->
<!--        <a href="/case-closed-323">-->
<!--            <img data-src="https://cdn.noitatnemucod.net/thumbnail/300x400/100/3b185ed9d10aa300bb0cb7fc35b84999.jpg"-->
<!--                 class="film-poster-img lazyload" alt="Case Closed">-->
<!--        </a>-->
<!--    </div>-->
<!--    <div class="film-detail">-->
<!--        <h3 class="film-name"><a href="/case-closed-323"-->
<!--                                 title="Case Closed" class="dynamic-name"-->
<!--                                 data-jname="Detective Conan">Case Closed</a></h3>-->
<!--        <div class="fd-infor">-->
<!--            <div class="tick">-->
                


<!--    <div class="tick-item tick-sub"><i-->
<!--                class="fas fa-closed-captioning mr-1"></i>1122</div>-->


<!--    <div class="tick-item tick-dub"><i-->
<!--                class="fas fa-microphone mr-1"></i>123</div>-->


<!--                <span class="dot"></span>-->
<!--                <span class="fdi-item">TV</span>-->
                
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="clearfix"></div>-->
<!--</li>-->

<!--<li>-->
<!--    <div class="film-poster item-qtip" data-id="19136">-->
<!--        <a href="/wind-breaker-19136">-->
<!--            <img data-src="https://cdn.noitatnemucod.net/thumbnail/300x400/100/d9bb23228e5a641b5a3e9386382dae3a.jpg"-->
<!--                 class="film-poster-img lazyload" alt="Wind Breaker">-->
<!--        </a>-->
<!--    </div>-->
<!--    <div class="film-detail">-->
<!--        <h3 class="film-name"><a href="/wind-breaker-19136"-->
<!--                                 title="Wind Breaker" class="dynamic-name"-->
<!--                                 data-jname="Wind Breaker">Wind Breaker</a></h3>-->
<!--        <div class="fd-infor">-->
<!--            <div class="tick">-->
                


<!--    <div class="tick-item tick-sub"><i-->
<!--                class="fas fa-closed-captioning mr-1"></i>6</div>-->


<!--    <div class="tick-item tick-dub"><i-->
<!--                class="fas fa-microphone mr-1"></i>4</div>-->


<!--                <span class="dot"></span>-->
<!--                <span class="fdi-item">TV</span>-->
                
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="clearfix"></div>-->
<!--</li>-->

<!--<li>-->
<!--    <div class="film-poster item-qtip" data-id="19145">-->
<!--        <a href="/kaiju-no-8-19145">-->
<!--            <img data-src="https://cdn.noitatnemucod.net/thumbnail/300x400/100/edfc7fe935b6eac2d704cf5b0a60e356.jpg"-->
<!--                 class="film-poster-img lazyload" alt="Kaiju No. 8">-->
<!--        </a>-->
<!--    </div>-->
<!--    <div class="film-detail">-->
<!--        <h3 class="film-name"><a href="/kaiju-no-8-19145"-->
<!--                                 title="Kaiju No. 8" class="dynamic-name"-->
<!--                                 data-jname="Kaijuu 8-gou">Kaiju No. 8</a></h3>-->
<!--        <div class="fd-infor">-->
<!--            <div class="tick">-->
                


<!--    <div class="tick-item tick-sub"><i-->
<!--                class="fas fa-closed-captioning mr-1"></i>4</div>-->


<!--    <div class="tick-item tick-dub"><i-->
<!--                class="fas fa-microphone mr-1"></i>4</div>-->


<!--                <span class="dot"></span>-->
<!--                <span class="fdi-item">TV</span>-->
                
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="clearfix"></div>-->
<!--</li>-->

<!--                                </ul>-->
<!--                                <div class="clearfix"></div>-->
<!--                            </div>-->
<!--                            <div class="more"><a href="/top-airing">View more <i-->
<!--                                            class="fas fa-angle-right ml-2"></i></a></div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-xs-12">-->
<!--                        <div class="anif-block anif-block-03">-->
<!--                            <div class="anif-block-header">Most Popular</div>-->
<!--                            <div class="anif-block-ul">-->
<!--                                <ul class="ulclear">-->
                                    
                                    
<!--<li>-->
<!--    <div class="film-poster item-qtip" data-id="100">-->
<!--        <a href="/one-piece-100">-->
<!--            <img data-src="https://cdn.noitatnemucod.net/thumbnail/300x400/100/bcd84731a3eda4f4a306250769675065.jpg"-->
<!--                 class="film-poster-img lazyload" alt="One Piece">-->
<!--        </a>-->
<!--    </div>-->
<!--    <div class="film-detail">-->
<!--        <h3 class="film-name"><a href="/one-piece-100"-->
<!--                                 title="One Piece" class="dynamic-name"-->
<!--                                 data-jname="One Piece">One Piece</a></h3>-->
<!--        <div class="fd-infor">-->
<!--            <div class="tick">-->
                


<!--    <div class="tick-item tick-sub"><i-->
<!--                class="fas fa-closed-captioning mr-1"></i>1103</div>-->


<!--    <div class="tick-item tick-dub"><i-->
<!--                class="fas fa-microphone mr-1"></i>1073</div>-->


<!--                <span class="dot"></span>-->
<!--                <span class="fdi-item">TV</span>-->
                
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="clearfix"></div>-->
<!--</li>-->

<!--<li>-->
<!--    <div class="film-poster item-qtip" data-id="355">-->
<!--        <a href="/naruto-shippuden-355">-->
<!--            <img data-src="https://cdn.noitatnemucod.net/thumbnail/300x400/100/9cbcf87f54194742e7686119089478f8.jpg"-->
<!--                 class="film-poster-img lazyload" alt="Naruto: Shippuden">-->
<!--        </a>-->
<!--    </div>-->
<!--    <div class="film-detail">-->
<!--        <h3 class="film-name"><a href="/naruto-shippuden-355"-->
<!--                                 title="Naruto: Shippuden" class="dynamic-name"-->
<!--                                 data-jname="Naruto: Shippuuden">Naruto: Shippuden</a></h3>-->
<!--        <div class="fd-infor">-->
<!--            <div class="tick">-->
                


<!--    <div class="tick-item tick-sub"><i-->
<!--                class="fas fa-closed-captioning mr-1"></i>500</div>-->


<!--    <div class="tick-item tick-dub"><i-->
<!--                class="fas fa-microphone mr-1"></i>500</div>-->


<!--    <div class="tick-item tick-eps">500</div>-->

<!--                <span class="dot"></span>-->
<!--                <span class="fdi-item">TV</span>-->
                
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="clearfix"></div>-->
<!--</li>-->

<!--<li>-->
<!--    <div class="film-poster item-qtip" data-id="18413">-->
<!--        <a href="/jujutsu-kaisen-2nd-season-18413">-->
<!--            <img data-src="https://cdn.noitatnemucod.net/thumbnail/300x400/100/b51f863b05f30576cf9d85fa9b911bb5.png"-->
<!--                 class="film-poster-img lazyload" alt="Jujutsu Kaisen 2nd Season">-->
<!--        </a>-->
<!--    </div>-->
<!--    <div class="film-detail">-->
<!--        <h3 class="film-name"><a href="/jujutsu-kaisen-2nd-season-18413"-->
<!--                                 title="Jujutsu Kaisen 2nd Season" class="dynamic-name"-->
<!--                                 data-jname="Jujutsu Kaisen 2nd Season">Jujutsu Kaisen 2nd Season</a></h3>-->
<!--        <div class="fd-infor">-->
<!--            <div class="tick">-->
                


<!--    <div class="tick-item tick-sub"><i-->
<!--                class="fas fa-closed-captioning mr-1"></i>23</div>-->


<!--    <div class="tick-item tick-dub"><i-->
<!--                class="fas fa-microphone mr-1"></i>23</div>-->


<!--    <div class="tick-item tick-eps">23</div>-->

<!--                <span class="dot"></span>-->
<!--                <span class="fdi-item">TV</span>-->
                
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="clearfix"></div>-->
<!--</li>-->

<!--<li>-->
<!--    <div class="film-poster item-qtip" data-id="806">-->
<!--        <a href="/bleach-806">-->
<!--            <img data-src="https://cdn.noitatnemucod.net/thumbnail/300x400/100/bd5ae1d387a59c5abcf5e1a6a616728c.jpg"-->
<!--                 class="film-poster-img lazyload" alt="Bleach">-->
<!--        </a>-->
<!--    </div>-->
<!--    <div class="film-detail">-->
<!--        <h3 class="film-name"><a href="/bleach-806"-->
<!--                                 title="Bleach" class="dynamic-name"-->
<!--                                 data-jname="Bleach">Bleach</a></h3>-->
<!--        <div class="fd-infor">-->
<!--            <div class="tick">-->
                


<!--    <div class="tick-item tick-sub"><i-->
<!--                class="fas fa-closed-captioning mr-1"></i>366</div>-->


<!--    <div class="tick-item tick-dub"><i-->
<!--                class="fas fa-microphone mr-1"></i>366</div>-->


<!--    <div class="tick-item tick-eps">366</div>-->

<!--                <span class="dot"></span>-->
<!--                <span class="fdi-item">TV</span>-->
                
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="clearfix"></div>-->
<!--</li>-->

<!--<li>-->
<!--    <div class="film-poster item-qtip" data-id="2404">-->
<!--        <a href="/black-clover-2404">-->
<!--            <img data-src="https://cdn.noitatnemucod.net/thumbnail/300x400/100/f58b0204c20ae3310f65ae7b8cb9987e.jpg"-->
<!--                 class="film-poster-img lazyload" alt="Black Clover">-->
<!--        </a>-->
<!--    </div>-->
<!--    <div class="film-detail">-->
<!--        <h3 class="film-name"><a href="/black-clover-2404"-->
<!--                                 title="Black Clover" class="dynamic-name"-->
<!--                                 data-jname="Black Clover">Black Clover</a></h3>-->
<!--        <div class="fd-infor">-->
<!--            <div class="tick">-->
                


<!--    <div class="tick-item tick-sub"><i-->
<!--                class="fas fa-closed-captioning mr-1"></i>170</div>-->


<!--    <div class="tick-item tick-dub"><i-->
<!--                class="fas fa-microphone mr-1"></i>170</div>-->


<!--    <div class="tick-item tick-eps">170</div>-->

<!--                <span class="dot"></span>-->
<!--                <span class="fdi-item">TV</span>-->
                
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="clearfix"></div>-->
<!--</li>-->

<!--                                </ul>-->
<!--                                <div class="clearfix"></div>-->
<!--                            </div>-->
<!--                            <div class="more"><a href="/most-popular">View more <i-->
<!--                                            class="fas fa-angle-right ml-2"></i></a></div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-xs-12">-->
<!--                        <div class="anif-block anif-block-02">-->
<!--                            <div class="anif-block-header">Most Favorite</div>-->
<!--                            <div class="anif-block-ul">-->
<!--                                <ul class="ulclear">-->
                                    
                                    
<!--<li>-->
<!--    <div class="film-poster item-qtip" data-id="100">-->
<!--        <a href="/one-piece-100">-->
<!--            <img data-src="https://cdn.noitatnemucod.net/thumbnail/300x400/100/bcd84731a3eda4f4a306250769675065.jpg"-->
<!--                 class="film-poster-img lazyload" alt="One Piece">-->
<!--        </a>-->
<!--    </div>-->
<!--    <div class="film-detail">-->
<!--        <h3 class="film-name"><a href="/one-piece-100"-->
<!--                                 title="One Piece" class="dynamic-name"-->
<!--                                 data-jname="One Piece">One Piece</a></h3>-->
<!--        <div class="fd-infor">-->
<!--            <div class="tick">-->
                


<!--    <div class="tick-item tick-sub"><i-->
<!--                class="fas fa-closed-captioning mr-1"></i>1103</div>-->


<!--    <div class="tick-item tick-dub"><i-->
<!--                class="fas fa-microphone mr-1"></i>1073</div>-->


<!--                <span class="dot"></span>-->
<!--                <span class="fdi-item">TV</span>-->
                
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="clearfix"></div>-->
<!--</li>-->

<!--<li>-->
<!--    <div class="film-poster item-qtip" data-id="17406">-->
<!--        <a href="/chainsaw-man-17406">-->
<!--            <img data-src="https://cdn.noitatnemucod.net/thumbnail/300x400/100/b3da1326e07269ddd8d73475c5dabf2c.jpg"-->
<!--                 class="film-poster-img lazyload" alt="Chainsaw Man">-->
<!--        </a>-->
<!--    </div>-->
<!--    <div class="film-detail">-->
<!--        <h3 class="film-name"><a href="/chainsaw-man-17406"-->
<!--                                 title="Chainsaw Man" class="dynamic-name"-->
<!--                                 data-jname="Chainsaw Man">Chainsaw Man</a></h3>-->
<!--        <div class="fd-infor">-->
<!--            <div class="tick">-->
                


<!--    <div class="tick-item tick-sub"><i-->
<!--                class="fas fa-closed-captioning mr-1"></i>12</div>-->


<!--    <div class="tick-item tick-dub"><i-->
<!--                class="fas fa-microphone mr-1"></i>12</div>-->


<!--    <div class="tick-item tick-eps">12</div>-->

<!--                <span class="dot"></span>-->
<!--                <span class="fdi-item">TV</span>-->
                
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="clearfix"></div>-->
<!--</li>-->

<!--<li>-->
<!--    <div class="film-poster item-qtip" data-id="534">-->
<!--        <a href="/jujutsu-kaisen-tv-534">-->
<!--            <img data-src="https://cdn.noitatnemucod.net/thumbnail/300x400/100/82402f796b7d84d7071ab1e03ff7747a.jpg"-->
<!--                 class="film-poster-img lazyload" alt="Jujutsu Kaisen (TV)">-->
<!--        </a>-->
<!--    </div>-->
<!--    <div class="film-detail">-->
<!--        <h3 class="film-name"><a href="/jujutsu-kaisen-tv-534"-->
<!--                                 title="Jujutsu Kaisen (TV)" class="dynamic-name"-->
<!--                                 data-jname="Jujutsu Kaisen (TV)">Jujutsu Kaisen (TV)</a></h3>-->
<!--        <div class="fd-infor">-->
<!--            <div class="tick">-->
                


<!--    <div class="tick-item tick-sub"><i-->
<!--                class="fas fa-closed-captioning mr-1"></i>24</div>-->


<!--    <div class="tick-item tick-dub"><i-->
<!--                class="fas fa-microphone mr-1"></i>24</div>-->


<!--    <div class="tick-item tick-eps">24</div>-->

<!--                <span class="dot"></span>-->
<!--                <span class="fdi-item">TV</span>-->
                
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="clearfix"></div>-->
<!--</li>-->

<!--<li>-->
<!--    <div class="film-poster item-qtip" data-id="18056">-->
<!--        <a href="/demon-slayer-kimetsu-no-yaiba-swordsmith-village-arc-18056">-->
<!--            <img data-src="https://cdn.noitatnemucod.net/thumbnail/300x400/100/db2f3ce7b9cab7fdc160b005bffb899a.png"-->
<!--                 class="film-poster-img lazyload" alt="Demon Slayer: Kimetsu no Yaiba Swordsmith Village Arc">-->
<!--        </a>-->
<!--    </div>-->
<!--    <div class="film-detail">-->
<!--        <h3 class="film-name"><a href="/demon-slayer-kimetsu-no-yaiba-swordsmith-village-arc-18056"-->
<!--                                 title="Demon Slayer: Kimetsu no Yaiba Swordsmith Village Arc" class="dynamic-name"-->
<!--                                 data-jname="Kimetsu no Yaiba: Katanakaji no Sato-hen">Demon Slayer: Kimetsu no Yaiba Swordsmith Village Arc</a></h3>-->
<!--        <div class="fd-infor">-->
<!--            <div class="tick">-->
                


<!--    <div class="tick-item tick-sub"><i-->
<!--                class="fas fa-closed-captioning mr-1"></i>11</div>-->


<!--    <div class="tick-item tick-dub"><i-->
<!--                class="fas fa-microphone mr-1"></i>11</div>-->


<!--    <div class="tick-item tick-eps">11</div>-->

<!--                <span class="dot"></span>-->
<!--                <span class="fdi-item">TV</span>-->
                
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="clearfix"></div>-->
<!--</li>-->

<!--<li>-->
<!--    <div class="film-poster item-qtip" data-id="112">-->
<!--        <a href="/attack-on-titan-112">-->
<!--            <img data-src="https://cdn.noitatnemucod.net/thumbnail/300x400/100/debf027d032c6d40b91fab16b2ff9bd4.jpg"-->
<!--                 class="film-poster-img lazyload" alt="Attack on Titan">-->
<!--        </a>-->
<!--    </div>-->
<!--    <div class="film-detail">-->
<!--        <h3 class="film-name"><a href="/attack-on-titan-112"-->
<!--                                 title="Attack on Titan" class="dynamic-name"-->
<!--                                 data-jname="Shingeki no Kyojin">Attack on Titan</a></h3>-->
<!--        <div class="fd-infor">-->
<!--            <div class="tick">-->
                


<!--    <div class="tick-item tick-sub"><i-->
<!--                class="fas fa-closed-captioning mr-1"></i>25</div>-->


<!--    <div class="tick-item tick-dub"><i-->
<!--                class="fas fa-microphone mr-1"></i>25</div>-->


<!--    <div class="tick-item tick-eps">25</div>-->

<!--                <span class="dot"></span>-->
<!--                <span class="fdi-item">TV</span>-->
                
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="clearfix"></div>-->
<!--</li>-->

<!--                                </ul>-->
<!--                                <div class="clearfix"></div>-->
<!--                            </div>-->
<!--                            <div class="more"><a href="/most-favorite">View more <i-->
<!--                                            class="fas fa-angle-right ml-2"></i></a></div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-xs-12">-->
<!--                        <div class="anif-block anif-block-02">-->
<!--                            <div class="anif-block-header">Latest Completed</div>-->
<!--                            <div class="anif-block-ul">-->
<!--                                <ul class="ulclear">-->
                                    
                                    
<!--<li>-->
<!--    <div class="film-poster item-qtip" data-id="5695">-->
<!--        <a href="/neo-ranga-5695">-->
<!--            <img data-src="https://cdn.noitatnemucod.net/thumbnail/300x400/100/093992d99e1c7dd2dfd0f364e48999b2.jpg"-->
<!--                 class="film-poster-img lazyload" alt="Neo Ranga">-->
<!--        </a>-->
<!--    </div>-->
<!--    <div class="film-detail">-->
<!--        <h3 class="film-name"><a href="/neo-ranga-5695"-->
<!--                                 title="Neo Ranga" class="dynamic-name"-->
<!--                                 data-jname="Neo Ranga">Neo Ranga</a></h3>-->
<!--        <div class="fd-infor">-->
<!--            <div class="tick">-->
                


<!--    <div class="tick-item tick-sub"><i-->
<!--                class="fas fa-closed-captioning mr-1"></i>48</div>-->



<!--    <div class="tick-item tick-eps">48</div>-->

<!--                <span class="dot"></span>-->
<!--                <span class="fdi-item">TV</span>-->
                
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="clearfix"></div>-->
<!--</li>-->

<!--<li>-->
<!--    <div class="film-poster item-qtip" data-id="18589">-->
<!--        <a href="/the-vexations-of-a-shut-in-vampire-princess-18589">-->
<!--            <img data-src="https://cdn.noitatnemucod.net/thumbnail/300x400/100/8aa6e7e042d898d85ab93d880f99015b.jpg"-->
<!--                 class="film-poster-img lazyload" alt="The Vexations of a Shut-In Vampire Princess">-->
<!--        </a>-->
<!--    </div>-->
<!--    <div class="film-detail">-->
<!--        <h3 class="film-name"><a href="/the-vexations-of-a-shut-in-vampire-princess-18589"-->
<!--                                 title="The Vexations of a Shut-In Vampire Princess" class="dynamic-name"-->
<!--                                 data-jname="Hikikomari Kyuuketsuki no Monmon">The Vexations of a Shut-In Vampire Princess</a></h3>-->
<!--        <div class="fd-infor">-->
<!--            <div class="tick">-->
                


<!--    <div class="tick-item tick-sub"><i-->
<!--                class="fas fa-closed-captioning mr-1"></i>12</div>-->


<!--    <div class="tick-item tick-dub"><i-->
<!--                class="fas fa-microphone mr-1"></i>4</div>-->


<!--    <div class="tick-item tick-eps">12</div>-->

<!--                <span class="dot"></span>-->
<!--                <span class="fdi-item">TV</span>-->
                
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="clearfix"></div>-->
<!--</li>-->

<!--<li>-->
<!--    <div class="film-poster item-qtip" data-id="71">-->
<!--        <a href="/natsumes-book-of-friends-season-5-71">-->
<!--            <img data-src="https://cdn.noitatnemucod.net/thumbnail/300x400/100/aaf0b6dc164e4ffed2c5cc9ad04927d6.jpg"-->
<!--                 class="film-poster-img lazyload" alt="Natsume&#39;s Book of Friends Season 5">-->
<!--        </a>-->
<!--    </div>-->
<!--    <div class="film-detail">-->
<!--        <h3 class="film-name"><a href="/natsumes-book-of-friends-season-5-71"-->
<!--                                 title="Natsume&#39;s Book of Friends Season 5" class="dynamic-name"-->
<!--                                 data-jname="Natsume Yuujinchou Go">Natsume&#39;s Book of Friends Season 5</a></h3>-->
<!--        <div class="fd-infor">-->
<!--            <div class="tick">-->
                


<!--    <div class="tick-item tick-sub"><i-->
<!--                class="fas fa-closed-captioning mr-1"></i>13</div>-->


<!--    <div class="tick-item tick-dub"><i-->
<!--                class="fas fa-microphone mr-1"></i>1</div>-->


<!--    <div class="tick-item tick-eps">11</div>-->

<!--                <span class="dot"></span>-->
<!--                <span class="fdi-item">TV</span>-->
                
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="clearfix"></div>-->
<!--</li>-->

<!--<li>-->
<!--    <div class="film-poster item-qtip" data-id="18579">-->
<!--        <a href="/undead-unluck-18579">-->
<!--            <img data-src="https://cdn.noitatnemucod.net/thumbnail/300x400/100/3cfd1eb3711774019fe7ca66ca5e45ff.jpg"-->
<!--                 class="film-poster-img lazyload" alt="Undead Unluck">-->
<!--        </a>-->
<!--    </div>-->
<!--    <div class="film-detail">-->
<!--        <h3 class="film-name"><a href="/undead-unluck-18579"-->
<!--                                 title="Undead Unluck" class="dynamic-name"-->
<!--                                 data-jname="Undead Unluck">Undead Unluck</a></h3>-->
<!--        <div class="fd-infor">-->
<!--            <div class="tick">-->
                


<!--    <div class="tick-item tick-sub"><i-->
<!--                class="fas fa-closed-captioning mr-1"></i>24</div>-->


<!--    <div class="tick-item tick-dub"><i-->
<!--                class="fas fa-microphone mr-1"></i>22</div>-->


<!--    <div class="tick-item tick-eps">24</div>-->

<!--                <span class="dot"></span>-->
<!--                <span class="fdi-item">TV</span>-->
                
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="clearfix"></div>-->
<!--</li>-->

<!--<li>-->
<!--    <div class="film-poster item-qtip" data-id="19036">-->
<!--        <a href="/fairies-albums-4-19036">-->
<!--            <img data-src="https://cdn.noitatnemucod.net/thumbnail/300x400/100/520d66e300253f1a7752e18afb6e58ea.png"-->
<!--                 class="film-poster-img lazyload" alt="Fairies Albums 4">-->
<!--        </a>-->
<!--    </div>-->
<!--    <div class="film-detail">-->
<!--        <h3 class="film-name"><a href="/fairies-albums-4-19036"-->
<!--                                 title="Fairies Albums 4" class="dynamic-name"-->
<!--                                 data-jname="Bai Yao Pu 4th Season">Fairies Albums 4</a></h3>-->
<!--        <div class="fd-infor">-->
<!--            <div class="tick">-->
                


<!--    <div class="tick-item tick-sub"><i-->
<!--                class="fas fa-closed-captioning mr-1"></i>12</div>-->



<!--    <div class="tick-item tick-eps">12</div>-->

<!--                <span class="dot"></span>-->
<!--                <span class="fdi-item">ONA</span>-->
                
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="clearfix"></div>-->
<!--</li>-->

<!--                                </ul>-->
<!--                                <div class="clearfix"></div>-->
<!--                            </div>-->
<!--                            <div class="more"><a href="/completed">View more <i-->
<!--                                            class="fas fa-angle-right ml-2"></i></a></div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="clearfix"></div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
    <div id="main-wrapper">
        <div class="container">
            <div id="main-content">
                <div id="widget-continue-watching"></div>
                <section class="block_area block_area_home">
                    <div class="block_area-header">
                        <div class="float-left bah-heading mr-4">
                            <h2 class="cat-heading">Latest Episode</h2>
                        </div>
                        <div class="float-right viewmore"><a class="btn" href="/list/recently-updated">View more<i
                                        class="fas fa-angle-right ml-2"></i></a></div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="tab-content">
                        <div class="block_area-content block_area-list film_list film_list-grid">
                            <div class="film_list-wrap">
                        
                        
                        
                        <?php
                        
                        foreach($animes as $a) {
                            echo post($a);
                        }
                        ?>


                        <a href="/recently-updated" class="btn btn-sm w-100" style="background-color: #ffbade;margin-top: 20px;">View More</a>

                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </section>
                
                
                
                <div class="clearfix"></div>
                <section class="block_area block_area_home">
                    <div class="block_area-header block_area-header-tabs">
                        <div class="float-left bah-heading mr-4">
                            <h2 class="cat-heading">New Movies</h2>
                        </div>
                        <div class="float-right viewmore"><a class="btn" href="/movie">View more<i
                                        class="fas fa-angle-right ml-2"></i></a></div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="tab-content">
                        <div class="block_area-content block_area-list film_list film_list-grid">
                            <div class="film_list-wrap">
                                
                                <?php
                        
                        foreach($movies as $a) {
                            echo post($a);
                            }
                        ?>

                        <a href="/movie" class="btn btn-sm w-100" style="background-color: #ffbade;margin-top: 20px;">View More</a>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </section>

                <div class="clearfix"></div>
                <section class="block_area block_area_home">
                    <div class="block_area-header block_area-header-tabs">
                        <div class="float-left bah-heading mr-4">
                            <h2 class="cat-heading">New On <?php echo $data['name'] ?></h2>
                        </div>
                        <div class="float-right viewmore"><a class="btn" href="/list/recently-added">View more<i
                                        class="fas fa-angle-right ml-2"></i></a></div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="tab-content">
                        <div class="block_area-content block_area-list film_list film_list-grid">
                            <div class="film_list-wrap">
                                
                                <?php
                        
                        foreach($new_animes as $a) {
                            echo post($a);
                            }
                        ?>

                        <a href="/list/recently-added" class="btn btn-sm w-100" style="background-color: #ffbade;margin-top: 20px;">View More</a>

                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </section>

            </div>
            <div id="main-sidebar">
                <?php require('inc/genre.php') ?>
                <?php require('inc/top-10.php') ?>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <?php require('inc/footer.php') ?>
<div class="modal fade premodal" id="actionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"></div>
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
                                <input type="email" class="form-control" id="email" placeholder="name@email.com" name="email" required>
                            </div>
                            <div class="form-group">
                                <label class="prelabel" for="password">Password</label>
                                <input type="password" class="form-control" id="password" placeholder="Password" name="password" required>
                            </div>
                            <div class="form-check custom-control custom-checkbox">
                                <div class="float-left">
                                    <input type="checkbox" class="custom-control-input" name="remember" value="1" id="remember" checked>
                                    <label class="custom-control-label" for="remember">Remember me</label>
                                </div>
                                <div class="float-right">
                                    <a href="javascript:;" class="link-highlight text-forgot forgot-tab-link">Forgot password?</a>
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
                        Don't have an account? <a class="link-highlight register-tab-link" title="Register">Register</a> or <a class="link-highlight verify-tab-link" title="Account Verification">Verify</a>
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
                            An email has been sent to your email address containing an activation link. Please check your email and click on the link to activate your account (It may get in the email spam box).
                        </div>
                        <form class="preform" method="post" id="register-form">
                            <div class="form-group">
                                <label class="prelabel" for="re-username">Your name</label>
                                <input type="text" class="form-control" id="re-username" placeholder="Name" name="name" required>
                            </div>
                            <div class="form-group">
                                <label class="prelabel" for="re-email">Email address</label>
                                <input type="email" class="form-control" id="re-email" placeholder="name@email.com" name="email" required>
                            </div>
                            <div class="form-group">
                                <label class="prelabel" for="re-password">Password</label>
                                <input type="password" class="form-control" id="re-password" placeholder="Password" name="password" required>
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
                                <input required type="text" class="form-control" id="forgot-email" name="email" placeholder="name@email.com">
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
                        <a class="link-highlight login-tab-link" title=""><i class="fas fa-angle-left mr-2"></i>Back to Sign-in</a>
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
                                <input required type="text" class="form-control" id="verify-email" name="email" placeholder="name@email.com">
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
                        <a class="link-highlight login-tab-link" title=""><i class="fas fa-angle-left mr-2"></i>Back to Sign-in</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <script>var recaptchaSiteKey = '6Lc7dH8pAAAAAIGw-BOEYDAZvcs3afxf6XHaLsQL',
            recaptchaV2SiteKey = '6LdCdH8pAAAAAMV9Qy_K16Fvm4pWGYWrAEpjRjgD';</script>
    <script src="https://www.google.com/recaptcha/api.js?render=6Lc7dH8pAAAAAIGw-BOEYDAZvcs3afxf6XHaLsQL&hl=en"></script>

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