<section class="flex-1 bg-surface-variant flex flex-col h-full relative">
    <?php
    require_once "class/class.Message.php";
    $uid = $_SESSION['uid'];
    $target_uid = isset($_GET['target']) ? (int) $_GET['target'] : 0;
    $msgObj = new Message($conn, $uid);

    // 1. Check if target user exists
    $exists = false;
    $isConnected = false;

    if ($target_uid > 0) {
        $checkUser = $conn->prepare("SELECT uid FROM users WHERE uid = ?");
        $checkUser->bind_param("i", $target_uid);
        $checkUser->execute();
        $exists = $checkUser->get_result()->num_rows > 0;

        // 2. Check friendship status in your friendships table
        if ($exists) {
            $isConnected = $msgObj->isUserConnected($target_uid);
        }
    }

    $canChat = ($exists && $isConnected);
    ?>

    <!-- Header: Hidden if target=99 or not friends -->
    <header id="chat-header"
        class="h-20 flex items-center px-8 bg-surface-container-low/50 backdrop-blur-md sticky top-0 z-30 <?= !$canChat ? 'hidden' : '' ?>">
        <?php if ($canChat)
            include "php_message/fetch_header.php"; ?>
    </header>

    <!-- Chat Box -->
    <div id="chat-box" class="flex-1 overflow-y-auto p-8 flex flex-col gap-8 no-scrollbar">
        <?php
        if ($target_uid === 0) {
            echo '<div class="flex flex-col items-center justify-center h-full opacity-40 text-center">
                    <span class="material-symbols-outlined text-6xl mb-4">chat</span>
                    <p class="font-manrope font-semibold text-lg">Select a conversation</p>
                  </div>';
        } elseif (!$exists) {
            // FIX FOR target=99
            echo '<div class="flex flex-col items-center justify-center h-full opacity-40 text-center">
                    <span class="material-symbols-outlined text-6xl mb-4">person_off</span>
                    <p class="font-manrope font-semibold text-lg">User not found</p>
                  </div>';
        } elseif (!$isConnected) {
            echo '<div class="flex flex-col items-center justify-center h-full opacity-40 text-center">
                    <span class="material-symbols-outlined text-6xl mb-4">person_add</span>
                    <p class="font-manrope font-semibold text-lg">Not Connected</p>
                    <p class="text-sm">You must be friends to chat.</p>
                  </div>';
        } else {
            include "php_message/fetch_chat.php";
        }
        ?>
    </div>

    <!-- Input Area: Hidden if target=99 or not friends -->
    <div id="chat-input-area" class="<?= !$canChat ? 'hidden' : '' ?>">
        <?php if ($canChat)
            include "php_message/fetch_input.php"; ?>
    </div>
</section>