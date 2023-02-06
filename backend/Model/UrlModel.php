<?php
// TODO: autoload
require_once APP_PATH . "/Model/Database.php";
class UrlModel extends Database
{
    /** 
    * Return all records
    */
    public function getAllUrls() {
        $stmt = $this->connection->prepare('SELECT id, original_url, short_code, click_count, created FROM urls ORDER BY id');
        $stmt->execute();
        $urls = $stmt->fetchAll();
        
        return $urls;
    }

    /** 
    * Return one record
    * 
    * @param string $shortCode 
    */
    public function getUrl($shortCode) {
        $stmt = $this->connection->prepare('SELECT id, original_url, short_code, click_count, created FROM urls WHERE short_code = :short_code');
        $stmt->execute(['short_code' => $shortCode]);
        $url = $stmt->fetchAll();

        return $url;
    }

    /** 
    * Add a new url
    * 
    * @param string $url 
    */
    public function addUrl($url) {
        // get short code
        $shortCode = $this->createShortCode();
        $stmt = $this->connection->prepare('INSERT INTO urls (original_url, short_code) VALUES (:original_url, :short_code)');
        $stmt->execute(['original_url' => $url, 'short_code' => $shortCode]);

        return ['short_code' => $shortCode];
    }

    /** 
    * Create a random short code
    */
    private function createShortCode() {
        $characters = 'abcdfghjkmnpqrstvwxyzABCDFGHJKLMNPQRSTVWXYZ0123456789';
        $shortCode = '';

        while ($this->shortCodeExists($shortCode)) {
            for ($i = 0; $i <= SHORT_CODE_LENGTH; $i++) {
                $randomNum = rand(0, strlen($characters) - 1);
                $shortCode .= $characters[$randomNum];
            }
        }

        return $shortCode;
    }

    /** 
    * Check if short code exists in table
    * 
    * @param string $shortCode 
    */
     protected function shortCodeExists($shortCode) {
        $stmt = $this->connection->prepare("SELECT 1 FROM urls WHERE short_code = :short_code LIMIT 1");
        $stmt->execute([':short_code' => $shortCode]);
        $count = $stmt->fetchColumn();
        
        return ($stmt->rowCount() > 0) ? true : false;
    }
}