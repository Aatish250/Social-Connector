<?php

$required_fields = [
    "profile_pic" => "Profile picture",
    "fullname"    => "Full name",
    "email"       => "Email",
    "password"    => "Password",
    "location"    => "Location",
    "contact"     => "Contact",
    "dob"         => "Date of birth",
    "gender"      => "Gender"
];

include("form_verify.php");
formVerify($required_fields);


// Database connection
require_once(__DIR__ . '/../config/db.php');

// Check if email already exists (using mysqli procedural format)
$email_check = mysqli_real_escape_string($conn, $_POST["email"]);
$query = "SELECT uid FROM users WHERE email = '$email_check'";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $response = (object) [
        "status" => 0,
        "message" => "Email already exists.",
        "timmer" => 4
    ];
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
} elseif (!$result) {
    $response = (object) [
        "status" => 0,
        "message" => "Database error: " . mysqli_error($conn),
        "timmer" => 4
    ];
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}

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
    $response = [
        "status" => 0,
        "message" => "Invalid profile picture file type.",
        "timmer" => 7
    ];
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}

// To prevent overwriting, create a unique name for the uploaded file
$unique_name = uniqid("profile_", true) . '.' . $profile_pic_ext;
$target_file = $upload_dir . $unique_name;

if (!move_uploaded_file($profile_pic_tmp, $target_file)) {
    $response = [
        "status" => 0,
        "message" => "Failed to upload profile picture.",
        "timmer" => 7
    ];
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}


// Prepare fields
$fullname = mysqli_real_escape_string($conn, $_POST["fullname"]);
$email = mysqli_real_escape_string($conn, $_POST["email"]);
$password = $_POST["password"];
$hashed_password = password_hash($password, PASSWORD_DEFAULT);
$location = mysqli_real_escape_string($conn, $_POST["location"]);
$contact = isset($_POST["contact"]) ? mysqli_real_escape_string($conn, $_POST["contact"]) : '';
$dob = mysqli_real_escape_string($conn, $_POST["dob"]);
$gender = mysqli_real_escape_string($conn, $_POST["gender"]);
$profile_pic_path = 'uploads/' . $unique_name;

// Insert into database (assuming table `users` with corresponding columns)
$query = "INSERT INTO users (fullname, email, password, location, contact, dob, gender, profile_pic) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($conn, $query);
if ($stmt === false) {
    $response = [
        "status" => 0,
        "message" => "Database error: " . mysqli_error($conn),
        "timmer" => 7
    ];
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}

// contact is optional (can be empty string)
mysqli_stmt_bind_param($stmt, "ssssssss", $fullname, $email, $hashed_password, $location, $contact, $dob, $gender, $profile_pic_path);

if (mysqli_stmt_execute($stmt)) {
    $response = [
        "status" => 1,
        "message" => "Account created successfully.",
        "timmer" => 3.5,
        "email" => $email,
        "password" => $password
    ];
} else {
    $response = [
        "status" => 0,
        "message" => "Database error: " . mysqli_stmt_error($stmt),
        "timmer" => 7
    ];
}

mysqli_stmt_close($stmt);

// if (empty($_POST['email']) || empty($_POST['password'])) {
//     $email = "demo@email.com";
//     $password = "demo1234";
// } else {
//     $email = $_POST['email'];
//     $password = $_POST['password'];
// }

// $response = [
//         "status" => 1,
//         "message" => "Account created successfully.",
//         "timmer" => 3.5,
//         "email" => $email,
//         "password" => $password
//     ];

header('Content-Type: application/json');
echo json_encode($response);
exit;