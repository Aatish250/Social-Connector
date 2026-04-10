<?php

if (isset($_GET['logout']) && $_GET['logout'] === "logout") {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    session_unset();
    session_destroy();
    header("Location: ../login.php");
    exit();
}

function isLoggedIn()
{
    // Prevent the browser from caching this page
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
    
    if (!isset($_SESSION['uid'])) {
        header("Location: login.php");
        exit();
    }
}

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
