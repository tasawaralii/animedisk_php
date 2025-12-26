<?php

require_once __DIR__ . '/src/Support/Utils.php';
require_once __DIR__ . '/src/Support/Render.php';
require_once __DIR__ . '/src/Support/HttpClient.php';
require_once __DIR__ . '/src/Services/AnimeService.php';

function capitalize($string)
{
    return Utils::capitalize($string);
}

function img($a, $type, $res)
{
    return Utils::img($a, $type, $res);
}

function popular($a)
{
    return Render::popular($a);
}

function top($a, $i)
{
    return Render::top($a, $i);
}

function generatePagination($currentPage, $totalPages, $baseUrl = "")
{
    return Utils::generatePagination((int)$currentPage, (int)$totalPages, (string)$baseUrl);
}

function single_anime($anime, $id, $type)
{
    if ($type == "info") {
        return AnimeService::singleAnimeInfo($id);
    }
    return false;
}

function post($a, $big = false, $page = "home")
{
    return Render::post($a, $big, $page);
}

function fetchRemoteData($url)
{
    return HttpClient::getJson($url);
}

function keywords()
{
    return AnimeService::keywords();
}