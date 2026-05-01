<?php

// ========== DEGREE 1 ( User SESSION USER ID) ===============================
// $uid = $_SESSION['uid'];

// ========== DEGREE 2 ( Users Friend ) =======================
// $user_friend_IDs = getFriendListIDs($conn, $uid); // THis holds the ids of Users Friend lists || 2ND DEGREE ID RESULT
function getFriendListIDs($conn, $uid) // this is 2nd degree search
{
    $userFriendResult = getFriendList($conn, $uid);
    $userFriendCount = mysqli_num_rows($userFriendResult);
    $fIDs = [];

    if ($userFriendCount > 0)
        while ($row = mysqli_fetch_assoc($userFriendResult))
            $fIDs[] = $row['uid'];

    return $fIDs;
}


// ========== DEGREE 3 ( Friend of Users Friend || FOF ) ======
// $friends_of_users_friend_IDs = getFriendsOfFriendsIDs($conn, $uid); // THis holds the ids of friends of users friends || 3RD DEGREE ID RESULT
function getFriendsOfFriendsIDs($conn, $uid) // this is 3rd degree
{
    $user_friend_IDs = getFriendListIDs($conn, $uid);
    $friends_of_users_friend_IDs = [];

    // query to find if any requests send/recived ids are presernt
    $query = "SELECT sender_uid as pending_uid FROM friendships WHERE reciver_uid = $uid AND status = 'pending'
                UNION
                SELECT reciver_uid as pending_uid FROM friendships WHERE sender_uid = $uid AND status = 'pending'";
    $reqestedUidResult = mysqli_query($conn, $query);

    $requestedUids = []; // this holds the user which have recived or sended connection request

    if ($reqestedUidResult && mysqli_num_rows($reqestedUidResult) > 0)
        while ($row = mysqli_fetch_assoc($reqestedUidResult))
            $requestedUids[] = $row['pending_uid'];

    foreach ($user_friend_IDs as $ufID) { // 2ND DEGREE SEARCH
        $foufResult = getFriendList($conn, $ufID);
        $foufCount = mysqli_num_rows($foufResult);
        if ($foufCount > 0)
            while ($fouf_row = mysqli_fetch_assoc($foufResult)) { // 3rd DEGREE SEARCH
                // only select collection without: user's id, users friend id, and none usere who send/recives connection request
                if ($fouf_row['uid'] != $uid && !in_array($fouf_row['uid'], $user_friend_IDs) && !in_array($fouf_row['uid'], $requestedUids))
                    $friends_of_users_friend_IDs[] = $fouf_row['uid'];
            }
    }

    return array_unique($friends_of_users_friend_IDs); // collect distinct values only
}

/*
 FILTER OUT DEGREE 3 FROM 1ST DEGREE AND 2ND DEGREE VALUES
 HERE $uid is the head; 
 $user_friend_IDs are the visited/freinds; (Mutials)
 $fof_IDs are the freinds/next hop from each visite/friends head
*/



// ============ get mutual friends list ============
function getMutualsIDsFor($conn, $uid, $fof_id)
{
    $my_friend_IDs = getFriendListIDs($conn, $uid);
    $fof_friend_IDs = getFriendListIDs($conn, $fof_id);
    $mutual_IDs = [];

    foreach ($fof_friend_IDs as $fof_fID) {
        if (in_array($fof_fID, $my_friend_IDs)) {
            $mutual_IDs[] = $fof_fID;
        }
    }

    return $mutual_IDs;

}