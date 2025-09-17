<?php
/**
 * News Api class with cURL
 */
class NewsApi{
    private $apiKey;
    private $baseurl;
    public function __construct($baseUrl, $apiKey){
    $this->apiKey = $apiKey;
    $this->baseurl = $baseUrl;
}
/**
 * Make a request to News Api using cURL
 */
private function request($endpoint){
    $url = $this->baseUrl . $endpoint . "&apiKey=" . $this->apiKey;
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
    $response = curl_exec($ch);
    if(curl_errno($ch)){
        http_response_code(502);
        throw new Exception("cURL Error: " . curl_error($ch));
    }
    $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if($statusCode == 502){
        throw new Exception("Not available");
    }
    $data = json_decode($response, true);
    //NewsAPI error response
    if(isset($data['status_message'])){
        throw new Exception("NewsAPI Error: " . $data['status_message']);
    }
    return $data;
}
/**
 * fetch for trending news
 */
public function getTrendingNews($page = 1) {
    try{
        $data = $this->request("/news/trending?language=en-US&page=" . intval($page));
        return $data['results'] ?? [];
    }catch(Exception $e){
        echo "<p>API Error: " . $e-getMessage() . "</p>";
        return [];
    }
}
}
?>