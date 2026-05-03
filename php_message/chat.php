<section class="flex-1 bg-surface-variant flex flex-col relative">
    <header id="chat-header" class="h-20 px-8 flex items-center bg-surface-container-low/50 backdrop-blur-md">
        <?php include "php_message/fetch_header.php"; ?>
    </header>

    <div id="chat-box" class="flex-1 overflow-y-auto p-8 space-y-4 flex flex-col no-scrollbar">
        <!-- Messages loaded here -->
    </div>

    <!-- WRAPPER FOR DYNAMIC INPUT AREA -->
    <div id="chat-input-area">
        <?php include "php_message/fetch_input.php"; ?>
    </div>
</section>