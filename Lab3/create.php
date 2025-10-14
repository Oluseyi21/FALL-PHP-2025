<?php
$pageTitle = "Create User Profile";
$pageDesc = "This page lets the user create a new profile";
require_once './includes/Database.php';
$success = false;
//check if the form was submitted
if($_SRVER['REQUEST_METHOD'] === 'POST'){
    //Get the submitted data
    $full_name = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $bio = trim($_POST['bio']);
    //The $_FILES superglobal holds information about the uploaded file
    $imageFile = $_FILES['profile_image'];
    //validate and create the record using the OOP method
    if($db->create($full_name, $email, $bio, $imageFile)){
        $success = "Profile created successfully";
    }
}
require './templates/header.php';
?>
<main>
    <section class="page-header">
        <h1>Create New User Profile</h1>
        <div>
            <a href="index.php" class="btn-link"> View All Profiles</a>
        </div>
    </section>
    <section class="messages">
        <?php if($success): ?>
        <div class="message success">
            <?php echo $success; ?>
        </div>
        <?php endif; ?>
        <?php if($db->error): ?>
        <div class="message error">
            Error: <?php echo $db->error; ?>
        </div>
        <?php endif; ?>
    </section>
    <section class="create-form">
        <form method="POSt" enctype="multipart/form-data" class="form-box">
            <div class="form-group">
                <label for="full_name">Full Name:</label>
                <input type="text" id="full_name" name="full_name" required
                value="<?php echo htmlspecialchars($full_name ?? ''); ?>">
            </div>
            <div class="form-group">
                <label for="email">Email Address:</label>
                <input type="email" id="email" name="email" required
                value="<?php echo htmlspecialchars($email ?? ''); ?>">
            </div>
            <div class="form-group">
                <label for="bio">Bio:</label>
                <textarea id="bio" name="bio" rows="3"><?php echo htmlspecialchars($bio ?? ''); ?></textarea>
            </div>
            <div class="form-group">
                <label for="profile_image">Profile Image:</label>
                <input type="file" id="profile_image" name="profile_image" required>
                <small>Allowed: JPG, PNG, GIF. Max 2MB.</small>
            </div>
            <button type="submit" class="btn">Save Profile</button>
        </form>
    </section>
</main>

<?php require './templates/footer.php'; ?>
