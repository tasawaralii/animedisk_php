<?php
require_once __DIR__ . '/Utils.php';

class Render
{
    public static function popular(array $a): string
    {
        $html = '<li>';
        $html .= '<div class="film-poster item-qtip" data-id="' . ($a['anime_id'] ?? '') . '">';
        $html .= '<img data-src="' . Utils::img($a, 'poster', 'min') . '" class="film-poster-img lazyload" alt="' . ($a['anime_name'] ?? '') . '">';
        $html .= '</div>';
        $html .= '<div class="film-detail">';
        $html .= '<h3 class="film-name">';
        $html .= '<a href="/' . ($a['anime_name'] ?? '') . '-' . ($a['anime_id'] ?? '') . '" title="' . ($a['anime_name'] ?? '') . '" class="dynamic-name">' . ($a['anime_name'] ?? '') . '</a>';
        $html .= '</h3>';
        $html .= '<div class="fd-infor mt-2">';
        $html .= '<div class="tick">';
        $html .= '<div class="tick-item tick-dub"><i class="fas fa-microphone mr-1"></i>' . ($a['total_episodes'] ?? '') . '</div>';
        $html .= '<div class="dot"></div>';
        $html .= ($a['type'] ?? '');
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '<div class="clearfix"></div>';
        $html .= '</li>';
        return $html;
    }

    public static function top(array $a, int $i): string
    {
        $html = '<li class="' . (($i <= 3) ? 'item-top' : '') . '">';
        $html .= '<div class="film-number"><span>' . str_pad($i, 2, '0', STR_PAD_LEFT) . '</span></div>';
        $html .= '<div class="film-poster item-qtip" data-id="' . ($a['anime_id'] ?? '') . '">';
        $html .= '<img data-src="' . Utils::img($a, 'poster', 'min') . '" class="film-poster-img lazyload" alt="' . ($a['anime_name'] ?? '') . '">';
        $html .= '</div>';
        $html .= '<div class="film-detail">';
        $html .= '<h3 class="film-name">';
        $html .= '<a href="/' . ($a['anime_name'] ?? '') . '-' . ($a['anime_id'] ?? '') . '" title="' . ($a['anime_name'] ?? '') . '" class="dynamic-name">' . ($a['anime_name'] ?? '') . '</a>';
        $html .= '</h3>';
        $html .= '<div class="fd-infor">';
        $html .= '<div class="tick">';
        $html .= '<div class="tick-item tick-dub"><i class="' . ((($a['type'] ?? '') == 'tv') ? 'fas fa-microphone mr-1' : 'fa fa-film mr-1') . '"></i>' . ((($a['type'] ?? '') == 'tv') ? ($a['total_episodes'] ?? '') : 'Movie') . '</div>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '<div class="clearfix"></div>';
        $html .= '</li>';
        return $html;
    }

    public static function post(array $a, bool $big = false, string $page = 'home'): string
    {
        $html = '<div class="flw-item' . (($big != false) ? ' flw-item-big' : '') . '">';
        $html .= '<div class="film-poster">';
        $html .= '<div class="tick tick-rate">' . ($a['age_name'] ?? '') . '</div>';
        if (($a['sub'] ?? false)) {
            $html .= '<div class="tick tick-sub">Sub</div>';
        }
        if (($a['type'] ?? '') === 'tv') {
            $html .= '<div class="tick ltr">';
            $html .= '<div class="tick-item tick-sub"><i class="fas fa-microphone mr-1"></i>' . ($a['total_episodes'] ?? '') . '</div>';
            $html .= '</div>';
        }
        $img = Utils::img($a, 'poster', $big != false ? 'high' : 'mid');
        $html .= '<img data-src="' . $img . '" class="film-poster-img lazyload" alt="' . ($a['anime_name'] ?? '') . '">';
        $html .= '<a href="/' . ($a['slug'] ?? '') . '-' . ($a['anime_id'] ?? '') . '" class="film-poster-ahref item-qtip" title="' . ($a['anime_name'] ?? '') . ' (' . ($a['Year'] ?? '') . ')" data-id="' . ($a['anime_id'] ?? '') . '"><i class="fas fa-play"></i></a>';
        $html .= '</div>';
        $html .= '<div class="film-detail">';
        $html .= '<h3 class="film-name"><a href="/' . ($a['slug'] ?? '') . '-' . ($a['anime_id'] ?? '') . '" title="' . ($a['anime_name'] ?? '') . ' (' . ($a['Year'] ?? '') . ')" class="dynamic-name">' . ($a['anime_name'] ?? '') . ' (' . ($a['Year'] ?? '') . ')</a></h3>';
        if ($page !== 'home') {
            $html .= '<div class="description">' . ($a['overview'] ?? '') . '</div>';
        }
        $html .= '<div class="fd-infor">';
        $html .= '<span class="fdi-item">' . strtoupper($a['type'] ?? '') . '</span>';
        $html .= '<span class="dot"></span>';
        $html .= '<span class="fdi-item fdi-duration">' . ($a['duration'] ?? '') . 'm</span>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '<div class="clearfix"></div>';
        $html .= '</div>';
        return $html;
    }
}
