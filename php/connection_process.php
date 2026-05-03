<?php
require_once "../config/db.php";
require_once "../config/auth.php";
isLoggedIn();

$uid = $_SESSION['uid'];

function sendResponse($message, $status = 1, $timmer = 3.5)
{
    header("Content-Type: application/json");
    echo json_encode(['message' => $message, 'status' => $status, 'timmer' => $timmer]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $target_uid = intval($_POST['target_uid'] ?? 0);

    if (!$target_uid) {
        sendResponse("Invalid user", 0);
    }

    if ($action === 'send') {
        $query = "SELECT * FROM friendships WHERE (sender_uid = $uid AND reciver_uid = $target_uid) OR (sender_uid = $target_uid AND reciver_uid = $uid)";
        $result = mysqli_query($conn, $query);
        $isFriend = mysqli_fetch_assoc($result);

        if (!$isFriend) {
            $query = "INSERT INTO friendships (sender_uid, reciver_uid, status) VALUES ($uid, $target_uid, 'pending')";
            if (mysqli_query($conn, $query)) sendResponse("Connection request sent");
        } else if (in_array($isFriend['status'], ['declined', 'cancelled'])) {
            $query = "UPDATE friendships SET sender_uid = $uid, reciver_uid = $target_uid, status = 'pending' WHERE id = " . $isFriend['id'];
            if (mysqli_query($conn, $query)) sendResponse("Connection request sent");
        }
        sendResponse("Failed to send request", 0);
    }

    if ($action === 'accept') {
        $query = "UPDATE friendships SET status = 'accepted' WHERE sender_uid = $target_uid AND reciver_uid = $uid AND status = 'pending'";
        if (mysqli_query($conn, $query)) sendResponse("Connection request accepted");
        sendResponse("Failed to accept request", 0);
    }

    if ($action === 'decline') {
        $query = "UPDATE friendships SET status = 'declined' WHERE sender_uid = $target_uid AND reciver_uid = $uid AND status = 'pending'";
        if (mysqli_query($conn, $query)) sendResponse("Connection request declined");
        sendResponse("Failed to decline request", 0);
    }

    if ($action === 'cancel') {
        $query = "UPDATE friendships SET status = 'cancelled' WHERE sender_uid = $uid AND reciver_uid = $target_uid AND status = 'pending'";
        if (mysqli_query($conn, $query)) sendResponse("Connection request cancelled");
        sendResponse("Failed to cancel request", 0);
    }

    if ($action === 'remove') {
        $query = "UPDATE friendships SET status = 'cancelled' WHERE (sender_uid = $uid AND reciver_uid = $target_uid OR sender_uid = $target_uid AND reciver_uid = $uid) AND status = 'accepted'";
        if (mysqli_query($conn, $query)) sendResponse("Connection removed");
        sendResponse("Failed to remove connection", 0);
    }
}

sendResponse("Invalid action", 0);
