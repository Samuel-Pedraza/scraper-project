<?php


header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type");

require 'ArticleEndpoints.php';

$endpoints = new ArticleEndpoints();

$request = $_GET['endpoint'] ?? '';

if($request === 'articleList'){
    $response = [];

    $response = $endpoints->getArticles();

    $json = json_encode($response);

    echo $json;
} 

if($request === 'articlePoints'){
    $response = [];

    $response = $endpoints->getArticlePoints();

    $json = json_encode($response);

    echo $json;
}

if($request === 'getArticleURLS'){
    $response = [];

    $response = $endpoints->getArticleURLS();

    $json = json_encode($response);

    echo $json;
}