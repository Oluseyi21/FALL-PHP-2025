<?php
/**
 * Entry Point of the app
 */
require_once "config.php";
require_once "NEWSApi.php";
require_once "NewsApp.php";
// create dAPI Handle
$api = new NewsApi(TMDB_BASE_URL,TMDB_API_KEY);
// create our news project
$app = new NewsApp($api);
// get the current page from the url
$currentPage = isset($_GET['page']) ? intval($_GET['page']) : 1;
?>
<!doctype html>
<html lang="en">
<head>
    <!-- metadata -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, intial-scale=1">
    <meta name="robots" content="no index, nofollow">
    <meta name="description" content="API Integration">
    <title>Latest News- Powered by NewsAPI</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <nav>
        <a href="#">Home</a>
        <a href="#">World</a>
        <a href="#">Sport</a>
        <a href="#">Technology</a>
    </nav>
</header>
<section>
    <h1>Daily News</h1>
</section>
<!-- Hero Article (First news) -->
<?php
if(!empty($articles)):
?>
<article>
    <section class="hero">
        <div class="hero-text">
            <h2><?= htmlspecialchars($articles[0]['title']) ?></h2>
            <p><?= htmlspecialchars($articles[0]['description']) ?></p>
            <a href="<?= $articles[0]['url'] ?>"  target="_blank">Read More</a>
        </div>
    </section>
</article>
<?php endif; ?>
<!-- News Grid (next few articles) -->
<section class="news-grid">
    <?php
    for($i = 1; $i < min(4, count($articles)); $i++);
    ?>
    <article class="news-card">
        <?php
        if (!empty($articles[$i]['urlToImage'])):
        ?>
        <?php endif; ?>
        <h3><?= htmlspecialchars($articles[$i]['title']) ?></h3>
        <p><?= htmlspecialchars($articles[$i]['description'] ?? 'No description available.') ?></p>
        <a href="<?=$articles[$i]['url']?>" target="_blank">Read More</a>
    </article>
</section>
<footer>
    <p>Daily News. All rights reserved</p>
</footer>
</body>
</html>
