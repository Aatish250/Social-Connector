<!-- Right Pane: Active Group Chat -->
<section class="flex-1 bg-surface-variant flex flex-col h-full relative">

    <!-- Chat Header -->
    <!-- The ID 'chat-header' is targeted by fetchHeader() in communities.php -->
    <header id="chat-header"
        class="h-20 flex items-center px-8 bg-surface-container-low/50 backdrop-blur-md sticky top-0 z-30">
        <?php
        // Initial load logic: if a target is already in the URL, include the header content
        if (isset($_GET['target']) && (int) $_GET['target'] > 0) {
            include "php_community_message/fetch_header.php";
        }
        ?>
    </header>

    <!-- Messages Area -->
    <!-- The ID 'chat-box' is targeted by fetchMessages() to scroll and inject bubbles -->
    <div id="chat-box" class="flex-1 overflow-y-auto p-8 flex flex-col gap-8 no-scrollbar">
        <?php
        if (isset($_GET['target']) && (int) $_GET['target'] > 0) {
            include "php_community_message/fetch_chat.php";
        } else {
            // Placeholder for when no community is selected
            echo '
            <div class="flex flex-col items-center justify-center h-full opacity-40 text-on-surface text-center px-10">
                <span class="material-symbols-outlined text-6xl mb-4">forum</span>
                <p class="font-manrope font-semibold">Select a community from the sidebar to start chatting.</p>
            </div>';
        }
        ?>
    </div>

    <!-- Message Input Bar Container -->
    <!-- The ID 'chat-input-area' allows JS to show/hide the send box dynamically -->
    <div id="chat-input-area">
        <?php
        if (isset($_GET['target']) && (int) $_GET['target'] > 0) {
            include "php_community_message/fetch_input.php";
        }
        ?>
    </div>

</section>

<!-- Optional: Simple script to ensure the chat-box always starts at the bottom on hard refresh -->
<script>
    window.addEventListener('load', () => {
        const chatBox = document.getElementById('chat-box');
        if (chatBox) {
            chatBox.scrollTop = chatBox.scrollHeight;
        }
    });
</script>