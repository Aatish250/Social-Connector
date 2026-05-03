<?php
require_once dirname(__DIR__) . "/config/db.php";
require_once dirname(__DIR__) . "/config/auth.php";
require_once dirname(__DIR__) . "/class/class.Message.php"; // <--- CHECK THIS PATH

$uid = $_SESSION['uid'];
$target_uid = isset($_GET['target']) ? (int) $_GET['target'] : 0;

// Now this will no longer throw an 'Uncaught Error'
$msgObj = new Message($conn, $uid);

if ($target_uid <= 0 || !$msgObj->isUserConnected($target_uid)) {
    exit;
}
$result = $conn->query("SELECT uid, fullname, profile_pic FROM users WHERE uid = $target_uid");
$targetUser = $result->fetch_assoc();

$dbPath = $targetUser['profile_pic'];
$profilePic = !empty($dbPath) ? htmlspecialchars($dbPath) : 'profile_default.jpg';
?>
<img src="<?= $profilePic ?>" alt="Profile Picture"
    class="w-12 h-12 rounded-full object-cover mr-2 border-2 border-outline-variant"
    onerror="this.src='profile_default.jpg'">
<a href="view-profile.php?user=<?= $targetUser['uid'] ?>" class="group">
    <h2 class="text-lg font-bold group-hover:text-primary transition-colors">
        <?= htmlspecialchars($targetUser['fullname']) ?>
    </h2>
</a>