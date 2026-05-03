<?php
require_once dirname(__DIR__) . "/config/db.php";
require_once dirname(__DIR__) . "/config/auth.php";
require_once dirname(__DIR__) . "/class/class.CommunityMessage.php";

$uid = $_SESSION['uid'];
$cid = isset($_GET['target']) ? (int) $_GET['target'] : 0;
$commMsgObj = new CommunityMessage($conn, $uid);

// SECURITY GUARD: If ID is invalid or user is not a member, EXIT IMMEDIATELY
if ($cid <= 0 || !$commMsgObj->isMember($cid)) {
    exit;
}
$commMsgObj = new CommunityMessage($conn, $uid);
$messages = $commMsgObj->getGroupMessages($cid);

while ($msg = $messages->fetch_assoc()) {
    $isMe = ($msg['sender_uid'] == $uid);
    $profilePic = !empty($msg['profile_pic']) ? $msg['profile_pic'] : 'profile_default.jpg';

    if (!$isMe): ?>
        <!-- Incoming Group Message -->
        <div class="flex items-end gap-3 max-w-[80%]">
            <img src="<?= $profilePic ?>" class="w-8 h-8 rounded-full object-cover" onerror="this.src='profile_default.jpg'">
            <div class="flex flex-col gap-1">
                <div class="bg-surface-container-high text-on-surface p-4 rounded-t-2xl rounded-br-2xl rounded-bl-sm shadow-sm">
                    <p class="text-[10px] font-bold text-primary mb-1 uppercase tracking-wider">
                        <?= htmlspecialchars($msg['fullname']) ?>
                    </p>
                    <p class="text-sm leading-relaxed">
                        <?= htmlspecialchars($msg['content']) ?>
                    </p>
                </div>
                <span class="text-[10px] text-on-surface-variant ml-1">
                    <?= date('h:i A', strtotime($msg['sent_at'])) ?>
                </span>
            </div>
        </div>
    <?php else: ?>
        <!-- Outgoing Group Message -->
        <div class="flex items-end gap-3 max-w-[80%] self-end flex-row-reverse">
            <div class="flex flex-col items-end gap-1">
                <div
                    class="bg-primary-container text-on-primary-container p-4 rounded-t-2xl rounded-bl-2xl rounded-br-sm shadow-md">
                    <p class="text-sm leading-relaxed">
                        <?= htmlspecialchars($msg['content']) ?>
                    </p>
                </div>
                <span class="text-[10px] text-on-surface-variant mr-1">
                    <?= date('h:i A', strtotime($msg['sent_at'])) ?>
                </span>
            </div>
        </div>
    <?php endif;
}
?>