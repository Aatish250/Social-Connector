<?php
function getUserDetail($conn, $uid)
{
    $query = "SELECT * FROM users WHERE uid = ?";
    $stmt = mysqli_prepare($conn, $query);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $uid);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result && mysqli_num_rows($result) == 1) {
            return mysqli_fetch_assoc($result);
        }
    }

}

function getFriendList($conn, $uid)
{
    $query = "SELECT * FROM users
                WHERE uid != $uid
                AND uid IN (
                    SELECT sender_uid as friend_uid FROM friendships WHERE reciver_uid = $uid AND status = 'accepted'
                    UNION
                    SELECT reciver_uid as friend_uid FROM friendships WHERE sender_uid = $uid AND status = 'accepted'
                )";
    $result = mysqli_query($conn, $query);

    if ($result)
        return $result;
    else if (mysqli_num_rows($result) < 1)
        return 0;
}

function getConnectionStatus($conn, $uid, $target_uid)
{
    $query = "SELECT * FROM friendships WHERE (sender_uid = $uid AND reciver_uid = $target_uid) OR (sender_uid = $target_uid AND reciver_uid = $uid)";
    $result = mysqli_query($conn, $query);
    if ($result && $row = mysqli_fetch_assoc($result)) {
        return $row;
    }
    return null;
}

