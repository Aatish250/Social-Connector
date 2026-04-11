<?php
function send($message, $status = 1)
{
    header("Content-Type: application/json");
    echo json_encode(['message' => $message, 'status' => $status]);
    exit;
}

require_once "../config/db.php";

$reciver_uid = $_POST['reciver_uid'];
$uid = $_SESSION['uid'];

$query = "SELECT * FROM friendships WHERE (sender_uid = $uid AND reciver_uid = $reciver_uid) OR (sender_uid = $reciver_uid AND reciver_uid = $uid)";
$result = mysqli_query($conn, $query);
$isFriend = mysqli_fetch_assoc($result);

if (!$isFriend) { // if the card has never had connection

    $status = 'pending';
    $query = "INSERT INTO friendships (sender_uid, reciver_uid, status) VALUES ($uid, $reciver_uid, '$status')";

    $result = mysqli_query($conn, $query) ? "Connection Request Sended" : "Failed";

    send($result, 1);

} else if ($isFriend['status'] == "declined") { // if the card has declined connection update 

    $status = 'pending';

    $query = "UPDATE friendships SET status = '$status' WHERE id = " . $isFriend['id'];

    $result = mysqli_query($conn, $query) ? "Connection Request Sended" : "Failed";

    send($result, 1);
}
send("Error", 0);


exit;


