<!doctype html>
<html lang="en">
<head>
    <!-- page metadata -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- description and title -->
    <meta name="description" content="<?php echo isset($pageDescription) ? htmlspecialchars($pageDescription): 'User Profiles Application'; ?>">
    <title><?php echo isset($pageTitle) ? htmlspecialchars($pageTitle) : 'User Profiles'; ?></title>
    <meta name="robots" content="noindex, nofollow">
    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&family=Roboto:ital,wght@0,400;0,500;0,700;1,400&display=swap" rel="stylesheet">
    <!-- css -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<header>
    <nav class="main-nav">
        <div class="container">
            <h1 class="site-title">User Profiles</h1>
            <ul class="nav-links">
                <li><a href="index.php">View Profiles</a></li>
                <li><a href="create.php">Create Profile</a></li>
            </ul>
        </div>
    </nav>
</header>
<main>