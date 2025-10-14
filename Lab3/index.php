<?php
    //define our page title and description
    global $db;
    $pageTitle = "View User Profiles";
    $pageDesc = "This page allows users to view all created profiles.";
    require_once './includes/Database.php';
    //call on the read method
    $profiles = $db->read();
    //check for read records
    if($profiles === false || count($profiles) === 0){
        $readError = "<p>No profiles found!</p>";
    }
    require './templates/header.php';
?>
<main>
    <section class="page-header">
        <h1>User Profiles List</h1>
        <div>
            <a href="create.php" class="btn-link">Add New Profile</a>
        </div>
    </section>
    <section class="messages">
        <?php if (isset($readError)) : ?>
        <div class="message error">
            <?php echo $readError; ?>
        </div>
        <?php endif; ?>
    </section>
    <section class="profile-list">
        <?php if($profiles && count($profiles) > 0) : ?>
        <table class="data-table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Profile Image</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Bio</th>
                <th>Date created</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($profiles as $profile): ?>
            <tr>
                <td><?php echo htmlspecialchars($profile['id']); ?></td>
                <td>
                    <img src="<?php echo htmlspecialchars($profile['image_path']); ?>"
                         alt="<?php echo htmlspecialchars($profile['full_name']); ?>"
                         class="profile-img">
                </td>
                <td><?php echo htmlspecialchars($profile['full_name']); ?></td>
                <td><?php echo htmlspecialchars($profile['email']); ?></td>
                <td><?php echo htmlspecialchars($profile['bio']); ?></td>
                <td><?php echo htmlspecialchars($profile['created_at']); ?></td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <?php else : ?>
        <div class="message info">
            No profiles found.
        </div>
        <?php endif; ?>
    </section>
</main>

<?php require './templates/footer.php'; ?>
