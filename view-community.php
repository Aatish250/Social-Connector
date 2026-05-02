<?php
require_once "config/db.php";
require_once "config/auth.php";
require_once "func/func_user.php";
isLoggedIn();

if (!isset($_GET['cid']) || empty($_GET['cid'])) {
    header("Location: profile.php");
    exit();
}

$cid = intval($_GET['cid']);
$uid = $_SESSION['uid'];

// Fetch community details
$query = "SELECT c.*, u.fullname as creator_name 
          FROM communities c 
          JOIN users u ON c.created_by = u.uid 
          WHERE c.cid = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $cid);
mysqli_stmt_execute($stmt);
$communityResult = mysqli_stmt_get_result($stmt);
$community = mysqli_fetch_assoc($communityResult);

if (!$community) {
    header("Location: profile.php");
    exit();
}

// Fetch member count
$memberCountQuery = "SELECT COUNT(*) as count FROM community_members WHERE cid = ?";
$stmt = mysqli_prepare($conn, $memberCountQuery);
mysqli_stmt_bind_param($stmt, "i", $cid);
mysqli_stmt_execute($stmt);
$memberCountResult = mysqli_stmt_get_result($stmt);
$memberCount = mysqli_fetch_assoc($memberCountResult)['count'];

// Check if current user is a member
$isMemberQuery = "SELECT role FROM community_members WHERE cid = ? AND uid = ?";
$stmt = mysqli_prepare($conn, $isMemberQuery);
mysqli_stmt_bind_param($stmt, "ii", $cid, $uid);
mysqli_stmt_execute($stmt);
$isMemberResult = mysqli_stmt_get_result($stmt);
$membership = mysqli_fetch_assoc($isMemberResult);
$userRole = $membership ? $membership['role'] : null;
$isMember = $userRole === "member";
$isOwner = $userRole === "owner";

// Fetch some members to display
$membersQuery = "SELECT u.uid, u.fullname, u.profile_pic, cm.role 
                 FROM community_members cm 
                 JOIN users u ON cm.uid = u.uid 
                 WHERE cm.cid = ? 
                 LIMIT 6";
$stmt = mysqli_prepare($conn, $membersQuery);
mysqli_stmt_bind_param($stmt, "i", $cid);
mysqli_stmt_execute($stmt);
$membersResult = mysqli_stmt_get_result($stmt);
$members = [];
while ($row = mysqli_fetch_assoc($membersResult)) {
    $members[] = $row;
}

$pageTitle = $community['name'] . ' | Social Connector';
include 'includes/header.php';
include 'includes/sidebar.php';
?>

<main class="ml-20 lg:ml-64 flex-grow p-12 min-h-screen bg-surface">
    <a href="profile.php"
        class="inline-flex items-center gap-2 font-semibold text-base mb-2 transition-colors text-on-surface">
        <span class="material-symbols-outlined text-lg align-middle">arrow_back_ios_new</span> Back to Profile
    </a>
    <!-- Community Header -->
    <section class="max-w-6xl mx-auto mb-12">
        <div class="relative min-h-60 rounded-3xl overflow-hidden shadow-2xl mb-8 group flex flex-col">

            <img src="<?= htmlspecialchars($community['cover_image']) ?>"
                alt="<?= htmlspecialchars($community['name']) ?>"
                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" />
            <div
                class="relative lg:absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent flex items-end p-10 flex-col md:flex-row">
                <!-- Community details -->
                <div class="flex-1">
                    <div class="flex items-center gap-3 mb-4">
                        <span
                            class="px-3 py-1 bg-primary/20 text-primary text-xs font-bold rounded-full backdrop-blur-md border border-primary/30 uppercase tracking-widest">
                            <?= htmlspecialchars($community['category']) ?>
                        </span>
                        <span class="flex items-center gap-1 text-white/70 text-xs font-bold">
                            <span class="material-symbols-outlined text-sm">location_on</span>
                            <?= htmlspecialchars($community['location']) ?>
                        </span>
                    </div>
                    <h1 class="text-5xl font-headline font-black text-white tracking-tighter mb-2">
                        <?= htmlspecialchars($community['name']) ?>
                    </h1>
                    <p class="text-white/80 text-lg max-w-2xl leading-relaxed">
                        <?= htmlspecialchars($community['description']) ?>
                    </p>
                </div>
                <!-- Buttons for community-cover -->
                <div class="flex flex-row mt-4 sm:flex-col gap-3 w-full md:w-auto items-stretch md:items-end">
                    <?php if ($userRole === 'owner'): ?>
                        <a href="edit-community.php?cid=<?= $cid ?>"
                            class="flex-1 flex items-center justify-center gap-2 px-4 py-4 md:px-8 bg-surface-container text-on-surface rounded-xl text-sm font-bold hover:bg-surface-container-high transition-all min-w-[180px]">
                            <span class="material-symbols-outlined text-lg">edit</span>
                            Manage Community
                        </a>
                    <?php endif; ?>

                    <button id="joinLeaveDeleteBtn" data-cid="<?= $cid ?>"
                        data-status="<?= $isOwner ? 'delete' : ($isMember ? 'leave' : 'join') ?>"
                        class="flex-1 flex items-center justify-center gap-2 px-4 py-4 md:px-8 <?= $isOwner || $isMember ? 'bg-error-container text-on-error-container' : 'bg-primary text-on-primary' ?> rounded-2xl text-base font-black transition-all hover:scale-105 active:scale-95 shadow-xl shadow-primary/20 min-w-[180px]">
                        <span
                            class="material-symbols-outlined text-xl"><?= $isOwner ? 'delete_forever' : ($isMember ? 'logout' : 'person_add') ?></span>
                        <?= $isOwner ? 'Delete Community' : ($isMember ? 'Leave Community' : 'Join Community') ?>
                    </button>
                </div>

            </div>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="bg-surface-container p-6 rounded-2xl border border-outline-variant/10">
                <span class="text-on-surface-variant text-[10px] font-bold uppercase tracking-[0.2em]">Total
                    Members</span>
                <p class="text-3xl font-headline font-black text-on-surface mt-2"><?= $memberCount ?></p>
            </div>
            <div class="bg-surface-container p-6 rounded-2xl border border-outline-variant/10">
                <span class="text-on-surface-variant text-[10px] font-bold uppercase tracking-[0.2em]">Founded By</span>
                <a href="view-profile.php?user=<?= $community['created_by'] ?>"
                    class="block text-xl font-headline font-bold text-primary mt-2 hover:underline">
                    <?= htmlspecialchars($community['creator_name']) ?>
                </a>
            </div>
            <div class="bg-surface-container p-6 rounded-2xl border border-outline-variant/10">
                <span class="text-on-surface-variant text-[10px] font-bold uppercase tracking-[0.2em]">Founded On</span>
                <p class="text-xl font-headline font-bold text-on-surface mt-2">
                    <?= date('M d, Y', strtotime($community['created_at'])) ?>
                </p>
            </div>
            <div class="bg-surface-container p-6 rounded-2xl border border-outline-variant/10">
                <span class="text-on-surface-variant text-[10px] font-bold uppercase tracking-[0.2em]">Role</span>
                <p class="text-xl font-headline font-bold text-on-surface mt-2 uppercase tracking-wide">
                    <?= $userRole ? $userRole : 'Visitor' ?>
                </p>
            </div>
        </div>
    </section>

    <!-- Community Content -->
    <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-3 gap-12">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-12">
            <section>
                <h2 class="text-2xl font-headline font-black text-on-surface mb-6 flex items-center gap-3">
                    <span class="material-symbols-outlined text-primary">feed</span>
                    Activity Feed
                </h2>
                <div
                    class="bg-surface-container-low rounded-3xl p-12 text-center border-2 border-dashed border-outline-variant/20">
                    <span class="material-symbols-outlined text-6xl text-outline-variant/40 mb-4">nest_eco_leaf</span>
                    <p class="text-on-surface-variant font-medium">This community is quiet... for now.</p>
                </div>
            </section>
        </div>

        <!-- Sidebar Content -->
        <div class="space-y-12">
            <!-- Members Section -->
            <section>
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-headline font-black text-on-surface">Members</h2>
                    <span class="text-xs font-bold text-primary"><?= $memberCount ?> total</span>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <?php foreach ($members as $member): ?>
                        <a href="view-profile.php?user=<?= $member['uid'] ?>"
                            class="flex flex-col items-center p-4 bg-surface-container rounded-2xl border border-transparent hover:border-primary/30 transition-all group">
                            <img src="<?= htmlspecialchars($member['profile_pic']) ?>"
                                alt="<?= htmlspecialchars($member['fullname']) ?>"
                                class="w-16 h-16 rounded-full object-cover mb-3 group-hover:ring-4 ring-primary/20 transition-all" />
                            <span
                                class="text-xs font-bold text-on-surface text-center line-clamp-1"><?= htmlspecialchars($member['fullname']) ?></span>
                            <span
                                class="text-[10px] text-on-surface-variant uppercase tracking-tighter mt-1"><?= $member['role'] ?></span>
                        </a>
                    <?php endforeach; ?>
                </div>
                <?php if ($memberCount > 6): ?>
                    <button
                        class="w-full mt-6 py-3 bg-surface-container-high rounded-xl text-xs font-bold text-on-surface hover:bg-surface-container-highest transition-all">
                        View All Members
                    </button>
                <?php endif; ?>
            </section>
        </div>
    </div>
</main>

<script>
    document.getElementById('joinLeaveDeleteBtn').addEventListener('click', function () {
        const btn = this;
        const cid = btn.dataset.cid;
        const status = btn.dataset.status;

        // This would normally call a PHP script to join/leave
        // For now, let's just show a toast or alert
        switch (status) {
            case 'join':
                console.log(`Joining community ${cid}`);
                console.log("php/" + cid);
                fetch('php/community_process.php?action=join&cid=' + cid)
                    .then(response => response.json())
                    .then(data => {
                        showToast(data.message, data.status, data.timmer);
                        setTimeout(() => {
                            window.location.reload();
                        }, (data.timmer ? data.timmer : 1) * 1000);
                    });
                break;
            case 'delete':
                console.log(`deliting community ${cid}`);
                fetch('php/community_process.php?action=delete&cid=' + cid)
                    .then(response => response.json())
                    .then(data => {
                        showToast(data.message, data.status, data.timmer);
                        setTimeout(() => {
                            window.location.reload();
                        }, (data.timmer ? data.timmer : 1) * 1000);
                    });
                break;
            case 'leave':
                console.log(`Leaving community ${cid}`);
                fetch('php/community_process.php?action=leave&cid=' + cid)
                    .then(response => response.json())
                    .then(data => {
                        showToast(data.message, data.status, data.timmer);
                        setTimeout(() => {
                            window.location.reload();
                        }, (data.timmer ? data.timmer : 1) * 1000);
                    });
                break;
            default:
                // no action
                break;
        }


        // Example fetch call (you'd need to create this PHP endpoint)
        /*
        fetch('php/community_membership.php', {
            method: 'POST',
            body: JSON.stringify({ cid: cid, action: status })
        })
        .then(res => res.json())
        .then(data => {
            if (data.status) window.location.reload();
        });
        */
    });
</script>

<?php include 'includes/footer.php'; ?>