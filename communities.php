<?php
require_once "config/db.php";
require_once "config/auth.php";
require_once "func/func_user.php";
isLoggedIn();

$uid = $_SESSION['uid'];
$user = getUserDetail($conn, $_SESSION['uid']);

$pageTitle = 'Velvet Nocturne | Communities';
$currentPage = 'communities';
include 'includes/header.php';
include 'includes/sidebar.php';
?>

<!-- Main Three-Pane Shell -->
<main class="flex-1 flex ml-20 lg:ml-64 h-screen overflow-hidden">
    <?php
    //user conversatation heads
    include "php_community_message/user_list.php";
    // user conversataion history and chatting
    include "php_community_message/chat.php";
    ?>


</main>

<?php include 'includes/footer.php'; ?>
<script>
    let currentCid = <?= isset($_GET['target']) ? (int) $_GET['target'] : 0 ?>;
    let communityInterval = null;

    // 1. Function to Refresh Message Bubbles
    window.fetchMessages = function () {
        const chatBox = document.getElementById('chat-box');
        if (currentCid === 0 || !chatBox) return;

        fetch(`php_community_message/fetch_chat.php?target=${currentCid}`)
            .then(res => res.text())
            .then(html => {
                // Remove the strict trim check to allow clearing loader for new chats
                if (chatBox.innerHTML !== html) {
                    chatBox.innerHTML = html;
                    chatBox.scrollTop = chatBox.scrollHeight;
                }
            });
    };

    // 2. Function to Refresh the Input Area
    window.fetchInputArea = function () {
        const inputArea = document.getElementById('chat-input-area');
        if (!inputArea || currentCid === 0) return;

        fetch(`php_community_message/fetch_input.php?target=${currentCid}`)
            .then(res => res.text())
            .then(html => {
                if (html.trim() === "") {
                    inputArea.classList.add('hidden');
                } else {
                    inputArea.classList.remove('hidden');
                    inputArea.innerHTML = html;
                }
            });
    }

    // 3. Function to Refresh the Header
    window.fetchHeader = function () {
        const header = document.getElementById('chat-header');
        if (!header || currentCid === 0) return;

        fetch(`php_community_message/fetch_header.php?target=${currentCid}`)
            .then(res => res.text())
            .then(html => {
                if (html.trim() === "") {
                    header.classList.add('hidden');
                } else {
                    header.classList.remove('hidden');
                    header.innerHTML = html;
                }
            });
    }

    // 4. Function to Refresh the Sidebar
    window.fetchSidebar = function () {
        const sidebar = document.getElementById('sidebar-list');
        if (!sidebar) return;

        fetch(`php_community_message/fetch_sidebar.php?target=${currentCid}`)
            .then(res => res.text())
            .then(html => {
                if (sidebar.innerHTML !== html) {
                    sidebar.innerHTML = html;
                }
            });
    };

    // 5. Function to start polling
    window.startLiveUpdates = function () {
        if (communityInterval) clearInterval(communityInterval);
        
        // Polling loop
        communityInterval = setInterval(() => {
            if (currentCid > 0) {
                fetchMessages();
            }
            fetchSidebar();
        }, 2000); // 2 seconds as requested
    }

    // 6. Function to switch communities
    window.switchCommunity = function (cid) {
        if (!cid || currentCid === cid) return;
        currentCid = cid;

        // Update URL
        const newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?target=' + cid;
        window.history.pushState({ path: newUrl }, '', newUrl);

        // Clear current view
        const chatBox = document.getElementById('chat-box');
        if (chatBox) chatBox.innerHTML = '<div class="opacity-20 p-10 text-center">Loading...</div>';

        // Refresh Components
        fetchHeader();
        fetchMessages();
        fetchInputArea();
        fetchSidebar();

        // Reset Polling
        startLiveUpdates();
    };

    document.addEventListener('DOMContentLoaded', () => {
        if (currentCid > 0) {
            fetchHeader();
            fetchMessages();
            fetchInputArea();
        }
        fetchSidebar();
        startLiveUpdates();

        // Handle sending messages
        document.addEventListener('submit', function (e) {
            if (e.target && e.target.id === 'community-chat-form') {
                e.preventDefault();
                const input = document.getElementById('message-input');
                const content = input.value.trim();

                if (!content || currentCid === 0) return;

                fetch('php_community_message/send_community_ajax.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: `cid=${currentCid}&content=${encodeURIComponent(content)}`
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