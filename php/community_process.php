<?php
require_once "../config/db.php";
require_once "../config/auth.php";
require_once "../class/class.Community.php";
isLoggedIn();
$uid = $_SESSION['uid'];

function response($message, $status = 1, $timmer = 3.5)
{
    header('Content-Type: application/json');
    return [
        "status" => $status,
        "message" => $message,
        "timmer" => $timmer
    ];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] == 'create') {
    $response = response("API called with POST method");
    
    $required_fields = [
        "comm-name" => "Community name",
        "comm-category" => "Category",
        "comm-location" => "Location"
    ];
    
    include("form_verify.php");
    formVerify($required_fields);
    
    
    
    $uid = $_SESSION['uid'];
    
    $name = mysqli_real_escape_string($conn, $_POST["comm-name"] ?? '');
    $category = mysqli_real_escape_string($conn, $_POST["comm-category"] ?? '');
    $location = mysqli_real_escape_string($conn, $_POST["comm-location"] ?? '');
    $description = isset($_POST["comm-info"]) ? mysqli_real_escape_string($conn, $_POST["comm-info"]) : '';
    
    $commData = [
        'name' => $name,
        'category' => $category,
        'location' => $location,
        'description' => $description
    ];
    
    $community = new Community($conn, $uid);
    $response = $community->create($commData, $_FILES['cover_image'] ?? null);
    
    header('Content-Type: application/json');
    echo json_encode($response);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] == 'update' && isset($_POST['cid'])) {
    $cid = intval($_POST['cid']);
    
    $required_fields = [
        "comm-name" => "Community name",
        "comm-category" => "Category",
        "comm-location" => "Location"
    ];
    
    include("form_verify.php");
    formVerify($required_fields);
    
    $name = mysqli_real_escape_string($conn, $_POST["comm-name"] ?? '');
    $category = mysqli_real_escape_string($conn, $_POST["comm-category"] ?? '');
    $location = mysqli_real_escape_string($conn, $_POST["comm-location"] ?? '');
    $description = isset($_POST["comm-info"]) ? mysqli_real_escape_string($conn, $_POST["comm-info"]) : '';
    
    $commData = [
        'name' => $name,
        'category' => $category,
        'location' => $location,
        'description' => $description
    ];
    
    $community = new Community($conn, $uid);
    $response = $community->update($cid, $commData, $_FILES['cover_image'] ?? null);
    
    header('Content-Type: application/json');
    echo json_encode($response);
    exit();
}

if($_SERVER['REQUEST_METHOD'] === "GET"){

    if(isset($_GET['action']) && $_GET['action'] == "join" && isset($_GET['cid'])){
        $cid = intval($_GET['cid']);
        // $response = response("Joining with to $cid");

        $community = new Community($conn, $uid);
        $response = $community->joinCommunity($cid, $uid);
    }
    
    if(isset($_GET['action']) && $_GET['action'] == "delete" && isset($_GET['cid'])){
        $cid = intval($_GET['cid']);
        $community = new Community($conn, $uid);
        $response = $community->deleteCommunity($cid);
    }

    if(isset($_GET['action']) && $_GET['action'] == "leave" && isset($_GET['cid'])){
        $cid = intval($_GET['cid']);
        $community = new Community($conn, $uid);
        $response = $community->leaveCommunity($cid, $uid);
    }

    echo json_encode($response);
    exit();
}

// header('Content-Type: application/json');
// echo json_encode($response);
// exit();