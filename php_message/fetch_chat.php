<?php
require_once "../config/db.php";
require_once "../config/auth.php";
require_once "../class/class.Message.php";
require_once "../func/func_user.php";

$uid = $_SESSION['uid'];
$target_uid = isset($_GET['target']) ? (int) $_GET['target'] : 0;
$msgObj = new Message($conn, $uid);

// SECURITY GUARD
if ($target_uid <= 0 || !$msgObj->isUserConnected($target_uid)) {
    exit; // Stop execution if no valid connection exists
}
$msgObj = new Message($conn, $uid);
$chats = $msgObj->getMessagesWith($target_uid);

while ($m = $chats->fetch_assoc()) {
    $isMe = ($m['sender_uid'] == $uid);
    // Determine alignment and styles
    $flexClass = $isMe ? 'self-end flex-row-reverse' : '';
    $bgClass = $isMe ? 'bg-primary-container text-on-primary-container' : 'bg-surface-container-high text-on-surface';

    echo '
        <div class="flex items-end gap-3 max-w-[80%] ' . $flexClass . '">
            <div class="flex flex-col gap-1">
                <div class="' . $bgClass . ' p-4 rounded-2xl shadow-sm">
                    <p class="text-sm leading-relaxed">' . htmlspecialchars($m['content']) . '</p>
                </div>
                <span class="text-[10px] text-on-surface-variant opacity-70">' . date('h:i A', strtotime($m['sent_at'])) . '</span>
            </div>
        </div>';
}