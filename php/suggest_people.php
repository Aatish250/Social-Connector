<!-- BFS Algorithm -->
<?php

require_once "../config/db.php";
require_once "../config/auth.php";
isLoggedIn();
require_once "../func/func_user.php";
$uid = $_SESSION['uid'];
include "../algorithm/BFS.php";
require_once '../class/class.Mutuals.php';

$suggestionLimit = intval($_GET['suggestionLimit']);
// $suggestionLimit = isset($_GET['suggestionLimit']) ? intval($_GET['suggestionLimit']) : 4;

$fof_IDs = getFriendsOfFriendsIDs($conn, $uid);

?>

<div class="flex items-center justify-between mb-8">
    <h2 class="text-xs uppercase tracking-[0.2em] font-bold text-on-surface-variant">People You May Know -
        <?= count($fof_IDs) ?>
    </h2>
</div>
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mb-10">
    <?php
    shuffle($fof_IDs);
    $limitedSuggestions = array_slice($fof_IDs, 0, $suggestionLimit);
    foreach ($limitedSuggestions as $fof_ID) {
        $foufDetail = getUserDetail($conn, $fof_ID);
        ?>

        <form data-uid="<?= $foufDetail['uid'] ?>"
            class="suggestedUserCard flex flex-col items-center text-center p-6 bg-surface-container-high rounded-2xl border border-transparent hover:border-outline-variant/20 transition-all group">
            <a href="view-profile.php?user=<?= $foufDetail['uid'] ?>" class="block group/link flex-1 border-b-2 border-outline-variant/20">
       
                <div class="relative mb-2 flex items-cente justify-center">
                    <img alt="<?= $foufDetail['fullname'] ?>"
                        class="w-24 h-24 rounded-full object-cover p-1 border-2 border-primary/20 group-hover:border-primary transition-all"
                        src="<?= $foufDetail['profile_pic'] ?>" />
                </div>
                <span
                    class="font-headline font-bold text-lg text-on-surface mb-2 block group-hover/link:text-primary transition-colors">
                    <?= $foufDetail['fullname'] ?>
                </span>
            </a>
            <hr>
            <!-- Mutual section -->
            <div class="flex flex-col -space-y-3 mt-2">
                <?php
                $m = new Mutuals($conn, $uid, $fof_ID, 3);

                ?>
                <?php
                $m->echoImage();
                ?>
                <p>
                    <span class="text-xs font-medium text-on-surface-variant">
                        <?= $m->mutualCount() . " mutuals..." ?>
                    </span>
                </p>
            </div>

            <button
                class="w-full bg-surface-variant text-on-surface py-3 rounded-lg text-xs font-bold hover:bg-primary hover:text-on-primary-container transition-all mt-auto">Connect</button>
        </form>
    <?php }
    ?>
</div>