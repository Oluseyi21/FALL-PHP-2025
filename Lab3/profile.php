<?php
//define page details
global $db;
$pageTitle = "View Profile";
$pageDesc = "This page displays the full details of an individual user";
require_once './includes/Database.php';
$profile = null;
if(isset($_GET['id']) && is_numeric($_GET['id'])) {
    $profile = $db->readOne($_GET['id']);
}
require './templates/header.php';
?>
<main>
    <section class="page-header">
        <h1>User Profile Details</h1>
        <div>
            <a href="index.php" class="btn-link">Back to All Profiles</a>
        </div>
    </section>
    <section class="profiles-details">
        <?php if ($profile): ?>
        <div class="profile-card-large">
            <img src="<?php echo htmlspecialchars($profile['image_path']); ?>"
                 alt="<?php echo htmlspecialchars($profile['full_name']); ?>"
                 class="profile-img-large">
            <h2><?php echo htmlspecialchars($profile['full_name']); ?></h2>
            <p><strong>Email:</strong><?php echo htmlspecialchars($profile['email']); ?></p>
            <p><strong>Bio:</strong><?php echo htmlspecialchars($profile['bio']); ?></p>
            <p><strong>Created on:</strong><?php echo htmlspecialchars($profile['created_at']); ?></p>
        </div>
        <?php else: ?>
        <div class="message-error">
            Profile not found.
        </div>
        <?php endif; ?>
    </section>
</main>

<?php require './templates/footer.php'; ?>
