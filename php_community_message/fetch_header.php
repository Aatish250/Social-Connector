<?php
require_once dirname(__DIR__) . "/config/db.php";
require_once dirname(__DIR__) . "/config/auth.php"; // Ensure session uid is available
require_once dirname(__DIR__) . "/class/class.CommunityMessage.php";

$uid = $_SESSION['uid'];
$cid = isset($_GET['target']) ? (int) $_GET['target'] : 0;
$commMsgObj = new CommunityMessage($conn, $uid);

// SECURITY GUARD: If ID is invalid, community doesn't exist, or user isn't a member
// We check membership which implicitly checks existence in your members table.
if ($cid <= 0 || !$commMsgObj->isMember($cid)) {
    exit; // Exit silently. JavaScript will handle the empty response.
}

// If we reach here, the community exists and the user is a member
$sql = "SELECT cid, name, cover_image FROM communities WHERE cid = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $cid);
$stmt->execute();
$comm = $stmt->get_result()->fetch_assoc();

if (!$comm)
    exit;

$name = $comm['name'];
$initials = strtoupper(substr($name, 0, 2));
?>

<div class="flex items-center gap-4">
    <div
        class="w-10 h-10 rounded-lg bg-primary-container flex items-center justify-center font-bold text-on-primary-container overflow-hidden">
        <?php if (!empty($comm['cover_image'])): ?>
            <img src="<?= htmlspecialchars($comm['cover_image']) ?>" class="w-full h-full object-cover">
        <?php else: ?>
            <?= $initials ?>
        <?php endif; ?>
    </div>
    <div>
        <a href="view-community.php?cid=<?= $cid ?>" class="group">
            <h2
                class="font-manrope font-bold text-lg text-on-surface leading-tight group-hover:text-primary transition-text">
                <?= htmlspecialchars($name) ?>
            </h2>
        </a>
    </div>
</div>