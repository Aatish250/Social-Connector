<?php
// function r($message, $status = 1) { return ['status' => $status, 'message' => $message]; }
require_once '../config/db.php';

$name = isset($_POST['searchInput']) ? trim(htmlspecialchars($_POST['searchInput'], ENT_QUOTES, 'UTF-8')) : '';
$userLimit = isset($_POST['userLimit']) ? $_POST['userLimit'] : 4;

$query = "SELECT * FROM users WHERE fullname LIKE '%$name%' LIMIT $userLimit";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 1) {
    // echo $query . "<br>";
    // More than 1 user found
    while ($foundUser = mysqli_fetch_assoc($result)) {
        // echo $user['fullname'] . "<br>";
        echo "
            <div
                    class='flex flex-col items-center text-center p-8 bg-surface-container-high rounded-2xl border border-transparent hover:border-outline-variant/20 transition-all group'>
                    <div class='relative mb-4'>
                        <img alt='" . $foundUser['fullname'] . "'
                            class='w-24 h-24 rounded-full object-cover p-1 border-2 border-primary/20 group-hover:border-primary transition-all'
                            src='" . $foundUser['profile_pic'] . "' />
                    </div>
                    <h3 class='font-headline font-bold text-lg text-on-surface mb-6'>" . $foundUser['fullname'] . "</h3>
                    <button
                        class='w-full bg-surface-variant text-on-surface py-3 rounded-lg text-xs font-bold hover:bg-primary hover:text-on-primary-container transition-all'>Connect</button>
                </div>
        ";
    }
} else {
    echo "No user found";
}
// $response = r($query);

// header("Content-Type: applicaton.json");
// echo json_encode($response);

exit;
