<?php
// Assume $conn is already established elsewhere, otherwise establish it here.
header('Content-Type: application/json');

if (empty($_POST['email']) || empty($_POST['password'])) {
    $response = [
        "status" => 0,
        "message" => "Email and password are required.",
        "timmer" => 4
    ];
    echo json_encode($response);
    exit;
}

$email = $_POST['email'];
$password = $_POST['password'];

//connect to database
require_once(__DIR__ . "/../config/db.php");

// Prepare and bind to prevent SQL injection
$query = "SELECT uid, password FROM users WHERE email = ?";
$stmt = mysqli_prepare($conn, $query);
if ($stmt) {
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $db_uid = $row['uid'];
        $db_hashed_password = $row['password'];

        if (password_verify($password, $db_hashed_password)) {
            $response = [
                "status" => 1,
                "message" => "Logging in...",
                "timmer" => 4
            ];
            // Store user uid in session
            $_SESSION['uid'] = $db_uid;
        } else {
            $response = [
                "status" => 0,
                "message" => "Incorrect email or password.",
                "timmer" => 4
            ];
        }

    } else {
        $response = [
            "status" => 0,
            "message" => "Account not found.",
            "timmer" => 4
        ];
    }
    mysqli_stmt_close($stmt);
} else {
    $response = [
        "status" => 0,
        "message" => "Database error: " . mysqli_error($conn),
        "timmer" => 4
    ];
}

mysqli_close($conn);
header("Content-Type: application/json");
echo json_encode($response);
exit;