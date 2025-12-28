<?php

require_once __DIR__ . '/Support/Cache.php';

class Api
{
    private function getPopular($interval)
    {
        $time = "";

        if ($interval == 1) {
            $time = "today";
        } else if ($interval == 7) {
            $time = "week";
        } else if ($interval == 30) {
            $time = "month";
        }

        // Guard against invalid interval
        if ($time === '') {
            return [];
        }

        return Cache::remember($time, function () use ($time) {
            $url = API_DOMAIN . "/api/anime/listanime.php?sort=$time&limit=10&key=deadtoonszylith";
            $data = @file_get_contents($url);
            if ($data !== false) {
                return json_decode($data, true);
            }
            return [];
        }, 3600); // Cache for 1 hour
    }

    public function popularToday(): array
    {
        return $this->getPopular(1);
    }
    public function popularWeek(): array
    {
        return $this->getPopular(7);
    }
    public function popularMonth(): array
    {
        return $this->getPopular(30);
    }

    public function getAllGenres(): array
    {
        return Cache::remember('genres', function () {
            $url = API_DOMAIN . "/api/anime/genre.php?key=deadtoonszylith";
            $data = @file_get_contents($url);
            if ($data !== false) {
                return json_decode($data, true);
            }
            return [];
        }, 86400); // Cache for 24 hours
    }

    public function getLatestEpisodes(): array
    {
        return Cache::remember('latest_episodes', function () {
            $url = API_DOMAIN . "/api/anime/listanime.php?sort=new&type=tv&key=deadtoonszylith";
            $data = @file_get_contents($url);
            if ($data !== false) {
                return json_decode($data, true);
            }
            return [];
        }, 1800); // Cache for 30 minutes
    }

    public function getRecentlyAdded(): array
    {
        return Cache::remember('recently_added', function () {
            $url = API_DOMAIN . "/api/anime/listanime.php?key=deadtoonszylith";
            $data = @file_get_contents($url);
            if ($data !== false) {
                return json_decode($data, true);
            }
            return [];
        }, 1800); // Cache for 30 minutes
    }

    public function getNewMovies(): array
    {
        return Cache::remember('new_movies', function () {
            $url = API_DOMAIN . "/api/anime/listanime.php?type=movie&sort=new&key=deadtoonszylith";
            $data = @file_get_contents($url);
            if ($data !== false) {
                return json_decode($data, true);
            }
            return [];
        }, 3600); // Cache for 1 hour
    }

    public function getAnimeByDummyId($dummyId): array
    {
        return Cache::remember("anime_dummy_{$dummyId}", function () use ($dummyId) {
            $url = API_DOMAIN . "/api/anime/anime.php?dummyid={$dummyId}&key=deadtoonszylith";
            $data = @file_get_contents($url);
            if ($data !== false) {
                return json_decode($data, true);
            }
            return [];
        }, 7200); // Cache for 2 hours
    }

    public function getAnimeBySeasonId($seasonId): array
    {
        return Cache::remember("anime_season_{$seasonId}", function () use ($seasonId) {
            $url = API_DOMAIN . "/api/anime/anime.php?seasonid={$seasonId}&key=deadtoonszylith";
            $data = @file_get_contents($url);
            if ($data !== false) {
                return json_decode($data, true);
            }
            return [];
        }, 7200); // Cache for 2 hours
    }

    public function getEpisodes($seasonId): array
    {
        return Cache::remember("episodes_{$seasonId}", function () use ($seasonId) {
            $url = API_DOMAIN . "/api/anime/episodes.php?seasonid={$seasonId}&onlyhindi=0&available=true&key=deadtoonszylith";
            $data = @file_get_contents($url);
            if ($data !== false) {
                return json_decode($data, true);
            }
            return [];
        }, 60); // Cache for 1 hour
    }

    public function getSeasonInfo($seasonId): array
    {
        return Cache::remember("season_info_{$seasonId}", function () use ($seasonId) {
            $url = API_DOMAIN . "/api/anime/my-seasons.php?seasonid={$seasonId}&key=deadtoonszylith";
            $data = @file_get_contents($url);
            if ($data !== false) {
                return json_decode($data, true);
            }
            return [];
        }, 7200); // Cache for 2 hours
    }

    public function getMovieServers($dummyId): array
    {
        return Cache::remember("movie_servers_{$dummyId}", function () use ($dummyId) {
            $url = API_DOMAIN . "/api/anime/movie.php?dumyid={$dummyId}&order=desc&key=deadtoonszylith";
            $data = @file_get_contents($url);
            if ($data !== false) {
                return json_decode($data, true);
            }
            return [];
        }, 60); // Cache for 1 min
    }

    public function searchAnime($keyword): array
    {
        $cacheKey = 'search_' . md5($keyword);
        return Cache::remember($cacheKey, function () use ($keyword) {
            $url = API_DOMAIN . "/api/anime/search.php?keyword={$keyword}&key=deadtoonszylith";
            $data = @file_get_contents($url);
            if ($data !== false) {
                return json_decode($data, true);
            }
            return [];
        }, 1800); // Cache for 30 minutes
    }

    public function getByGenre($genre, $limit = 20, $offset = 0): array
    {
        $cacheKey = "genre_{$genre}_limit{$limit}_offset{$offset}";
        return Cache::remember($cacheKey, function () use ($genre, $limit, $offset) {
            $url = API_DOMAIN . "/api/anime/genre.php?genre={$genre}&count=true&limit={$limit}&offset={$offset}&key=deadtoonszylith";
            $data = @file_get_contents($url);
            if ($data !== false) {
                return json_decode($data, true);
            }
            return [];
        }, 3600); // Cache for 1 hour
    }

    public function getByAlpha($alpha, $limit = 20, $offset = 0): array
    {
        $cacheKey = "alpha_{$alpha}_limit{$limit}_offset{$offset}";
        return Cache::remember($cacheKey, function () use ($alpha, $limit, $offset) {
            $url = API_DOMAIN . "/api/anime/listanime.php?alpha={$alpha}&count=true&limit={$limit}&offset={$offset}&key=deadtoonszylith";
            $data = @file_get_contents($url);
            if ($data !== false) {
                return json_decode($data, true);
            }
            return [];
        }, 3600); // Cache for 1 hour
    }

    public function getList($params = []): array
    {
        $queryString = http_build_query(array_merge($params, ['key' => 'deadtoonszylith']));
        $cacheKey = 'list_' . md5($queryString);

        return Cache::remember($cacheKey, function () use ($queryString) {
            $url = API_DOMAIN . "/api/anime/listanime.php?{$queryString}";
            $data = @file_get_contents($url);
            if ($data !== false) {
                return json_decode($data, true);
            }
            return [];
        }, 1800); // Cache for 30 minutes
    }

    public function getEpisodeByUrl($episodeApiUrl): array
    {
        $cacheKey = 'episode_url_' . md5($episodeApiUrl);
        return Cache::remember($cacheKey, function () use ($episodeApiUrl) {
            $data = @file_get_contents($episodeApiUrl);
            if ($data !== false) {
                return json_decode($data, true);
            }
            return [];
        }, 3600); // Cache for 1 hour
    }

    public function getSeasonsByAnimeId($animeId): array
    {
        return Cache::remember("seasons_anime_{$animeId}", function () use ($animeId) {
            $url = API_DOMAIN . "/api/anime/my-seasons.php?animeid={$animeId}&key=deadtoonszylith";
            $data = @file_get_contents($url);
            if ($data !== false) {
                return json_decode($data, true);
            }
            return [];
        }, 7200); // Cache for 2 hours
    }

    public function getGenresByAnimeId($animeId): array
    {
        return Cache::remember("genres_anime_{$animeId}", function () use ($animeId) {
            $url = API_DOMAIN . "/api/anime/genre.php?anime={$animeId}&key=deadtoonszylith";
            $data = @file_get_contents($url);
            if ($data !== false) {
                return json_decode($data, true);
            }
            return [];
        }, 7200); // Cache for 2 hours
    }

    public function getKeywords(): array
    {
        return Cache::remember('keywords', function () {
            $url = API_DOMAIN . "/api/anime/keywords.php?key=deadtoonszylith";
            $data = @file_get_contents($url);
            if ($data !== false) {
                return json_decode($data, true);
            }
            return [];
        }, 86400); // Cache for 24 hours
    }

    public function getSingleAnimeInfo(string $id)
    {
        return Cache::remember("anime_info_{$id}", function () use ($id) {
            $url = API_DOMAIN . "/api/anime/anime.php?dummyid={$id}&key=deadtoonszylith";
            $data = @file_get_contents($url);
            if ($data === false) {
                return false;
            }

            $res = json_decode($data, true);
            if (!$res) {
                return false;
            }

            $anime_id = $res['anime_id'] ?? null;

            if (($res['type'] ?? null) === 'tv' && $anime_id) {
                $s = $this->getSeasonsByAnimeId($anime_id);
                if ($s) {
                    $res = array_merge($res, ['seasons' => $s]);
                }
            }

            $genres = $anime_id ? $this->getGenresByAnimeId($anime_id) : [];
            $res = array_merge($res, ['genres' => $genres ?: []]);
            return $res;
        }, 7200); // Cache for 2 hours
    }
}