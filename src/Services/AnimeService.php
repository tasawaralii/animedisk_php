<?php
require_once __DIR__ . '/../Api.php';

class AnimeService
{
    public static function singleAnimeInfo(string $id)
    {
        $api = new Api();
        return $api->getSingleAnimeInfo($id);
    }

    public static function keywords(): array
    {
        $api = new Api();
        return $api->getKeywords();
    }
}
