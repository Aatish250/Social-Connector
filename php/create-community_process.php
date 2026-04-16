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

$required_fields = [
    "comm-name" => "Community name",
    "comm-category" => "Category",
    "comm-location" => "Location"
];

include("form_verify.php");
formVerify($required_fields);

require_once "../config/db.php";
require_once "../config/auth.php";
isLoggedIn();

$uid = $_SESSION['uid'];
$name = mysqli_real_escape_string($conn, $_POST["comm-name"]);
$category = mysqli_real_escape_string($conn, $_POST["comm-category"]);
$location = mysqli_real_escape_string($conn, $_POST["comm-location"]);
$description = isset($_POST["comm-info"]) ? mysqli_real_escape_string($conn, $_POST["comm-info"]) : '';

// Handle cover image upload
$cover_image = '';
$hasImage = isset($_FILES['cover_image']) && isset($_FILES['cover_image']['name']) && !empty($_FILES['cover_image']['name']);

if ($hasImage) {
    $upload_dir = __DIR__ . '/../uploads/communities/';
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    $cover_name = basename($_FILES["cover_image"]["name"]);
    $cover_tmp = $_FILES["cover_image"]["tmp_name"];
    $cover_ext = strtolower(pathinfo($cover_name, PATHINFO_EXTENSION));
    $allowed_extensions = ["jpg", "jpeg", "png", "webp"];

    if (!in_array($cover_ext, $allowed_extensions)) {
        $response = response("Invalid cover image file type.", 0, 7);
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }

    $unique_name = uniqid("community_", true) . '.' . $cover_ext;
    $target_file = $upload_dir . $unique_name;

    if (!move_uploaded_file($cover_tmp, $target_file)) {
        $response = response("Failed to upload cover image.", 0, 7);
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }

    $cover_image = 'uploads/communities/' . $unique_name;
}

$query = "INSERT INTO communities (name, category, location, description, cover_image, created_by)
          VALUES ('$name', '$category', '$location', '$description', '$cover_image', '$uid')";

if (mysqli_query($conn, $query)) {
    $cid = $conn->insert_id;
    $member_query = "INSERT INTO community_members (uid, cid, role) VALUES ('$uid', '$cid', 'owner')";
    mysqli_query($conn, $member_query);
    $response = response("Community created successfully.", 1, 3.5);
} else {
    $response = response("Failed to create community. " . mysqli_error($conn), 0, 7);
}

header('Content-Type: application/json');
echo json_encode($response);
exit();