<?php

class Utils
{
    public static function capitalize(string $string): string
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

    public static function img(array $a, string $type, string $res): string
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

        if ($type === 'poster') {
            if (($a['poster_source'] ?? null) == 1) {
                $img = "https://image.tmdb.org/t/p/" . $array['1']["poster_" . $res] . ($a['poster_img'] ?? '');
            } elseif (($a['poster_source'] ?? null) == 3) {
                $img = "https://deadtoonsindia.cc/content/" . ($a['poster_img'] ?? '');
            } elseif (($a['poster_source'] ?? null) == 2) {
                $img = $a['poster_img'] ?? '';
            } else {
                $img = '';
            }
        } else {
            if (($a['backdrop_source'] ?? null) == 1) {
                $img = "https://image.tmdb.org/t/p/" . $array['1']["backdrop_" . $res] . ($a['backdrop_img'] ?? '');
            } elseif (($a['backdrop_source'] ?? null) == 3) {
                $img = "https://deadtoonsindia.cc/content/" . ($a['backdrop_img'] ?? '');
            } else {
                $img = '';
            }
        }

        return $img;
    }

    public static function generatePagination(int $currentPage, int $totalPages, string $baseUrl = ""): string
    {
        $paginationHtml = '<div class="pre-pagination mt-5 mb-5">';
        $paginationHtml .= '<nav aria-label="Page navigation">';
        $paginationHtml .= '<ul class="pagination pagination-lg justify-content-center">';

        if ($currentPage > 1) {
            $paginationHtml .= '<li class="page-item"><a title="Previous" class="page-link" href="' . $baseUrl . '?page=' . ($currentPage - 1) . '">&lsaquo;</a></li>';
        }

        for ($i = 1; $i <= $totalPages; $i++) {
            $activeClass = ($i == $currentPage) ? 'active' : '';
            $paginationHtml .= '<li class="page-item ' . $activeClass . '"><a class="page-link" href="' . $baseUrl . '?page=' . $i . '">' . $i . '</a></li>';
        }

        if ($currentPage < $totalPages) {
            $paginationHtml .= '<li class="page-item"><a title="Next" class="page-link" href="' . $baseUrl . '?page=' . ($currentPage + 1) . '">&rsaquo;</a></li>';
            $paginationHtml .= '<li class="page-item"><a title="Last" class="page-link" href="?page=' . $totalPages . '">&raquo;</a></li>';
        }

        $paginationHtml .= '</ul>';
        $paginationHtml .= '</nav>';
        $paginationHtml .= '</div>';
        return $paginationHtml;
    }
}
