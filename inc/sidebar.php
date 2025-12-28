<?php

$allgenres = $api->getAllGenres();

?>

<div id="sidebar_menu_bg"></div>
<div id="sidebar_menu">
    <button class="btn btn-radius btn-sm btn-secondary toggle-sidebar"><i class="fas fa-angle-left mr-2"></i>Close
        menu</button>
    <ul class="nav sidebar_menu-list">
        <li class="nav-item active"><a class="nav-link" href="/home" title="Home">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="/list/completed" title="Completed Animes">Completed</a></li>
        <li class="nav-item"><a class="nav-link" href="/list/most-popular" title="Most Popular">Most Popular</a></li>
        <li class="nav-item"><a class="nav-link" href="/list/movie" title="Movies">Movies</a></li>
        <li class="nav-item"><a class="nav-link" href="/list/tv" title="TV Series">TV Series</a></li>
        <li class="nav-item">
            <div class="nav-link" title="Genre"><strong>Genre</strong></div>
            <div class="sidebar_menu-sub show" id="sidebar_subs_genre">
                <ul class="nav color-list sub-menu">

                    <?php
                    foreach ($allgenres as $g) {
                        echo '<li class="nav-item"><a class="nav-link" href="/genre/' . $g['slug'] . '"> ' . $g['name'] . '</a></li>';
                    }
                    ?>

                    <li class="nav-item nav-more">
                        <a class="nav-link"><i class="fas fa-plus mr-2"></i>More</a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
        </li>
    </ul>
    <div class="clearfix"></div>
</div>