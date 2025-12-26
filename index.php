<?php

$request = $_SERVER['REQUEST_URI'];
$viewDir = "/views/";
$path = explode('?', $request)[0];
require_once __DIR__ . "/src/Router.php";

$router = new Router();

$router->get("/","landing.php");
$router->get("/home", "home.php");
$router->get("/genre/{g}", "genre.php");
$router->get("/az-list/{a}", "az-list.php");
$router->get("/{anime}-{id}", "anime.php");
$router->get("/watch/{anime}-{id}", "watch.php");
$router->get("/list/{order}", "sort.php");
$router->get("/search", "search.php");

$router->resolve();