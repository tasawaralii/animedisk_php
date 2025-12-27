<?php

$allgenres = fetchRemoteData(API_DOMAIN . "/api/anime/genre.php?key=deadtoonszylith");

?>
                <section class="block_area block_area_sidebar block_area-genres">
    <div class="block_area-header">
        <div class="float-left bah-heading mr-4">
            <h2 class="cat-heading">Genres</h2>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="block_area-content">
        <div class="cbox cbox-genres">
            <ul class="ulclear color-list sb-genre-list sb-genre-less">
                <?php
                    foreach($allgenres as $g) {
                        echo '<li><a href="/genre/'.$g['slug'].'" title="'.$g['name'].'">'.$g['name'].'</a></li>';
                    }
                ?>
            </ul>
            <div class="clearfix"></div>
            <button class="btn btn-sm btn-block btn-showmore mt-2"></button>
        </div>
    </div>
</section>
<?php

/*
<li><a href="/genre/action" title="Action">Action</a></li>
                
                    <li><a href="/genre/adventure" title="Adventure">Adventure</a></li>
                
                    <li><a href="/genre/cars" title="Cars">Cars</a></li>
                
                    <li><a href="/genre/comedy" title="Comedy">Comedy</a></li>
                
                    <li><a href="/genre/dementia" title="Dementia">Dementia</a></li>
                
                    <li><a href="/genre/demons" title="Demons">Demons</a></li>
                
                    <li><a href="/genre/drama" title="Drama">Drama</a></li>
                
                    <li><a href="/genre/ecchi" title="Ecchi">Ecchi</a></li>
                
                    <li><a href="/genre/fantasy" title="Fantasy">Fantasy</a></li>
                
                    <li><a href="/genre/game" title="Game">Game</a></li>
                
                    <li><a href="/genre/harem" title="Harem">Harem</a></li>
                
                    <li><a href="/genre/historical" title="Historical">Historical</a></li>
                
                    <li><a href="/genre/horror" title="Horror">Horror</a></li>
                
                    <li><a href="/genre/isekai" title="Isekai">Isekai</a></li>
                
                    <li><a href="/genre/josei" title="Josei">Josei</a></li>
                
                    <li><a href="/genre/kids" title="Kids">Kids</a></li>
                
                    <li><a href="/genre/magic" title="Magic">Magic</a></li>
                
                    <li><a href="/genre/marial-arts" title="Martial Arts">Martial Arts</a></li>
                
                    <li><a href="/genre/mecha" title="Mecha">Mecha</a></li>
                
                    <li><a href="/genre/military" title="Military">Military</a></li>
                
                    <li><a href="/genre/music" title="Music">Music</a></li>
                
                    <li><a href="/genre/mystery" title="Mystery">Mystery</a></li>
                
                    <li><a href="/genre/parody" title="Parody">Parody</a></li>
                
                    <li><a href="/genre/police" title="Police">Police</a></li>
                
                    <li><a href="/genre/psychological" title="Psychological">Psychological</a></li>
                
                    <li><a href="/genre/romance" title="Romance">Romance</a></li>
                
                    <li><a href="/genre/samurai" title="Samurai">Samurai</a></li>
                
                    <li><a href="/genre/school" title="School">School</a></li>
                
                    <li><a href="/genre/sci-fi" title="Sci-Fi">Sci-Fi</a></li>
                
                    <li><a href="/genre/seinen" title="Seinen">Seinen</a></li>
                
                    <li><a href="/genre/shoujo" title="Shoujo">Shoujo</a></li>
                
                    <li><a href="/genre/shoujo-ai" title="Shoujo Ai">Shoujo Ai</a></li>
                
                    <li><a href="/genre/shounen" title="Shounen">Shounen</a></li>
                
                    <li><a href="/genre/shounen-ai" title="Shounen Ai">Shounen Ai</a></li>
                
                    <li><a href="/genre/slice-of-life" title="Slice of Life">Slice of Life</a></li>
                
                    <li><a href="/genre/space" title="Space">Space</a></li>
                
                    <li><a href="/genre/sports" title="Sports">Sports</a></li>
                
                    <li><a href="/genre/super-power" title="Super Power">Super Power</a></li>
                
                    <li><a href="/genre/supernatural" title="Supernatural">Supernatural</a></li>
                
                    <li><a href="/genre/thriller" title="Thriller">Thriller</a></li>
                
                    <li><a href="/genre/vampire" title="Vampire">Vampire</a></li>
                    */
?>