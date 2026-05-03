<section class="flex-1 bg-surface-variant flex flex-col h-full relative">
    <?php
    require_once "class/class.CommunityMessage.php";
    $uid = $_SESSION['uid'];
    $commMsgObj = new CommunityMessage($conn, $uid);
    $cid = isset($_GET['target']) ? (int) $_GET['target'] : 0;

    // Check if community exists
    $exists = false;
    if ($cid > 0) {
        $checkSql = "SELECT cid FROM communities WHERE cid = ?";
        $stmt = $conn->prepare($checkSql);
        $stmt->bind_param("i", $cid);
        $stmt->execute();
        $exists = $stmt->get_result()->num_rows > 0;
    }

    $canAccess = ($exists && $commMsgObj->isMember($cid));
    ?>

    <!-- Header: Hidden if no access -->
    <header id="chat-header"
        class="h-20 flex items-center px-8 bg-surface-container-low/50 backdrop-blur-md sticky top-0 z-30 <?= !$canAccess ? 'hidden' : '' ?>">
        <?php if ($canAccess)
            include "php_community_message/fetch_header.php"; ?>
    </header>

    <!-- Message History -->
    <div id="chat-box" class="flex-1 overflow-y-auto p-8 flex flex-col gap-8 no-scrollbar">
        <?php
        if ($cid === 0) {
            // No selection placeholder
            echo '<div class="flex flex-col items-center justify-center h-full opacity-40">
                    <span class="material-symbols-outlined text-6xl mb-4">forum</span>
                    <p class="font-manrope font-semibold">Select a community</p>
                  </div>';
        } elseif (!$exists) {
            // THIS PREVENTS THE BLANK SCREEN for target=99
            echo '<div class="flex flex-col items-center justify-center h-full opacity-40">
                    <span class="material-symbols-outlined text-6xl mb-4">search_off</span>
                    <p class="font-manrope font-semibold">Community not found</p>
                  </div>';
        } elseif (!$canAccess) {
            // Membership placeholder
            echo '<div class="flex flex-col items-center justify-center h-full opacity-40">
                    <span class="material-symbols-outlined text-6xl mb-4">lock</span>
                    <p class="font-manrope font-semibold">Private Community</p>
                  </div>';
        } else {
            include "php_community_message/fetch_chat.php";
        }
        ?>
    </div>

    <!-- Input Bar: Hidden if no access -->
    <div id="chat-input-area" class="<?= !$canAccess ? 'hidden' : '' ?>">
        <?php if ($canAccess)
            include "php_community_message/fetch_input.php"; ?>
    </div>
</section>