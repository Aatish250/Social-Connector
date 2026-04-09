<?php
function isLoggedIn()
{
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