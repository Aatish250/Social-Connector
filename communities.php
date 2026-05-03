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

    // 1. Function to switch communities
    window.switchCommunity = function (cid) {
        currentCid = cid;
        // Update URL without refreshing
        const newUrl = window.location.pathname + '?target=' + cid;
        window.history.pushState({ path: newUrl }, '', newUrl);

        // 2. Refresh everything
        fetchMessages();
        fetchHeader();
        fetchSidebar(); // This forces the active highlight to move
        fetchInputArea(); // Add this line!
    };

    function fetchInputArea() {
        const inputArea = document.getElementById('chat-input-area');
        if (!inputArea) return;

        fetch(`php_community_message/fetch_input.php?target=${currentCid}`)
            .then(res => res.text())
            .then(html => {
                inputArea.innerHTML = html;
            });
    }

    // 2. Function to fetch messages
    window.fetchMessages = function () {
        const chatBox = document.getElementById('chat-box');
        if (currentCid === 0 || !chatBox) return;

        fetch(`php_community_message/fetch_chat.php?target=${currentCid}`)
            .then(res => res.text())
            .then(html => {
                if (chatBox.innerHTML !== html) {
                    chatBox.innerHTML = html;
                    chatBox.scrollTop = chatBox.scrollHeight;
                }
            });
    };

    function fetchHeader() {
        const header = document.getElementById('chat-header');
        if (!currentCid || !header) return;

        fetch(`php_community_message/fetch_header.php?target=${currentCid}`)
            .then(res => res.text())
            .then(html => {
                header.innerHTML = html;
            });
    }

    // Ensure fetchSidebar is also defined to update the list highlight
    window.fetchSidebar = function () {
        const sidebar = document.getElementById('sidebar-list');
        if (!sidebar) return;

        fetch(`php_community_message/fetch_sidebar.php?target=${currentCid}`)
            .then(res => res.text())
            .then(html => {
                sidebar.innerHTML = html;
            });
    };

    // Call it on page load
    document.addEventListener('DOMContentLoaded', () => {
        fetchSidebar();
        if (currentCid > 0) fetchMessages();
    });

    // 3. Handle sending messages
    document.addEventListener('DOMContentLoaded', () => {
        // 1. Always load the sidebar
        fetchSidebar();

        // 2. If there is a target in the URL, load the content immediately
        if (currentCid > 0) {
            fetchHeader();   // Loads the name and image on refresh
            fetchMessages(); // Loads the chat history on refreshfetchInputArea(); // Add this line!
            setInterval(fetchMessages, 3000); // Start the polling loop
        }
        // Start the global polling loop
        startLiveUpdates();

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
                            input.value = '';// --- DYNAMIC RELOAD OF ALL COMPONENTS ---
                            fetchMessages(); // Refresh chat bubbles immediately
                            fetchSidebar();  // Refresh sidebar to show latest text/order
                            // ----------------------------------------
                        }
                    });
            }
        });

        // Function to handle automatic updates
        function startLiveUpdates() {
            // Clear any existing intervals if necessary
            if (window.communityInterval) clearInterval(window.communityInterval);

            window.communityInterval = setInterval(() => {
                if (currentCid > 0) {
                    fetchMessages(); // Refresh chat bubbles
                }
                fetchSidebar(); // Refresh latest text and ordering in list
            }, 3000); // 3 seconds
        }

    });
</script>