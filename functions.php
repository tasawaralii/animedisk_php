<?php

function capitalize($string)
{
    if (strpos($string, '-') !== false) {
        $words = explode('-', $string);
    } else {
        $words = [$string];
    }
    foreach ($words as &$word) {
        $word = ucfirst(strtolower($word));
    }
    return implode(' ', $words);
}
function img($a, $type, $res)
{

    $array = array(
        '1' => array(
            'poster_min' => 'w92',
            'poster_low' => 'w154',
            'poster_mid' => 'w185',
            'poster_high' => 'w342',
            'backdrop_low' => 'w185',
            'backdrop_mid' => 'w300',
            'backdrop_high' => 'w780',
        )
    );

    if ($type == "poster") {
        if ($a['poster_source'] == 1) {
            $img = "https://image.tmdb.org/t/p/" . $array['1']['poster_' . $res] . $a['poster_img'];
        } elseif ($a['poster_source'] == 3) {
            $img = "https://deadtoonsindia.cc/content/" . $a['poster_img'];
        } elseif ($a['poster_source'] == 2) {
            $img = $a['poster_img'];
        }
    } else {
        if ($a['backdrop_source'] == 1) {
            $img = "https://image.tmdb.org/t/p/" . $array['1']['backdrop_' . $res] . $a['backdrop_img'];
        } elseif ($a['backdrop_source'] == 3) {
            $img = "https://deadtoonsindia.cc/content/" . $a['backdrop_img'];
        }
    }

    return $img;
}

function popular($a)
{
    $html = '<li>';
    $html .= '<div class="film-poster item-qtip" data-id="' . $a['anime_id'] . '">';
    $html .= '<img data-src="' . img($a, "poster", "min") . '" class="film-poster-img lazyload" alt="' . $a['anime_name'] . '">';
    $html .= '</div>';
    $html .= '<div class="film-detail">';
    $html .= '<h3 class="film-name">';
    $html .= '<a href="/' . $a['anime_name'] . '-' . $a['anime_id'] . '" title="' . $a['anime_name'] . '" class="dynamic-name">' . $a['anime_name'] . '</a>';
    $html .= '</h3>';
    $html .= '<div class="fd-infor mt-2">';
    $html .= '<div class="tick">';
    $html .= '<div class="tick-item tick-dub"><i class="fas fa-microphone mr-1"></i>' . $a['total_episodes'] . '</div>';
    $html .= '<div class="dot"></div>';
    $html .= $a['type'];
    $html .= '</div>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '<div class="clearfix"></div>';
    $html .= '</li>';

    return $html;
}


function top($a, $i)
{
    $html = '<li class="' . (($i <= 3) ? "item-top" : '') . '">';
    $html .= '<div class="film-number"><span>' . str_pad($i, 2, 0, STR_PAD_LEFT) . '</span></div>';
    $html .= '<div class="film-poster item-qtip" data-id="' . $a['anime_id'] . '">';
    $html .= '<img data-src="' . img($a, "poster", "min") . '" class="film-poster-img lazyload" alt="' . $a['anime_name'] . '">';
    $html .= '</div>';
    $html .= '<div class="film-detail">';
    $html .= '<h3 class="film-name">';
    $html .= '<a href="/' . $a['anime_name'] . '-' . $a['anime_id'] . '" title="' . $a['anime_name'] . '" class="dynamic-name">' . $a['anime_name'] . '</a>';
    $html .= '</h3>';
    $html .= '<div class="fd-infor">';
    $html .= '<div class="tick">';
    $html .= '<div class="tick-item tick-dub"><i class="' . ($a['type'] == "tv" ? "fas fa-microphone mr-1" : "fa fa-film mr-1") . '"></i>' . ($a['type'] == "tv" ? $a['total_episodes'] : "Movie") . '</div>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '<div class="clearfix"></div>';
    $html .= '</li>';

    return $html;
}



function generatePagination($currentPage, $totalPages, $baseUrl = "")
{
    $paginationHtml = '<div class="pre-pagination mt-5 mb-5">';
    $paginationHtml .= '<nav aria-label="Page navigation">';
    $paginationHtml .= '<ul class="pagination pagination-lg justify-content-center">';

    // Previous page link
    if ($currentPage > 1) {
        $paginationHtml .= '<li class="page-item"><a title="Previous" class="page-link" href="' . $baseUrl . '?page=' . ($currentPage - 1) . '">&lsaquo;</a></li>';
    }

    // Page links
    for ($i = 1; $i <= $totalPages; $i++) {
        $activeClass = ($i == $currentPage) ? 'active' : '';
        $paginationHtml .= '<li class="page-item ' . $activeClass . '"><a class="page-link" href="' . $baseUrl . '?page=' . $i . '">' . $i . '</a></li>';
    }

    // Next page link
    if ($currentPage < $totalPages) {
        $paginationHtml .= '<li class="page-item"><a title="Next" class="page-link" href="' . $baseUrl . '?page=' . ($currentPage + 1) . '">&rsaquo;</a></li>';
        $paginationHtml .= '<li class="page-item"><a title="Last" class="page-link" href="?page=' . $totalPages . '">&raquo;</a></li>';
    }


    $paginationHtml .= '</ul>';
    $paginationHtml .= '</nav>';
    $paginationHtml .= '</div>';
    return $paginationHtml;
}


function single_anime($anime, $id, $type)
{
    if ($type == "info") {

        $res = fetchRemoteData("https://dbase.deaddrive.icu/api/anime/anime.php?dummyid=$id&key=deadtoonszylith");
        // print_r($res);

        $anime_id = $res['anime_id'];

        if ($res['type'] == "tv") {

            $s = fetchRemoteData("https://dbase.deaddrive.icu/api/anime/my-seasons.php?animeid=$anime_id&key=deadtoonszylith");

            if ($s) {
                $res = array_merge($res, array('seasons' => $s));
            }
        }
        //         $count = $pdo->query("INSERT INTO AnimeViews (anime_id, view_date, daily_views)
// VALUES ({$res['anime_id']} , CURRENT_DATE, 1)
// ON DUPLICATE KEY UPDATE daily_views = daily_views + 1;
// ");
        $genres = fetchRemoteData("https://dbase.deaddrive.icu/api/anime/genre.php?anime=$anime_id&key=deadtoonszylith");
        $sources = []; //$pdo->query("SELECT * FROM anime_source JOIN sources ON anime_source.source_id = sources.source_id WHERE anime_id = $anime_id")->fetchAll(PDO::FETCH_ASSOC);
        $res = array_merge($res, ['genres' => $genres]);//, ["source" => $sources]);
        return $res;
    }
}

function post($a, $big = false, $page = "home")
{
    $html = '<div class="flw-item' . (($big != false) ? " flw-item-big" : "") . '">';
    $html .= '<div class="film-poster">';
    $html .= '<div class="tick tick-rate">' . $a['age_name'] . '</div>';
    if ($a['sub'])
        $html .= '<div class="tick tick-sub">Sub</div>';
    if ($a['type'] == 'tv') {
        $html .= '<div class="tick ltr">';
        $html .= '<div class="tick-item tick-sub"><i class="fas fa-microphone mr-1"></i>' . $a['total_episodes'] . '</div>';
        $html .= '</div>';
    }
    $img = img($a, "poster", $big != false ? 'high' : 'mid');
    $html .= '<img data-src="' . $img . '" class="film-poster-img lazyload" alt="' . $a['anime_name'] . '">';
    $html .= '<a href="/' . $a['slug'] . '-' . $a['anime_id'] . '" class="film-poster-ahref item-qtip" title="' . $a['anime_name'] . ' (' . $a['Year'] . ')" data-id="' . $a['anime_id'] . '"><i class="fas fa-play"></i></a>';
    $html .= '</div>';
    $html .= '<div class="film-detail">';
    $html .= '<h3 class="film-name"><a href="/' . $a['slug'] . '-' . $a['anime_id'] . '" title="' . $a['anime_name'] . ' (' . $a['Year'] . ')" class="dynamic-name">' . $a['anime_name'] . ' (' . $a['Year'] . ')</a></h3>';
    if ($page != "home") {
        $html .= '<div class="description">' . $a['overview'] . '</div>';
    }
    $html .= '<div class="fd-infor">';
    $html .= '<span class="fdi-item">' . strtoupper($a['type']) . '</span>';
    $html .= '<span class="dot"></span>';
    $html .= '<span class="fdi-item fdi-duration">' . $a['duration'] . 'm</span>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '<div class="clearfix"></div>';
    $html .= '</div>';

    return $html;
}



function fetchRemoteData($url)
{
    $ch = curl_init(); // Initialize a cURL session
    curl_setopt($ch, CURLOPT_URL, $url); // Set the URL
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return the response as a string
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Disable SSL verification (optional, for self-signed certificates)

    $response = curl_exec($ch); // Execute the cURL request
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE); // Get the HTTP response code

    if (curl_errno($ch)) {
        echo "cURL error: " . curl_error($ch); // Handle cURL errors
        $response = false;
    }

    curl_close($ch); // Close the cURL session

    if ($httpCode !== 200) {
        // echo "HTTP error code: $httpCode"; // Handle HTTP errors
        return false;
    }

    return json_decode($response, true); // Return the response or false if there was an error
}


function keywords()
{
    $res = "https://dbase.deaddrive.icu/api/anime/keywords.php?key=deadtoonszylith";
    $res = fetchRemoteData($res);
    return $res;
}