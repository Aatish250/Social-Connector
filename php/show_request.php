<?php
function send($message, $status = 1, $timmer = 3.5)
{
    header("Content-Type: application/json");
    echo json_encode(['message' => $message, 'status' => $status, 'timmer' => $timmer]);
    exit;
}

require_once "../config/db.php";
require_once "../config/auth.php";

$uid = $_SESSION['uid'];



if (isset($_GET['action']) && $_GET['action'] === 'accept' && isset($_GET['sender_uid'])) {
    $sender_uid = intval($_GET['sender_uid']);
    $updateQuery = "UPDATE friendships 
                    SET status = 'accepted' 
                    WHERE sender_uid = $sender_uid 
                    AND reciver_uid = $uid";

    if (mysqli_query($conn, $updateQuery))
        send("Request Accepted");
    else
        send("Error DB", 0);
}

if (isset($_GET['action']) && $_GET['action'] === 'decline' && isset($_GET['sender_uid'])) {
    $sender_uid = intval($_GET['sender_uid']);
    $updateQuery = "UPDATE friendships 
                    SET status = 'declined' 
                    WHERE sender_uid = $sender_uid 
                    AND reciver_uid = $uid";

    if (mysqli_query($conn, $updateQuery))
        send("Request Declined");
    else
        send("Error DB", 0);
}


$query = "SELECT sender_uid, status FROM friendships WHERE reciver_uid = $uid AND status IN ('pending')";
$result = mysqli_query($conn, $query);
$friendCount = mysqli_num_rows($result);

if ($friendCount > 0) {
    ?>
    <div class="flex items-center justify-between mb-8">
        <h2 class="text-xs uppercase tracking-[0.2em] font-bold text-on-surface-variant">Pending Requests
        </h2>
        <span class="text-xs text-primary font-bold"><?= $friendCount ?> Notifications</span>
    </div>
    <div class="mb-10 grid grid-cols-1 lg:grid-cols-2 gap-3">

        <?php
        while ($friend = mysqli_fetch_assoc($result)) {
            $friendDetail = getUserDetail($conn, $friend['sender_uid']);
            ?>
            <!-- Request Card 1 -->
            <form data-sender-uid="<?= $friend['sender_uid'] ?>"
                class="userRequestCard bg-surface-container-high p-3 rounded-xl flex items-center justify-between group hover:bg-surface-variant transition-all duration-300">
                <div class="flex items-center gap-4 w-full">
                    <img alt="<?= $friendDetail['fullname'] ?>" class="w-14 h-14 rounded-lg object-cover transition-all"
                        src="<?= $friendDetail['profile_pic'] ?>" />
                    <div class="flex-1 w-0 min-w-0">
                        <h3 class="font-headline font-bold text-on-surface w-full truncate sm:whitespace-normal">
                            <?= $friendDetail['fullname'] ?>
                        </h3>
                    </div>
                </div>
                <div class="flex flex-wrap justify-content item-center md:flex-nowrap gap-2 md:mr-0 -mr-12">
                    <button
                        class="acceptBtn bg-primary-container text-on-primary-container px-4 py-2 rounded-lg text-xs font-bold hover:scale-[1.02] active:scale-95 transition-all">Accept</button>
                    <button
                        class="declineBtn bg-surface-container-highest text-on-surface px-4 py-2 rounded-lg text-xs font-bold border border-outline-variant hover:bg-error-container/20 hover:border-error-dim transition-all">Decline</button>
                </div>
            </form>


            <?php
        }
        ?>
    </div>
    <?php
}

?>