<?php
function isLoggedIn()
{
    if (!isset($_SESSION['uid'])) {
        header("Location: login.php");
        exit();
    }
}