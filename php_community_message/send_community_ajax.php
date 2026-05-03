<?php
require_once "../config/db.php";
require_once "../config/auth.php";
require_once "../class/class.CommunityMessage.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cid'], $_POST['content'])) {
    $uid = $_SESSION['uid'];
    $cid = (int) $_POST['cid'];
    $content = trim($_POST['content']);

    if (!empty($content)) {
        $commMsgObj = new CommunityMessage($conn, $uid);
        if ($commMsgObj->sendGroupMessage($cid, $content)) {
            echo "success";
        } else {
            echo "error";
        }
    }
}
?>