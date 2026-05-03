<?php
// Ensure Message class is available
require_once "class/class.Message.php";

$msgObj = new Message($conn, $uid);
$active_target = isset($_GET['target']) ? (int) $_GET['target'] : null;
?>

<section class="w-24 md:w-96 bg-surface-container-low flex flex-col z-10 border-r border-outline-variant/10">
    <!-- STATIC HEADER: This stays permanent -->
    <div class="p-6">
        <h1 class="-ml-2 md:ml-0 text-sm md:text-2xl font-headline font-bold text-on-surface mb-2">Messages</h1>
        <div class="-mx-5 md:mx-0 relative mt-4">
            <span
                class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant text-xl hidden md:block">search</span>
            <input
                class="w-full bg-surface-container-high border-none rounded-xl py-2.5 pl-2 md:pl-10 pr-2 md:pr-4 text-sm text-on-surface placeholder:text-on-surface-variant/60 focus:ring-1 focus:ring-primary/40 transition-all"
                placeholder="Search conversations..." type="text" />
        </div>
    </div>

    <!-- DYNAMIC LIST: JavaScript will refresh only the content inside this div -->
    <div id="sidebar-list" class="flex-1 overflow-y-auto px-2 space-y-1 no-scrollbar w-auto">
        <?php
        // Initial load so the page isn't blank on first hit
        include "php_message/fetch_sidebar.php";
        ?>
    </div>
</section>