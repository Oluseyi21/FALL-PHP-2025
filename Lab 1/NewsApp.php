<?php
/**
 * News app class
 * This controls the main logic of our app
 */
require_once "NewsApi.php";
class NewsApp {
    private $api;
    public function__construct() {
        $this->api = new NewsApi();
}
/**
 * display a list of news articles with pagination
 */
public function showNews($country = "us", $category = "general", $page = 1){
    $articles = fetchNews($country, $category, $page);
    if(empty($articles)) {
        echo "<p>No news articles found.</p>";
        return;
    }
    ?>
    <section class="row">
    <h2>Latest News</h2>
</section>
<section class="row">
<?php
foreach ($articles as $article) {
    $title = htmlspecialchars($article['title'] ?? "No Title");
    $description = htmlspecialchars($article['description'] ?? "No description");
    $url = htmlspecialchars($articles['url'] ?? "#");
    $imageURL = htmlspecialchars($articles['imageURL'] ?? "");
    ?>
    <div class="col-sm-12 col-md-6 col-lg-4 news-card">
    <?php
    echo "<img class=news-img src={$imageURL}>";
    echo "<h3>{$title}</h3>";
    echo "<P>{$description}</P>";
    ?>
    </div>
    <?php
}
 ?>
</section>
<?php
    //Pagination
    $prevPage = max(1, $page - 1);
    $nextPage = $page + 1;
    echo "<div class='pagination'>";
    if ($page > 1) {
        echo "<a href='?page={$prevPage}'>&laquo; Previous</a>";
    }
    echo "<a href='?page={$nextPage}'>Next &raquo;</a>";
    echo "</div>";
}
}