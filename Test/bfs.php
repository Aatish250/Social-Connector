<?php
function getUserColumn($conn, $uid, $column)
{
    $userInfo = getUserDetail($conn, $uid);
    return $userInfo[$column];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link rel="stylesheet" href="main.css">
    <title>Document</title>
</head>

<body class="bg-black text-white">

    <?php

    require "../config/db.php";
    require "../config/auth.php";

    $uid = $_SESSION['uid'];

    $user = getUserDetail($conn, $uid);

    $fid = 2;
    $userFriendResult = getFriendList($conn, $uid);
    $userFriendCount = mysqli_num_rows($userFriendResult);
    if ($userFriendCount > 0) {
        while ($row = mysqli_fetch_assoc($userFriendResult))
            $userFriendLists[] = $row;
    }

    ?>

    <!-- User Information -->
    <details class="m-3 border-2 border-gray-500">

        <summary class="p-2"><b>$user Information:</b></summary>

        <pre class="m-2 border-2 border-gray-600 p-2">
        <?= var_dump($user) ?>
    </pre>
    </details>

    <!-- users friend list information -->
    <details class="m-3 border-2 border-gray-500">

        <summary class="p-2"><b>$userFriendLists Information:</b></summary>

        <?php foreach ($userFriendLists as $userFriend) { ?>

            <details class="ml-2">

                <summary>$user Friends Ids: <?= $userFriend['fullname'] ?></summary>

                <pre class="m-2 border-2 border-gray-600 p-2">
                                                                                                                                                                                                                                        <?= var_dump($userFriend) ?>
                                                                                                                                                                                                                                    </pre>
            </details>

        <?php } ?>
    </details>

    <?php
    echo "<span class='text-green-500'>";
    echo "<br>DEGREE 1: <br>";
    echo $uid . " - " . getUserColumn($conn, $uid, "fullname");
    echo "<br>";
    echo "</span>";



    echo "<span class='text-amber-500'>";
    echo "<br>DEGREE 2: <br>";
    // echo implode(', ', array_column($userFriendLists, 'uid'));
    foreach ($userFriendLists as $ufl)
        echo " ( " . $ufl['uid'] . " - " . getUserColumn($conn, $ufl['uid'], "fullname") . " )";
    echo "<br>";
    echo "</span>";
    ?>

    <?php

    $fouf_ID = [];

    $ufl_ID = [];
    foreach ($userFriendLists as $ufl)
        $ufl_ID[] = $ufl['uid'];

    echo "<br>DEGREE 3: <br>";
    foreach ($userFriendLists as $ufl) { // search for 2nd degree friend
        echo $ufl['fullname'] . " ==> ";

        $friendsOfUserFriendResult = getFriendList($conn, $ufl['uid']);
        $friendOfUserFriendCount = mysqli_num_rows($friendsOfUserFriendResult);
        if ($friendOfUserFriendCount > 0) {
            while ($fouf = mysqli_fetch_assoc($friendsOfUserFriendResult)) {

                if ($fouf['uid'] == $uid) {
                    $color = "text-green-500";
                } elseif (in_array($fouf['uid'], $ufl_ID)) {
                    $color = "text-amber-500";
                } else {
                    $color = "";
                }

                echo "<span class='$color'> ( " . $fouf['uid'] . " - " . getUserColumn($conn, $fouf['uid'], "fullname") . " )</span>";

                if ($fouf['uid'] != $uid && !in_array($fouf['uid'], $ufl_ID))
                    $fouf_ID[] = $fouf['uid'];
            }
        }

        echo "<br>";
    }
    ?>

    <?php
    // Shuffle the unique IDs so the output is random every time
    // $unique_fouf_IDs = array_unique($fouf_ID);
    // shuffle($unique_fouf_IDs);
    // echo implode(",", $unique_fouf_IDs);

    echo "<br>Show Degree 3 Clear:<br>";
    $unique_fouf_ID = array_unique($fouf_ID);
    echo implode(",", $unique_fouf_ID);
    echo "<br>";
    foreach($unique_fouf_ID as $fof){
        $fofname = getUserColumn($conn, $fof, "fullname");
        echo " ( $fof - $fofname ) ";
    }

    ?>

</body>

</html>