<?php
require_once "../config/db.php";
require_once "../config/auth.php";
require_once "../class/class.Message.php";

if (isset($_POST['receiver_id']) && !empty($_POST['content'])) {
    $msgObj = new Message($conn, $_SESSION['uid']);
    $success = $msgObj->sendMessage((int) $_POST['receiver_id'], $_POST['content']);
    echo $success ? "success" : "error";
}