<?php
require_once "config/db.php";
require_once "config/auth.php";
require_once "func/func_user.php";
isLoggedIn();

$uid = $_SESSION['uid'];
$user = getUserDetail($conn, $_SESSION['uid']);
$pageTitle = 'Messages | Social Connector';
$currentPage = 'messages';
include 'includes/header.php';
include 'includes/sidebar.php';
?>

<!-- Main Content Area -->
<main class="flex-1 flex h-screen ml-20 lg:ml-64">
    <?php
    //holds the list of friens/list of conversations
    include "php_message/user_list.php";
    //holds the chat histry
    include "php_message/chat.php";
    ?>

</main>

<?php include 'includes/footer.php'; ?>

<script>
    // Global variable for current target
    let currentTargetUid = <?= isset($_GET['target']) ? (int) $_GET['target'] : 0 ?>;
    let messageInterval = null;
    let sidebarInterval = null;

    // 1. Function to Refresh the Chat Header (Name & Photo)
    window.fetchHeader = function () {
        const header = document.getElementById('chat-header');
        if (currentTargetUid === 0 || !header) return;

        fetch(`php_message/fetch_header.php?target=${currentTargetUid}`)
            .then(res => res.text())
            .then(html => {
                // ONLY update if we got actual content back
                if (html.trim() !== "") {
                    header.classList.remove('hidden'); // Show it if it was hidden
                    header.innerHTML = html;
                } else {
                    header.classList.add('hidden'); // Hide if unauthorized
                }
            });
    };

    // 2. Function to Refresh the Input Area (Send button vs Locked message)
    window.fetchInputArea = function () {
        const inputArea = document.getElementById('chat-input-area');
        if (currentTargetUid === 0 || !inputArea) return;

        fetch(`php_message/fetch_input.php?target=${currentTargetUid}`)
            .then(res => res.text())
            .then(html => {
                if (html.trim() !== "") {
                    inputArea.classList.remove('hidden');
                    inputArea.innerHTML = html;
                } else {
                    inputArea.classList.add('hidden');
                }
            });
    };

    // 3. Function to Refresh the Sidebar
    window.fetchSidebar = function () {
        const sidebarList = document.getElementById('sidebar-list');
        if (!sidebarList) return;

        fetch(`php_message/fetch_sidebar.php?target=${currentTargetUid}`)
            .then(res => res.text())
            .then(html => {
                if (sidebarList.innerHTML !== html) {
                    sidebarList.innerHTML = html;
                }
            });
    };

    // 4. Function to Refresh Message Bubbles
    window.fetchMessages = function () {
        const chatBox = document.getElementById('chat-box');
        if (currentTargetUid === 0 || !chatBox) return;

        fetch(`php_message/fetch_chat.php?target=${currentTargetUid}`)
            .then(res => res.text())
            .then(html => {
                // Remove the strict trim check to allow clearing loader for new chats
                if (chatBox.innerHTML !== html) {
                    chatBox.innerHTML = html;
                    chatBox.scrollTop = chatBox.scrollHeight;
                }
            });
    };

    // Start/Restart Polling
    function startPolling() {
        // Clear existing intervals if any
        if (messageInterval) clearInterval(messageInterval);
        if (sidebarInterval) clearInterval(sidebarInterval);

        if (currentTargetUid > 0) {
            messageInterval = setInterval(fetchMessages, 2000); // 2 seconds for messages
            sidebarInterval = setInterval(fetchSidebar, 2000); // 30 seconds for sidebar
        }
    }

    // 5. The Switch Function
    window.switchChat = function (newUid) {
        if (currentTargetUid === newUid) return; // Don't reload if same target
        currentTargetUid = newUid;

        // Show a quick loader while switching
        document.getElementById('chat-box').innerHTML = '<div class="opacity-20 p-10 text-center">Loading...</div>';

        const newurl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?target=' + newUid;
        window.history.pushState({ path: newurl }, '', newurl);

        fetchHeader();
        fetchMessages();
        fetchSidebar();
        fetchInputArea();

        // Restart polling with new target
        startPolling();
    };

    document.addEventListener('DOMContentLoaded', function () {
        if (currentTargetUid > 0) {
            // Initial Load
            fetchHeader();
            fetchMessages();
            fetchInputArea();
            startPolling();
        }

        // Handle sending
        document.addEventListener('submit', function (e) {
            if (e.target && e.target.id === 'chat-form') {
                e.preventDefault();
                const input = document.getElementById('message-input');
                const content = input.value.trim();
                if (!content) return;

                fetch('php_message/send_ajax.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: `receiver_id=${currentTargetUid}&content=${encodeURIComponent(content)}`
                })
                    .then(res => res.text())
                    .then(data => {
                        if (data === "success") {
                            input.value = '';
                            fetchMessages();
                            fetchSidebar();
                        }
                    });
            }
        });
    });
</script>