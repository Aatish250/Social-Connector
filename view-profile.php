<?php
require_once "config/db.php";
require_once "config/auth.php";
require_once "func/func_user.php";
isLoggedIn();

$uid = $_GET['user'];

$friendsResult = getFriendList($conn, $uid);
$friendCount = mysqli_num_rows($friendsResult);
$friends = [];
if ($friendCount > 0)
    while ($row = mysqli_fetch_assoc($friendsResult))
        $friends[] = $row;

$query = "SELECT * FROM communities WHERE created_by = $uid";
$myCommunityResult = mysqli_query($conn, $query);
$myCommunityCount = mysqli_num_rows($myCommunityResult);
$myCommunity = mysqli_fetch_assoc($myCommunityResult);


$pageTitle = 'Profile | Social Connector';
$currentPage = 'profile';
include 'includes/header.php';
include 'includes/sidebar.php';
$user = getUserDetail($conn, $uid);
?>

<main class="ml-20 lg:ml-64 flex-grow p-12 min-h-screen bg-surface">
    <a href="profile.php"
        class="inline-flex items-center gap-2 font-semibold text-base mb-2 transition-colors text-on-surface">
        <span class="material-symbols-outlined text-lg align-middle">arrow_back_ios_new</span> Back to Profile
    </a>
    <!-- Profile Header Section -->
    <section class="mb-6 max-w-6xl mx-auto">
        <div class="flex items-end justify-between gap-8 mb-12">
            <div class="flex items-center gap-8">
                <div
                    class="min-h-28 min-w-28 max-w-32 max-h-32 rounded-2xl overflow-hidden shadow-2xl ring-1 ring-white/10">
                    <img alt="Profile Large" class="w-full h-full object-cover" src="<?= $user['profile_pic'] ?>" />
                </div>
                <div>
                    <h1 class="font-headline text-5xl font-extrabold tracking-tighter text-on-surface mb-3 flex gap-5">
                        <?php echo $user['fullname']; ?>
                    </h1>
                    <p class="text-on-surface-variant font-medium text-lg max-w-xl leading-relaxed">
                        <?php echo $user['bio']; ?>
                    </p>
                    <div class="flex items-center gap-3 justify-between pt-5 border-t border-outline-variant/10">
                        <div class="flex items-center text-xs font-semibold text-on-surface-variant">
                            <span
                                class="material-symbols-outlined text-[30px] <?= $user['gender'] == 'female' ? 'text-pink-500' : 'text-amber-500' ?>"><?= $user['gender'] ?></span>
                        </div>
                        <div class="flex items-center text-xs font-semibold text-on-surface-variant">
                            <span class="material-symbols-outlined text-md">calendar_month</span>
                            <span><?= $user['dob'] ?></span>
                        </div>
                        <div class="flex items-center text-xs font-semibold text-on-surface-variant">
                            <span class="material-symbols-outlined text-md">location_on</span>
                            <span>
                                <?= htmlspecialchars($user['location']) ?>
                            </span>
                        </div>
                        <div class="flex items-center text-xs font-semibold text-on-surface-variant">
                            <span class="material-symbols-outlined text-md">phone</span>
                            <span>
                                <?= htmlspecialchars($user['contact']) ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Stats Bento -->
        <div class="grid grid-cols-3 gap-6">
            <div
                class="bg-surface-container p-4 lg:p-8 rounded-xl border border-outline-variant/10 hover:border-primary/20 transition-colors ">
                <span class="text-on-surface-variant text-[10px] font-bold uppercase tracking-widest">Friends</span>
                <p class="text-4xl font-headline font-extrabold text-on-surface mt-3"><?= $friendCount ?></p>
            </div>
            <div
                class="bg-surface-container p-4 lg:p-8 rounded-xl border border-outline-variant/10 hover:border-primary/20 transition-colors ">
                <span class="text-on-surface-variant text-[10px] font-bold uppercase tracking-widest">My
                    Community</span>
                <p class="text-4xl font-headline font-extrabold text-on-surface mt-3">
                    <?= $myCommunityCount ?>
                </p>
            </div>
            <div
                class="bg-surface-container p-4 lg:p-8 rounded-xl border border-outline-variant/10 hover:border-primary/20 transition-colors ">
                <span class="text-on-surface-variant text-[10px] font-bold uppercase tracking-widest">Following
                    Community</span>
                <p class="text-4xl font-headline font-extrabold text-on-surface mt-3">
                    0
                </p>
            </div>
        </div>
    </section>
    <!-- Friends List Section -->
    <?php if ($friendCount > 0): ?>
        <section class="mt-16">
            <!-- SHow mutual friend list -->
            <div class="flex items-center my-3">
                <hr class="flex-grow border-t border-outline-variant/20">
                <span class="mx-3 text-xs text-on-surface-variant font-medium uppercase tracking-widest">
                    <?= htmlspecialchars(explode(' ', trim($user['fullname']))[0]) ?>'s' Friends <span
                        class="text-primary text-md font-light">( <?= $friendCount ?> )</span>
                </span>
                <hr class="flex-grow border-t border-outline-variant/20">
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 my-6">
                <?php foreach ($friends as $friend): ?>
                    <a href="view-profile.php?user=<?= $friend['uid'] ?>"
                        class="bg-surface-container-high rounded-xl shadow-sm p-4 flex items-center gap-4 border border-outline-variant/10 hover:border-primary/30 transition-colors group cursor-pointer">
                        <div
                            class="flex-shrink-0 h-12 w-12 rounded-full bg-primary/10 flex items-center justify-center text-primary font-bold text-lg overflow-hidden">
                            <?php if (!empty($friend['profile_pic'])): ?>
                                <img src="<?= htmlspecialchars($friend['profile_pic']) ?>"
                                    alt="<?= htmlspecialchars($friend['fullname']) ?>'s profile picture"
                                    class="h-12 w-12 rounded-full object-cover group-hover:border-2 border-primary/50" />
                            <?php else: ?>
                                <?= strtoupper(substr($friend['fullname'], 0, 1)) ?>
                            <?php endif; ?>
                        </div>

                        <div>
                            <div class="font-semibold text-on-surface text-lg group-hover:text-primary">
                                <?= htmlspecialchars($friend['fullname']) ?>
                            </div>
                            <?php if (!empty($friend['location'])): ?>
                                <div class="flex items-center gap-1 text-xs text-on-surface-variant mt-1">
                                    <span class="material-symbols-outlined text-[16px]">location_on</span>
                                    <span><?= htmlspecialchars($friend['location']) ?></span>
                                </div>
                            <?php endif ?>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>

            <!-- Show friends friend -->
            <!-- <div class="flex items-center my-3">
                <hr class="flex-grow border-t border-outline-variant/20">
                <span class="mx-3 text-xs text-on-surface-variant font-medium uppercase tracking-widest"><?php //echo htmlspecialchars(explode(' ', trim($user['fullname']))[0]); ?>'s Friends</span>
                <hr class="flex-grow border-t border-outline-variant/20">
            </div> -->
        </section>
    <?php endif ?>
    <!-- Owned Communities Section -->
    <section class="mb-16 mt-16 max-w-6xl mx-auto">

        <div class="flex items-center my-3">
            <hr class="flex-grow border-t border-outline-variant/20">
            <span class="mx-3 text-xs text-on-surface-variant font-medium uppercase tracking-widest">
                <?= htmlspecialchars(explode(' ', trim($user['fullname']))[0]) ?>'s' Community <span
                    class="text-primary text-md font-light">( <?= $myCommunityCount ?> )</span>
            </span>
            <hr class="flex-grow border-t border-outline-variant/20">
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <?php
                mysqli_data_seek($myCommunityResult, 0);
                while ($myCommunity = mysqli_fetch_assoc($myCommunityResult)) {
                    ?> <!-- Community Card -->
                    <a href="view-community.php?cid=<?= $myCommunity['cid'] ?>"
                        class="group bg-surface-container rounded-2xl overflow-hidden border border-outline-variant/10 hover:border-primary/30 transition-all duration-300">
                        <div class="h-56 overflow-hidden">
                            <img alt="<?= $myCommunity['name'] ?>"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                                src="<?= $myCommunity['cover_image'] ?>" />
                        </div>
                        <div class="p-6">
                            <h3
                                class="font-headline text-xl font-bold text-on-surface mb-3 group-hover:text-primary transition-colors">
                                <?= $myCommunity['name'] ?>
                            </h3>
                            <p class="text-on-surface-variant text-sm line-clamp-2 mb-6 leading-relaxed">
                                <?= htmlspecialchars($myCommunity['description'] ?? 'No description available.') ?>
                            </p>
                            <div class="flex items-center justify-between pt-5 border-t border-outline-variant/10">
                                <div class="flex items-center gap-2 text-xs font-semibold text-on-surface-variant">
                                    <span class="material-symbols-outlined text-sm">groups</span>
                                    <span><?= $myCommunityCount ?> Members</span>
                                </div>
                                <div class="flex items-center gap-2 text-xs font-semibold text-on-surface-variant">
                                    <span class="material-symbols-outlined text-sm">location_on</span>
                                    <span><?= $myCommunity['location'] ?></span>
                                </div>
                            </div>
                        </div>
                    </a>
                <?php }?>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>