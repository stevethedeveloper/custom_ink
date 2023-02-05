<?php
// TODO: autoload
require_once APP_PATH . "/Model/Database.php";
class UrlModel extends Database
{
    public function getAllUrls()
    {
        $stmt = $this->connection->prepare('SELECT id, original_url, short_code, click_count, created FROM urls ORDER BY id');
        $stmt->execute();
        $urls = $stmt->fetchAll();
        
        return $urls;
    }
}