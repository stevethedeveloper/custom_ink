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
        do {
            // get short code
            $shortCode = $this->createShortCode();
            // Insert
            $stmt = $this->connection->prepare('INSERT INTO urls (original_url, short_code) VALUES (:original_url, :short_code)');
            $stmt->execute(['original_url' => $url, 'short_code' => $shortCode]);
            // Continue until there is no error 23000 (integrity violation)
        } while ($stmt->errorCode() === '23000');
        
        return ['short_code' => $shortCode];
    }

    /** 
    * Create a random short code
    */
    private function createShortCode() {
        $characters = 'abcdfghjkmnpqrstvwxyzABCDFGHJKLMNPQRSTVWXYZ0123456789';
        $length = mb_strlen($characters, '8bit');
        $return = [];

        for ($i = 0; $i <= SHORT_CODE_LENGTH; $i++) {
            $randomNum = random_int(0, $length - 1);
            $return[] = $characters[$randomNum];
        }

        $return = implode('', $return);
        return $return;
    }
}