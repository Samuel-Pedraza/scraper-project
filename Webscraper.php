<?php 

class Webscraper 
{
    
    public function downloadPage($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }

    public function parsePage($html): array
    {
        $doc = new DOMDocument();
        $doc->loadHTML($html);
        $xpath = new DOMXPath($doc);

        //we get the "second" table in HN (since there are 2 tables)
        $elements = $xpath->query("//table[@id='hnmain']//td/table//tr");
        $data = [];
        foreach ($elements as $element) {
            $data[] = $element->nodeValue;
        }
        return $data;
    }

    public function cleanHNData($data){
        //remove empties
        $data = array_filter($data, function($row) {
            return strlen($row) > 0;
        });

        //we only want the first 60 results after that
        $data = array_slice($data, 1, 60);

        //need to combine rows that are next to each other
        $combineData = [];
        for($row = 0; $row < count($data); $row+=2){
            
            $combineData[] = $data[$row] . $data[$row+1];
        }

        return $combineData;
    }
    
    

    public function addArticleToDB($article)
    {
        $title = $this->getTitleOfHNRow($article);
        $comments = $this->getCommentCountOfHNRow($article);
        $points = $this->getPointsOfHNRow($article);
        $rank = $this->getRankOfHNRow($article);
        $url =  $this->getURLFromHNRow($article);

        $db = new SQLite3('database/web.db');
        
        $addToDB = "INSERT INTO articles (name, url, points, comments, rank) VALUES (:title, :url, :points, :comments, :rank)";
        $sql = $db->prepare($addToDB);
        $sql->bindValue(':title', $title, SQLITE3_TEXT);
        $sql->bindValue(':url', $url, SQLITE3_TEXT);
        $sql->bindValue(':points', $points, SQLITE3_INTEGER);
        $sql->bindValue(':comments', $comments, SQLITE3_INTEGER);
        $sql->bindValue(':rank', $rank, SQLITE3_INTEGER);
        $sql->execute();
    }

    protected function getTitleOfHNRow($article){
        $parts = explode('(', $article);
        
        $HNTitle = trim($parts[0]);

        $title = preg_replace('/^\d+\.\s*/', '', $HNTitle);

        return mb_convert_encoding($title, 'UTF-8', 'auto');
    }

    protected function getPointsOfHNRow($article){
        preg_match('/(\d+)\s+points/', $article, $matches);

        return $matches[1] ?? null;
    }

    protected function getCommentCountOfHNRow($article){
        preg_match('/(\d+)\s+comments/', $article, $matches);



        return $matches[1] ?? null;
    }

    protected function getRankOfHNRow($article){
        preg_match('/^(\d+)\./', $article, $matches);

        return $matches[1] ?? null;
    }

    public function getURLFromHNRow($article){
        preg_match('/\((.*?)\)/', $article, $matches);

        $url = $matches[1] ?? null;

        return $url;
    }

}