<?php
function send($message, $status = 1)
{
    header("Content-Type: application/json");
    echo json_encode(['message' => $message, 'status' => $status]);
    exit;
}

require_once '../config/db.php';
require_once '../config/auth.php';


$uid = $_SESSION['uid'];
$name = isset($_POST['searchInput']) ? trim(htmlspecialchars($_POST['searchInput'], ENT_QUOTES, 'UTF-8')) : '';
$userLimit = isset($_POST['userLimit']) ? $_POST['userLimit'] : 4;


// query users which is not friend with them
$query = "SELECT * FROM users
            WHERE fullname LIKE '%$name%' 
            AND uid != $uid
            AND uid NOT IN (
            -- Get IDs where User 1 is the sender and status is (pending. accepted)
                SELECT reciver_uid FROM friendships WHERE sender_uid = $uid AND status IN ('accepted', 'pending')
                UNION
                -- Get IDs where User 1 is the receiver and status is (pending. accepted)
                SELECT sender_uid FROM friendships WHERE reciver_uid = $uid AND status IN ('accepted', 'pending')
            ) LIMIT $userLimit";

// $query = "SELECT u.*, IFNULL(selected_user.status, '') as friendship_status 
//         FROM users As u
//         left join (
//             select reciver_uid as selUid, status from friendships where sender_uid = 1
//             UNION
//             select sender_uid as selUid, status from friendships where sender_uid = 1
//         ) as selected_user
//         on u.uid = selected_user.selUid
//         where u.uid != 1
//         and u.uid not in (
//             select reciver_uid from friendships where sender_uid = 1 and STATUS = 'accepted'
//             UNION
//             select sender_uid from friendships where reciver_uid = 1 and status = 'accepted'
//         )";

$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 1) {
    while ($foundUser = mysqli_fetch_assoc($result)) {

        echo "
            <form data-uid='" . $foundUser['uid'] . "'
                class='searchUserCard flex flex-col items-center text-center p-8 bg-surface-container-high rounded-2xl border border-transparent hover:border-outline-variant/20 transition-all group'>
                <div class='relative mb-4'>
                    <img alt='" . $foundUser['fullname'] . "'
                        class='w-24 h-24 rounded-full object-cover p-1 border-2 border-primary/20 group-hover:border-primary transition-all'
                        src='" . $foundUser['profile_pic'] . "' />
                </div>
                <h3 class='font-headline font-bold text-lg text-on-surface mb-6'>" . $foundUser['fullname'] . "</h3>
                <button
                    class='w-full bg-surface-variant text-on-surface py-3 rounded-lg text-xs font-bold hover:bg-primary hover:text-on-primary-container transition-all'>
                    Connect
                    </button>
            </form>
        ";
    }
} else
    echo "";


// $friendsResult = getUsersFriends($conn, $uid);
// $data = implodeQueryREsult($friendsResult, "uid");
// send($data);

exit;
