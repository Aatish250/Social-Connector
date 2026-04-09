<?php
function formVerify($required_fields) {
    
    $missing_fields = [];
    
    foreach ($required_fields as $key => $label) {
        // TODO: if reused for community creation add $key === "community_pic"
        if ($key === "profile_pic") {
            if (!isset($_FILES["profile_pic"]) || $_FILES["profile_pic"]["error"] === UPLOAD_ERR_NO_FILE) {
                $missing_fields[] = $label;
            }
        } else {
            if (empty($_POST[$key])) {
                $missing_fields[] = $label;
            }
        }
    }
    
    if (!empty($missing_fields)) {
        $message = "The following field(s) are required: " . implode(", ", $missing_fields) . ".";
        $response = [
            "status" => 0,
            "message" => $message,
            "timmer" => 10
        ];
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }
}
?>