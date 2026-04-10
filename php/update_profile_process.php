<?php

function response($message, $status = 1, $timmer = 3.5)
{
    return [
        "status" => $status,
        "message" => $message,
        "timmer" => $timmer
    ];
}

$response = response("Api Called");

// chaeck for valid inputs
$required_fields = [
    "fullname" => "Full name",
    "location" => "Location",
    "contact" => "Contact",
    "dob" => "Date of birth",
    "gender" => "Gender"
];

include("form_verify.php");
formVerify($required_fields);

// connect to database
require_once "../config/db.php";
require_once "../config/auth.php";
isLoggedIn();

// Prepare fields
$uid = $_SESSION['uid'];
$fullname = mysqli_real_escape_string($conn, $_POST["fullname"]);
$bio = mysqli_real_escape_string($conn, $_POST["bio"]);
$location = mysqli_real_escape_string($conn, $_POST["location"]);
$contact = isset($_POST["contact"]) ? mysqli_real_escape_string($conn, $_POST["contact"]) : '';
$bio = isset($_POST["bio"]) ? mysqli_real_escape_string($conn, $_POST["bio"]) : '';
$gender = mysqli_real_escape_string($conn, $_POST["gender"]);
$dob = isset($_POST["dob"]) && !empty($_POST["dob"]) ? mysqli_real_escape_string($conn, $_POST["dob"]) : date("Y-m-d");

// check for image
$hasImage = false;
$hasImage = (isset($_FILES['profile_pic']) && isset($_FILES['profile_pic']['name']) && !empty($_FILES['profile_pic']['name']));

if ($hasImage) {


    // Handle file upload for profile picture
    $upload_dir = __DIR__ . '/../uploads/';
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    $profile_pic_name = basename($_FILES["profile_pic"]["name"]);
    $profile_pic_tmp = $_FILES["profile_pic"]["tmp_name"];
    $profile_pic_ext = strtolower(pathinfo($profile_pic_name, PATHINFO_EXTENSION));
    $allowed_extensions = ["jpg", "jpeg", "png", "webp"];

    if (!in_array($profile_pic_ext, $allowed_extensions)) {
        $response = response("Invalid profile picture file type.", 0, 7);
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }

    $unique_name = uniqid("profile_", true) . '.' . $profile_pic_ext;
    $target_file = $upload_dir . $unique_name;

    if (!move_uploaded_file($profile_pic_tmp, $target_file)) {
        $response = response("Failed to upload profile picture.", 0, 7);
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }

    // Optionally unlink (delete) the old file
    $sql_old_pic = "SELECT profile_pic FROM users WHERE uid='$uid' LIMIT 1";
    $res_old_pic = mysqli_query($conn, $sql_old_pic);
    if ($res_old_pic && $row = mysqli_fetch_assoc($res_old_pic)) {
        $old_pic = $row['profile_pic'];
        if ($old_pic && file_exists(__DIR__ . '/../' . $old_pic)) {
            unlink(__DIR__ . '/../' . $old_pic);
        }
    }

    $new_pic_rel_path = 'uploads/' . $unique_name;
    $query = "UPDATE users 
        SET fullname = '$fullname', bio = '$bio', location = '$location', contact = '$contact', dob = '$dob', gender = '$gender', profile_pic = '$new_pic_rel_path' 
        WHERE uid = '$uid' LIMIT 1";
} else {
    $query = "UPDATE users 
        SET fullname = '$fullname', bio = '$bio', location = '$location', contact = '$contact', dob = '$dob', gender = '$gender' 
        WHERE uid = '$uid' LIMIT 1";
}

if (mysqli_query($conn, $query)) {
    $response = response("Profile updated successfully.", 1, 3.5);
} else {
    $response = response("Failed to update. " . mysqli_error($conn), 0, 7);
}
// $response = response($query, 1, 30);

header('Content-Type: application/json');
echo json_encode($response);
exit();
