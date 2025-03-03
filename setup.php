<?php

include "Webscraper.php";

if(file_exists('database/web.db')) {
    echo "Setup already run!";
    return;
}

$db = new SQLite3('database/web.db');
$db->exec("CREATE TABLE IF NOT EXISTS articles (id INTEGER PRIMARY KEY, name TEXT, url TEXT, points INTEGER, comments INTEGER, rank INTEGER)");

$url = "https://news.ycombinator.com/";
$webscraper = new Webscraper();
$html = $webscraper->downloadPage($url);
$webpageData = $webscraper->parsePage($html);
$webpageData = $webscraper->cleanHNData($webpageData);

foreach($webpageData as $article) {
    $webscraper->addArticleToDB($article);
}
