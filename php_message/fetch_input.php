<?php
$basePath = (basename(getcwd()) == 'php_message') ? '../' : '';
require_once $basePath . "config/db.php";
require_once $basePath . "config/auth.php";
require_once $basePath . "class/class.Message.php";

$uid = $_SESSION['uid'];
$target_uid = isset($_GET['target']) ? (int) $_GET['target'] : 0;
$msgObj = new Message($conn, $uid);

// SECURITY GUARD
if ($target_uid <= 0 || !$msgObj->isUserConnected($target_uid)) {
    exit; // Stop execution if no valid connection exists
}
$msgObj = new Message($conn, $uid);
$friendStatus = $msgObj->getFriendshipStatus($target_uid);

if ($friendStatus === 'accepted'): ?>
    <div class="p-6 bg-surface-variant">
        <form id="chat-form" class="max-w-4xl mx-auto flex items-center gap-3">
            <input type="hidden" id="receiver_id" value="<?= $target_uid ?>">
            <div class="flex-1 bg-surface-container-highest rounded-2xl flex items-center px-4 py-2 ring-1 ring-primary/30">
                <input id="message-input" class="flex-1 bg-transparent border-none focus:ring-0 text-on-surface py-3"
                    placeholder="Type your message..." type="text" autocomplete="off" />
            </div>
            <button type="submit" class="bg-primary text-white w-12 h-12 flex items-center justify-center rounded-xl">
                <span class="material-symbols-outlined">send</span>
            </button>
        </form>
    </div>
<?php else: ?>
    <div class="p-6 bg-surface-variant text-center">
        <div class="bg-surface-container-high p-4 rounded-xl inline-block shadow-sm">
            <p class="text-sm text-on-surface-variant mb-2">You are no longer connected with this user.</p>
            <a href="view-profile.php?user=<?= $target_uid ?>" class="text-primary font-bold hover:underline">
                Send a connection request to chat
            </a>
        </div>
    </div>
<?php endif;
?>