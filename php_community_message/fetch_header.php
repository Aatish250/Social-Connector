<?php
require_once dirname(__DIR__) . "/config/db.php";
require_once dirname(__DIR__) . "/class/class.Community.php";

$cid = (int) $_GET['target'];
$sql = "SELECT cid, name, cover_image FROM communities WHERE cid = $cid";
$result = $conn->query($sql);
$comm = $result->fetch_assoc();

$name = $comm['name'] ?? 'Select Community';
$cid = $comm['cid'] ?? '';
$img = !empty($comm['cover_image']) ? $comm['cover_image'] : 'default_community.jpg';
$initials = strtoupper(substr($name, 0, 2));
?>

<div class="flex items-center gap-4">
    <!-- Avatar Logic -->
    <div
        class="w-10 h-10 rounded-lg bg-primary-container flex items-center justify-center font-bold text-on-primary-container overflow-hidden">
        <?php if (!empty($comm['cover_image']) && file_exists("../" . $comm['cover_image'])): ?>
            <!-- Show Image if it exists -->
            <img src="<?= htmlspecialchars($comm['cover_image']) ?>" alt="<?= htmlspecialchars($name) ?>"
                class="w-full h-full object-cover">
        <?php else: ?>
            <!-- Fallback to Initials -->
            <?= $initials ?>
        <?php endif; ?>
    </div>

    <!-- Community Name -->
    <div>
        <a href="view-community.php?cid=<?= $cid ?>" class="group">
            <h2
                class="font-manrope font-bold text-lg text-on-surface leading-tight group-hover:text-primary transition-text duration-200">
                <?= htmlspecialchars($name) ?>
            </h2>
        </a>
    </div>
</div>