<?php

class ArticleEndpoints {

    public function getArticles() {
        $db = new SQLite3('database/web.db');
        $results = $db->query("SELECT * FROM articles");

        $articles = [];
        while ($row = $results->fetchArray()) {
            $articles[] = $row;
        }
        return $articles;
    }

    public function getArticlePoints() {
        $db = new SQLite3('database/web.db');
        $results = $db->query("SELECT points FROM articles WHERE points IS NOT NULL");

        $pointList = [];
        while ($row = $results->fetchArray()) {
            $pointList[] = $row["points"];
        }
        
        return $pointList;
    }

    public function getArticleURLS() {
        $db = new SQLite3('database/web.db');
        $results = $db->query("SELECT url FROM articles");

        $urlList = [];
        while ($row = $results->fetchArray()) {
            $urlList[] = $row["url"];
        }

        
        
        return $urlList;
    }


}