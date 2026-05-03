<?php
require_once dirname(__DIR__) . "/config/db.php";
require_once dirname(__DIR__) . "/config/auth.php";
require_once dirname(__DIR__) . "/class/class.CommunityMessage.php";

$uid = $_SESSION['uid'];
$activeCid = isset($_GET['target']) ? (int) $_GET['target'] : 0;
$commMsgObj = new CommunityMessage($conn, $uid);
$result = $commMsgObj->getJoinedCommunitiesWithLatest();

while ($row = $result->fetch_assoc()) {
    $isActive = ($row['cid'] == $activeCid);
    $img = !empty($row['cover_image']) ? $row['cover_image'] : 'default_community.jpg';

    // Formatting the preview text
    $preview = "No messages yet";
    if ($row['last_message_text']) {
        $sender = ($row['last_sender']) ? explode(' ', $row['last_sender'])[0] . ": " : "";
        $preview = $sender . mb_strimwidth($row['last_message_text'], 0, 30, "...");
    }

    echo '
    <div onclick="switchCommunity(' . $row['cid'] . ')"
        class="p-4 ' . ($isActive ? 'bg-secondary-container' : 'hover:bg-surface-container-high') . ' rounded-2xl relative flex items-center gap-4 cursor-pointer transition-all duration-300 group">
        
        ' . ($isActive ? '<div class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-10 bg-primary rounded-r-full shadow-[0_0_8px_#ac8aff]"></div>' : '') . '

        <div class="w-12 h-12 rounded-xl bg-primary-container flex items-center justify-center overflow-hidden flex-shrink-0">
            <img class="w-full h-full object-cover" src="' . $img . '" onerror="this.src=\'default_community.jpg\'" />
        </div>

        <div class="flex-1 min-w-0 hidden md:block">
            <div class="flex justify-between items-baseline mb-0.5">
                <h3 class="font-manrope font-bold text-on-surface truncate">' . htmlspecialchars($row['name']) . '</h3>
                <span class="text-[10px] text-on-surface-variant uppercase">
                    ' . ($row['last_message_time'] ? date('h:i A', strtotime($row['last_message_time'])) : '') . '
                </span>
            </div>
            <p class="text-xs text-on-surface-variant truncate">' . htmlspecialchars($preview) . '</p>
        </div>
    </div>';
}