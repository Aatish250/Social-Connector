<?php

// __DIR__ points to 'php/'. '/../' steps out to the root directory safely for BOTH page-load and AJAX!
require_once __DIR__ . "/../config/db.php";
require_once __DIR__ . "/../config/auth.php";
require_once __DIR__ . "/../class/class.Community.php";


$uid = $_SESSION['uid'];
$limit = isset($_GET['limit']) ? intval($_GET['limit']) : 4;

$comm = new Community($conn, $uid);
$otherCommunities = $comm->getCommunitiesNotInSuggestions($limit);
// echo "<pre>";
// print_r($community->getCommunitiesNotInSuggestions());
// echo "</pre>";

if (count($otherCommunities)):
    foreach ($otherCommunities as $sCid):
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
    <div class="col-span-full py-5 text-center">
        <span class="material-symbols-outlined text-6xl text-outline mb-4">explore_off</span>
        <p class="text-on-surface-variant text-lg font-medium">Please Join Atleast one community.</p>
    </div>
    <?php
endif;

?>