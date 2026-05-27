<?php
// Handle paths based on whether it's included or executed directly (AJAX)
$isAjax = !defined('INCLUDED');
if ($isAjax) {
    require_once "../config/db.php";
    require_once "../config/auth.php";
    require_once "../class/class.Community.php";
    require_once "../class/class.JaccardSimilarity.php";
    isLoggedIn();
} else {
    require_once "config/db.php";
    require_once "class/class.Community.php";
    require_once "class/class.JaccardSimilarity.php";
}

$uid = $_SESSION['uid'];
$comm = new Community($conn, $uid);
$algo = new JaccardSimilarity($conn, $uid);
$suggestCommunitys = $algo->suggestCommunities();

if (count($suggestCommunitys)):
    foreach ($suggestCommunitys as $sCid):
        $community = $comm->getCommunity($sCid);
        $memberCount = $comm->getCommunityMemberCount($sCid);
        ?>
        <!-- Card: -->
        <div
            class="group relative bg-surface-container-low rounded-xl overflow-hidden hover:bg-surface-container-high transition-all duration-500 flex flex-col h-full border border-outline-variant/10">
            <a href="view-community.php?cid=<?= $sCid ?>" class="h-48 overflow-hidden relative block">
                <img alt="<?= htmlspecialchars($community['name']) ?>"
                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110 opacity-70"
                    src="<?= htmlspecialchars($community['cover_image']) ?>" />
                <div
                    class="absolute inset-0 bg-gradient-to-t from-surface-container-low via-transparent to-transparent opacity-80 group-hover:opacity-0 transition-opacity duration-500">
                </div>
            </a>
            <div class="p-8 flex-grow flex flex-col justify-between">
                <div>
                    <a href="view-community.php?cid=<?= $sCid ?>" class="block">
                        <h3 class="text-2xl font-headline font-extrabold mb-3 group-hover:text-primary transition-colors">
                            <?= htmlspecialchars($community['name']) ?>
                        </h3>
                    </a>
                </div>
                <p class="text-on-surface-variant text-sm leading-relaxed flex-grow">
                    <?= htmlspecialchars($community['description']) ?>
                </p>
                <div class="flex items-center gap-4 mt-6 mb-6">
                    <div class="flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-[14px] text-primary">group</span>
                        <span class="text-[10px] text-on-surface-variant uppercase font-bold tracking-[0.1em]">
                            <?php
                            echo "$memberCount members";
                            ?>
                        </span>
                    </div>
                    <div class="flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-[14px] text-primary">location_on</span>
                        <span class="text-[10px] text-on-surface-variant uppercase font-bold tracking-[0.1em]">
                            <?= htmlspecialchars($community['location']) ?>
                        </span>
                    </div>
                </div>
                <button onclick="joinCommunity(<?= $sCid ?>)"
                    class="w-full bg-gradient-to-r from-primary to-primary-dim py-3 rounded-lg font-headline font-bold text-on-primary-container text-sm tracking-wide transform active:scale-95 transition-all mt-auto">Join
                    Community</button>
            </div>

        </div>
        <?php
    endforeach;
else:
    ?>
    <div class="col-span-full py-5 text-center opacity-60">
        <span class="material-symbols-outlined text-6xl text-outline">explore_off</span>
        <p class="text-on-surface-variant text-sm font-light">Join Other Communities to get Recommendation...</p>
    </div>
    <?php
endif;
?>

<!-- <div
        class="group relative bg-surface-container-low rounded-xl overflow-hidden hover:bg-surface-container-high transition-all duration-500 flex flex-col h-full">
        <div class="h-48 overflow-hidden relative">
            <img alt="Architectural Logic"
                class="w-full h-full object-cover grayscale transition-transform duration-700 group-hover:scale-110 opacity-70"
                src="https://lh3.googleusercontent.com/aida-public/AB6AXuAz6Y-QUsw0Zp3WB1nieg7mi6kU4VOnP4qsXhYfj_njBabK8oU7u-1788odgv5hNUzoAWTTsucD995RlukZxxmIiW9y3468Tx5GWZ0A14EFynY8vztNxkLLvOtgL1Wmv1FpmXdxOItTg3XBfMSiqqC-q-XDbdhicTinuRe0kvyL_fB7r2HlZ4ha_e8VLDP9WzG7-WoFqWCMKYmpXzgu8WdCSj1XtTRUocsX3JL6MaOIsGYR4clppDN_paZgkD-iiMvOO_ckkw3Zzg" />
            <div class="absolute inset-0 bg-gradient-to-t from-surface-container-low to-transparent"></div>
        </div>
        <div class="p-8 flex-grow flex flex-col justify-between">
            <div>
                <h3 class="text-2xl font-headline font-extrabold mb-3 group-hover:text-primary transition-colors">
                    Architectural Logic</h3>
                <p class="text-on-surface-variant text-sm leading-relaxed">Structural philosophy and the
                    intersection of space, weight, and human movement.</p>
                <div class="flex items-center gap-4 mt-4 mb-6">
                    <div class="flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-[14px] text-primary">group</span>
                        <span class="text-[10px] text-on-surface-variant uppercase font-bold tracking-[0.1em]">2.4k
                            Members</span>
                    </div>
                    <div class="flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-[14px] text-primary">location_on</span>
                        <span class="text-[10px] text-on-surface-variant uppercase font-bold tracking-[0.1em]">Berlin,
                            DE</span>
                    </div>
                </div>
            </div>
            <button
                class="w-full bg-gradient-to-r from-primary to-primary-dim py-3 rounded-lg font-headline font-bold text-on-primary-container text-sm tracking-wide transform active:scale-95 transition-all">Join
                Community</button>
        </div>
    </div> -->