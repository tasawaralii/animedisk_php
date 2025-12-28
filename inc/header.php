<div id="header" class="<?php echo $page['header-class'] ?>">
    <div class="container">
        <div id="mobile_menu"><i class="fa fa-bars"></i></div>
        <a href="/" id="logo">
            <img src="/public/logo.png?v=0.3" alt="<?php echo $data['name'] ?>">
            <div class="clearfix"></div>
        </a>
        <div id="search">
            <div class="search-content">
                <form action="/search" autocomplete="off">
                    <!-- <a href="/filter" class="filter-icon">Filter</a> -->
                    <input type="text" class="form-control search-input" name="keyword" placeholder="Search anime..."
                        required>
                    <button type="submit" class="search-icon"><i class="fas fa-search"></i></button>
                </form>
                <div class="nav search-result-pop" id="search-suggest" style="display: none;">
                    <div class="loading-relative" id="search-loading" style="display: none;">
                        <div class="loading">
                            <div class="span1"></div>
                            <div class="span2"></div>
                            <div class="span3"></div>
                        </div>
                    </div>
                    <div class="result" style="display:none;"></div>
                </div>
            </div>
        </div>
        <div class="header-group">
            <div class="anw-group">
                <div class="zrg-title"><span class="top">Join now</span><span class="bottom"><?php echo $data['name'] ?>
                        Group</span></div>
                <div class="zrg-list">
                    <div class="item"><a href="<?php echo $data['telegram'] ?>" target="_blank"
                            class="zr-social-button tl-btn"><i class="fab fa-telegram-plane"></i></a>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <div class="header-setting">
            <div class="hs-toggles">

                <a href="<?= DEADTOONS_DOMAIN ?>" class="hst-item" data-toggle="tooltip" data-original-title="Download Anime">
                    <div class="hst-icon"><i class="fas fa-download"></i></div>
                    <div class="name"><span>Deadtoons</span></div>
                </a>

                <div class="clearfix"></div>
            </div>
        </div>

        <div id="pick_menu">
            <div class="pick_menu-ul">
                <ul class="ulclear">
                    <li class="pmu-item pmu-item-home">
                        <a class="pmu-item-icon" href="/home" title="Home">
                            <img src="/public/pick-home.svg" data-toggle="tooltip" data-placement="right" title="Home">
                        </a>
                    </li>
                    <li class="pmu-item pmu-item-movies">
                        <a class="pmu-item-icon" href="/list/movie" title="Movies">
                            <img src="/public/pick-movies.svg" data-toggle="tooltip" data-placement="right"
                                title="Movies">
                        </a>
                    </li>
                    <li class="pmu-item pmu-item-show">
                        <a class="pmu-item-icon" href="/list/tv" title="TV Series">
                            <img src="/public/pick-show.svg" data-toggle="tooltip" data-placement="right"
                                title="TV Series">
                        </a>
                    </li>
                    <li class="pmu-item pmu-item-popular">
                        <a class="pmu-item-icon" href="/list/most-popular" title="Most Popular">
                            <img src="/public/pick-popular.svg" data-toggle="tooltip" data-placement="right"
                                title="Most Popular">
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div id="header_right"></div>
        <div id="mobile_search"><i class="fa fa-search"></i></div>
        <div class="clearfix"></div>
    </div>
</div>
<div class="clearfix"></div>