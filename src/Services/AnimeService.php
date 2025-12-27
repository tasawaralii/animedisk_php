<?php
require_once __DIR__ . '/../Support/HttpClient.php';

class AnimeService
{
    public static function singleAnimeInfo(string $id)
    {
        $res = HttpClient::getJson(API_DOMAIN . "/api/anime/anime.php?dummyid=$id&key=deadtoonszylith");
        if (!$res) {
            return false;
        }

        $anime_id = $res['anime_id'] ?? null;

        if (($res['type'] ?? null) === 'tv' && $anime_id) {
            $s = HttpClient::getJson(API_DOMAIN . "/api/anime/my-seasons.php?animeid=$anime_id&key=deadtoonszylith");
            if ($s) {
                $res = array_merge($res, ['seasons' => $s]);
            }
        }

        $genres = $anime_id ? HttpClient::getJson(API_DOMAIN . "/api/anime/genre.php?anime=$anime_id&key=deadtoonszylith") : [];
        $res = array_merge($res, ['genres' => $genres ?: []]);
        return $res;
    }

    public static function keywords(): array
    {
        $res = HttpClient::getJson(API_DOMAIN . "/api/anime/keywords.php?key=deadtoonszylith");
        return $res ?: [];
    }
}
