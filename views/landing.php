<?php
require __DIR__ . '/_bootstrap.php';

$page = array(
    'title' => $data['name'] . " - Watch Animes in Hindi Online",
    'description' => $data['name'] . " is a Free Hindi anime streaming website which you can watch Hindi Dubbed Anime online with No Account and Daily update. WATCH NOW!",
    'keywords' => "anime to watch, watch anime in Hindi,Hindi anime online, free anime online, anime in hindi dubbed download, anime in hindi watch, stream anime online, hindi anime, hindi dubbed anime",
);

$isHomePage = true;
$keywords = keywords();

?>
<!DOCTYPE html>
<html lang="en">
<?php require('inc/head.php'); ?>

<body>
    <div id="xwrapper">
        <!--Begin: Header-->
        <div id="xheader">
            <div class="container">
                <div id="xheader_browser">
                    <div class="header-btn"><i class="fas fa-bars mr-2"></i>Menu</div>
                </div>
                <div id="xheader_menu">
                    <ul class="nav header_menu-list">
                        <li class="nav-item"><a href="/home" title="Home">Home</a></li>
                        <li class="nav-item"><a href="/list/movie" title="Movies">Movies</a></li>
                        <li class="nav-item"><a href="/list/tv" title="TV Series">TV Series</a></li>
                        <li class="nav-item"><a href="/list/most-popular" title="Most Popular">Most Popular</a></li>
                        <li class="nav-item"><a href="/list/top-airing" title="Top Airing">Top Airing</a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <!--End: Header-->
        <!--Begin: Main-->
        <div id="xmain-wrapper">
            <div id="mw-top">
                <div class="container">
                    <div class="mwt-content">
                        <div class="mwt-icon"><img src="/public/anw-min.webp"></div>
                        <div class="mwh-logo">
                            <a href="/home" class="mwh-logo-div">
                                <img src="/public/logo.png?v=0.3" title="<?php echo $data['name'] ?>">
                            </a>
                            <div class="clearfix"></div>
                        </div>
                        <div id="xsearch" class="home-search">
                            <div class="search-content">
                                <form action="/search" autocomplete="off" id="search-form">
                                    <div class="search-submit">
                                        <div class="search-icon btn-search"><i class="fa fa-search"></i></div>
                                    </div>
                                    <input type="text" class="form-control search-input" name="keyword"
                                        placeholder="Search anime..." required>
                                </form>
                            </div>
                            <div class="xhashtag">
                                <span class="title">Top search:</span>

                                <?php
                                foreach ($keywords as $k) {
                                    echo "<a href='/search?keyword={$k['anime_name']}'
                                   class='item'>{$k['anime_name']}</a>";
                                }
                                ?>

                            </div>
                            <div class="clearfix"></div>
                            <div id="action-button">
                                <a href="/home" class="btn btn-lg btn-radius btn-primary">Watch anime <i
                                        class="fas fa-arrow-circle-right ml-4"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mw-body">
                <div class="container">

                    <div class="mwb-2col">
                        <div class="mwb-left">
                            <h1 class="mw-heading"><?php echo $data['domain'] ?> - The best site to watch anime online
                                for Free</h1>
                            <p>Do you know that according to Google, the monthly search volume for anime related topics
                                is
                                up to over 1 Billion times? Anime is famous worldwide and it is no wonder we've seen a
                                sharp
                                rise in the number of free anime streaming sites.</p>
                            <p>Just like free online movie streaming sites, anime watching sites are not created
                                equally,
                                some are better than the rest, so we've decided to build <?php echo $data['domain'] ?>
                                to be one of the best free
                                anime in Hindi streaming site for all anime fans on the world.</p>
                            <h2>1/ What is <?php echo $data['domain'] ?>?</h2>
                            <p><?php echo $data['domain'] ?> is a free site to watch anime in Hindi and you can even
                                download Hindi subbed or dubbed anime in
                                ultra HD quality without any registration or payment. By having only one ad (Link
                                Shortner) per 24 hours in all kinds, we are
                                trying to make it the safest site for free anime.</p>
                            <h2>2/ Is <?php echo $data['domain'] ?> safe?</h2>
                            <p>Yes we are, we do have only one Ads to cover the server cost and we keep scanning the ads
                                24/7 to make sure all are clean, If you find any ads that is suspicious, please forward
                                us
                                the info and we will remove it.</p>
                            <h2>3/ So what make <?php echo $data['domain'] ?> the best site to watch anime in Hindi free
                                online?</h2>
                            <p>Before building <?php echo $data['domain'] ?>, we've checked many other free anime sites,
                                and learnt from them. We
                                only keep the good things and remove all the bad things from all the competitors, to put
                                it
                                in our <?php echo $data['name'] ?> website. Let's see how we're so confident about being
                                the best site for anime
                                streaming:</p>
                            <ul>
                                <li><strong>Safety:</strong> We try our best to not having harmful ads on
                                    <?php echo $data['name'] ?>.
                                </li>
                                <li><strong>Content library:</strong> Our main focus is anime. You can find here
                                    popular,
                                    classic, as well as current titles from all genres such as action, drama, kids,
                                    fantasy,
                                    horror, mystery, police, romance, school, comedy, music, game and many more. All
                                    these
                                    titles come with English subtitles or are dubbed in Hindi and other regional
                                    languages (Tamil-Telugu-Malayalam-Bengali-Marathi).
                                </li>
                                <li><strong>Quality/Resolution:</strong> All titles are in excellent resolution, the
                                    best
                                    quality possible. <?php echo $data['domain'] ?> also has a quality setting function
                                    to make sure our users can
                                    enjoy streaming no matter how fast your Internet speed is. You can stream the anime
                                    at
                                    360p if your Internet is being ridiculous, Or if it is good, you can go with 720p or
                                    even 1080p anime.
                                </li>
                                <li><strong>Streaming experience:</strong> Compared to other anime streaming sites, the
                                    loading speed at <?php echo $data['domain'] ?> is faster. Downloading is just as
                                    easy as streaming, you won't
                                    have any problem saving the videos to watch offline later.
                                </li>
                                <li><strong>Updates:</strong> We updates new titles as well as fulfill the requests on a
                                    daily basis so be warned, you will never run out of what to watch on
                                    <?php echo $data['name'] ?>.
                                </li>
                                <li><strong>User interface:</strong> Our UI and UX makes it easy for anyone, no matter
                                    how
                                    old you are, how long have you been on the Internet. Literally, you can figure out
                                    how
                                    to navigate our site after a quick look. If you want to watch a specific title,
                                    search
                                    for it via the search box. If you want to look for suggestions, you can use the
                                    site's
                                    categories or simply scroll down for new releases.
                                </li>
                                <li><strong>Device compatibility:</strong> <?php echo $data['name'] ?>works alright on
                                    both your mobile and
                                    desktop. However, we'd recommend you use your desktop for a smoother streaming
                                    experience.
                                </li>
                                <li><strong>Customer care:</strong> We are in active mode 24/7. You can always contact
                                    us
                                    for any help, query, or business-related inquiry. On our previous projects, we were
                                    known for our great customer service as we were quick to fix broken links or upload
                                    requested content.
                                </li>
                            </ul>
                            <p>So if you're looking for a trustworthy and safe site for your Anime streaming, let's give
                                <?php echo $data['domain'] ?> a try. And if you like us, please help us to spread the
                                words and do not forget to
                                bookmark our site.
                            </p>
                            <p>Thank you!</p>
                            <p>&nbsp;</p>
                        </div>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
        <!--End: Main-->
        <!--Begin: Footer-->
        <div id="xfooter-about">
            <div class="container">
                <p class="copyright">© <?php echo $data['domain'] ?>. All rights reserved.</p>
            </div>
        </div>
        <!--End: Footer-->
    </div>

    <script>

        $(document).ready(function () {
            $("#xheader_browser").click(function (e) {
                $("#xheader_menu, #xheader_browser").toggleClass("active");
            });
            $('.btn-search').click(function () {
                if ($('.search-input').val().trim() !== "") {
                    $('#search-form').submit();
                }
            });
        });
    </script>
</body>

</html>