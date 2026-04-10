<?php

require_once "config/db.php";
require_once "config/auth.php";
$user = getUserDetail($conn, $_SESSION['uid']);

$currentPage = isset($currentPage) ? $currentPage : '';
?>
<!-- SideNavBar -->
<aside
    class="h-screen w-20 lg:w-64 fixed left-0 top-0 flex flex-col bg-[#0d0d15] py-10 px-2 lg:px-6 justify-between z-40 font-['Manrope'] transition-all duration-300">
    <div class="flex flex-col">
        <!-- Brand Text -->
        <div class="flex gap-2">
            <!-- Logo -->
            <div class="mb-4">
                <div
                    class="w-12 h-12 lg:w-16 lg:h-16 signature-gradient rounded-xl flex items-center justify-center shadow-lg shadow-primary/20">
                    <span class="material-symbols-outlined text-on-primary-container text-3xl lg:text-4xl">hub</span>
                </div>
            </div>
            <!-- title (hide on small, show on large) -->
            <div class="hidden lg:block text-2xl font-black text-[#e6e3f8] mb-12 font-headline tracking-tighter">Social
                Connector</div>
        </div>

        <!-- Profile Section -->
        <a href="profile.php"
            class="flex items-center gap-3 p-2 mb-8 mt-4 hover:bg-surface-container-high rounded-xl transition-all duration-300">
            <img alt="User profile picture" class="w-10 h-10 rounded-full object-cover grayscale"
                src="<?= $user['profile_pic'] ?>" />
            <div class="hidden lg:flex flex-col">
                <span class="font-headline font-bold text-sm text-on-surface"><?= $user['fullname'] ?></span>
                <span class="text-[10px] text-on-surface-variant lowercase tracking-widest"><?= $user['email'] ?></span>
            </div>
        </a>

        <!-- Navigation Links -->
        <nav class="space-y-4 lg:space-y-6">
            <a class="flex items-center justify-center lg:justify-start gap-0 lg:gap-4 <?php echo $currentPage == 'messages' ? 'text-[#ac8aff]' : 'text-[#aba9bd] hover:text-[#e6e3f8]'; ?> transition-colors duration-300 font-headline font-semibold tracking-wide text-sm"
                href="messages.php">
                <span class="material-symbols-outlined text-2xl lg:text-base">chat_bubble</span>
                <span class="hidden lg:inline ml-0 lg:ml-1">Messages</span>
            </a>
            <a class="flex items-center justify-center lg:justify-start gap-0 lg:gap-4 <?php echo $currentPage == 'communities' ? 'text-[#ac8aff]' : 'text-[#aba9bd] hover:text-[#e6e3f8]'; ?> transition-colors duration-300 font-headline font-semibold tracking-wide text-sm"
                href="communities.php">
                <span class="material-symbols-outlined text-2xl lg:text-base">group</span>
                <span class="hidden lg:inline ml-0 lg:ml-1">Communities</span>
            </a>
            <a class="flex items-center justify-center lg:justify-start gap-0 lg:gap-4 <?php echo $currentPage == 'discover' ? 'text-[#ac8aff]' : 'text-[#aba9bd] hover:text-[#e6e3f8]'; ?> transition-colors duration-300 font-headline font-semibold tracking-wide text-sm"
                href="discover.php">
                <span class="material-symbols-outlined text-2xl lg:text-base">explore</span>
                <span class="hidden lg:inline ml-0 lg:ml-1">Discover</span>
            </a>
            <a class="flex items-center justify-center lg:justify-start gap-0 lg:gap-4 <?php echo $currentPage == 'find-users' ? 'text-[#ac8aff]' : 'text-[#aba9bd] hover:text-[#e6e3f8]'; ?> transition-colors duration-300 font-headline font-semibold tracking-wide text-sm"
                href="find-users.php">
                <span class="material-symbols-outlined text-2xl lg:text-base">person_add</span>
                <span class="hidden lg:inline ml-0 lg:ml-1">Find Users</span>
            </a>
            
            <?php print_r($_SESSION); ?>
        </nav>
    </div>

    <!-- Bottom Actions -->
    <div class="flex flex-col gap-8">
        <a class="flex items-center justify-center lg:justify-start gap-0 lg:gap-4 text-[#aba9bd] hover:text-error transition-colors duration-300 font-headline font-semibold tracking-wide text-sm"
            href="config/auth.php?logout=logout">
            <span class="material-symbols-outlined text-2xl lg:text-base">logout</span>
            <span class="hidden lg:inline ml-0 lg:ml-1">Logout</span>
        </a>
    </div>
</aside>