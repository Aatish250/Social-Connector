<?php
// Determine path depth
$basePath = (basename(getcwd()) == 'php_message') ? '../' : '';

require_once $basePath . "config/db.php";
require_once $basePath . "config/auth.php";
require_once $basePath . "class/class.Message.php";

$uid = $_SESSION['uid'];
// Get target from GET (sent via AJAX fetch)
$active_target = isset($_GET['target']) ? (int) $_GET['target'] : 0;

$msgObj = new Message($conn, $uid);
$conversations = $msgObj->getConversationsList();

if ($conversations && $conversations->num_rows > 0) {
    while ($contact = $conversations->fetch_assoc()) {
        $isActive = ($active_target == $contact['uid']);
        $profilePic = !empty($contact['profile_pic']) ? $contact['profile_pic'] : 'profile_default.jpg';

        ?>
        <div onclick="switchChat(<?= $contact['uid'] ?>)"
            class="p-4 <?= $isActive ? 'bg-secondary-container' : 'hover:bg-surface-container-high' ?> rounded-2xl relative flex items-center gap-4 cursor-pointer transition-all duration-300 group">

            <?php if ($isActive): ?>
                <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-10 bg-primary rounded-r-full shadow-[0_0_8px_#ac8aff]">
                </div>
            <?php endif; ?>

            <div class="relative w-12 h-12 flex-shrink-0">
                <img class="w-12 h-12 rounded-full object-cover border border-outline-variant/20" src="<?= $profilePic ?>"
                    onerror="this.src='uploads/profile_default.jpg'" />
            </div>

            <div class="flex-1 min-w-0 hidden md:block">
                <div class="flex justify-between items-baseline mb-0.5">
                    <h3 class="font-headline font-semibold text-on-surface truncate">
                        <?= htmlspecialchars($contact['fullname']) ?>
                    </h3>
                    <?php if ($contact['last_message_time']): ?>
                        <span class="text-[10px] text-on-surface-variant uppercase tracking-tighter">
                            <?= date('h:i A', strtotime($contact['last_message_time'])) ?>
                        </span>
                    <?php endif; ?>
                </div>
                <p class="text-xs text-on-surface-variant truncate">
                    <?= $contact['last_message_time'] ? 'Latest message' : 'Start a new conversation' ?>
                </p>
            </div>
        </div>
        <?php
    }
} else {
    echo '<div class="p-6 text-center text-xs text-gray-500 italic">No connections found yet.</div>';
}
?>