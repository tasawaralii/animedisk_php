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
        // No pagination needed if only one page
        if ($totalPages <= 1) {
            return '';
        }

        // Determine the query separator based on whether baseUrl already has query params
        $sep = (strpos($baseUrl, '?') !== false) ? '&' : '?';

        $paginationHtml = '<div class="pre-pagination mt-5 mb-5">';
        $paginationHtml .= '<nav aria-label="Page navigation">';
        $paginationHtml .= '<ul class="pagination pagination-lg justify-content-center">';

        // Previous link
        if ($currentPage > 1) {
            $paginationHtml .= '<li class="page-item"><a title="Previous" class="page-link" href="' . $baseUrl . $sep . 'page=' . ($currentPage - 1) . '">&lsaquo;</a></li>';
        }

        // Windowed page links
        $window = 3; // total number of page buttons to display (excluding first/last/prev/next)
        $half = intdiv($window, 2);
        $start = max(1, $currentPage - $half);
        $end = min($totalPages, $currentPage + $half);

        // Adjust when near the start/end to keep window size consistent
        if ($end - $start + 1 < $window) {
            if ($start === 1) {
                $end = min($totalPages, $start + $window - 1);
            } elseif ($end === $totalPages) {
                $start = max(1, $end - $window + 1);
            }
        }

        // Show first page and ellipsis if needed
        if ($start > 1) {
            $paginationHtml .= '<li class="page-item"><a class="page-link" href="' . $baseUrl . $sep . 'page=1">1</a></li>';
            if ($start > 2) {
                $paginationHtml .= '<li class="page-item disabled"><span class="page-link">&hellip;</span></li>';
            }
        }

        for ($i = $start; $i <= $end; $i++) {
            $activeClass = ($i === $currentPage) ? 'active' : '';
            $paginationHtml .= '<li class="page-item ' . $activeClass . '"><a class="page-link" href="' . $baseUrl . $sep . 'page=' . $i . '">' . $i . '</a></li>';
        }

        // Show ellipsis and last page if needed
        if ($end < $totalPages) {
            if ($end < $totalPages - 1) {
                $paginationHtml .= '<li class="page-item disabled"><span class="page-link">&hellip;</span></li>';
            }
            $paginationHtml .= '<li class="page-item"><a class="page-link" href="' . $baseUrl . $sep . 'page=' . $totalPages . '">' . $totalPages . '</a></li>';
        }

        // Next and Last links
        if ($currentPage < $totalPages) {
            $paginationHtml .= '<li class="page-item"><a title="Next" class="page-link" href="' . $baseUrl . $sep . 'page=' . ($currentPage + 1) . '">&rsaquo;</a></li>';
            $paginationHtml .= '<li class="page-item"><a title="Last" class="page-link" href="' . $baseUrl . $sep . 'page=' . $totalPages . '">&raquo;</a></li>';
        }

        $paginationHtml .= '</ul>';
        $paginationHtml .= '</nav>';
        $paginationHtml .= '</div>';
        return $paginationHtml;
    }
}
