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
    <title>Document</title>
</head>

<body class="bg-black text-white">

    <?php

    require_once "../config/db.php";
    require_once "../config/auth.php";
    require_once "../func/func_user.php";
    require_once "../class/class.JaccardSimilarity.php";
    isLoggedIn();

    $uid = $_SESSION['uid'];

    $target_uid = isset($_GET['target_uid']) ? (int) $_GET['target_uid'] : 1;
    $other_uid = isset($_GET['other_uid']) ? (int) $_GET['other_uid'] : 1;
    $uid = $target_uid;
    $jaccard = new JaccardSimilarity($conn, $uid);

    ?>

    <!-- Simple Input Form -->
    <form method="GET" action="">
        <label for="target_uid"><strong>Test User ID:</strong></label>
        <input type="number" name="target_uid" id="uid" value="<?= $target_uid ?>" min="1"
            class="bg-gray-300 p-2 text-black">
        <input type="number" name="other_uid" id="uid" value="<?= $other_uid ?>" min="1"
            class="bg-gray-300 p-2 text-black">
        <button type="submit" class="bg-gray-400 p-2 text-black">Visualize Data</button>
    </form>
    <br>


    <span class='text-gray-400'>;
        <pre>
    <b>Main User-<?= $uid ?> => getUserCommunities(<?= $target_uid ?>):</b>
<?= showIds($jaccard->getUserCommunities($target_uid)) ?>

    <b>Next User-<?= $other_uid ?> => getUserCommunities(<?= $other_uid ?>):</b>
<?= showIds($jaccard->getUserCommunities($other_uid)) ?>
<hr>
    <b>User-<?= $uid ?> => calculateScore(<?= $target_uid ?>, <?= $other_uid ?>):</b>
<?= var_dump($jaccard->calculateScore($jaccard->getUserCommunities($target_uid), $jaccard->getUserCommunities($other_uid))) ?>
<hr>
    <b>User-<?= $uid ?> => getSimilarityScores();</b>
<?= showIdsPairs($jaccard->getSimilarityScores()) ?>
<hr>
<b>User-<?= $uid ?> => suggestCommunities();</b>
<?= showIds($jaccard->suggestCommunities(10)) ?>
<hr>
    </pre>
    </span>;
    <hr>

    <?php
    echo "<br><b>Jaccard Collaborative Filtering (Based on joined Communities)</b>";
    echo "<br> - This algorithm finds your 'Interest Twins' by comparing the communities you joined against others.";
    echo "<br> - <b>Similarity Score:</b> It calculates the (Common Communities) divided by the (Total Unique Communities combined).";
    echo "<br> - <b>The Logic:</b> If a highly similar user is in a group that you aren't, we suggest that group to you.";
    echo "<br> - <i>Theoretical Process: Match Users → Rank by Score → Identify Missing Groups → Recommend.</i><br><br>";
    function suggestCommunities($conn, $uid, $limit = 10)
    {
        $jsim = new JaccardSimilarity($conn, $uid);
        $myCommunities = $jsim->getUserCommunities($uid);
        $scores = $jsim->getSimilarityScores();
        $recommendations = [];

        echo "<pre>My Communities: ";
        echo showids($myCommunities);
        echo "<br>";
        echo "Score: ";
        echo showIdsPairs($scores);
        echo "</pre>";
        echo "<br>";
        foreach ($scores as $otherUid => $score) {
            echo "<span class='text-yellow-200'>";
            echo "<br>User - $otherUid";
            echo "<br>Score - " . $score;
            echo "</span>";
            $theirCommunities = $jsim->getUserCommunities($otherUid);
            echo "<br>Their Community: ";
            echo showIds($theirCommunities);

            echo "<span class='text-red-300'>";
            $intersection = array_intersect($theirCommunities, $myCommunities);
            echo "<br> Both Have: ";
            echo showIds($intersection);
            echo "</span>";

            echo "<span class='text-gray-500'>";
            $execlusive = array_diff($myCommunities, $theirCommunities);
            echo "<br> They Dont have: ";
            echo showIds($execlusive);
            echo "</span>";

            // Get communities the other user is in, but I am NOT
            echo "<span class='text-green-400'>";
            $newOnes = array_diff($theirCommunities, $myCommunities);
            echo "<br> I dont have: ";
            echo showIds($newOnes);
            echo "</span>";

            $union = array_unique(array_merge($theirCommunities, $myCommunities));
            echo "<br> Joint Community: ";
            echo showIds($union);

            echo "<span class='text-green-300'>";
            echo "<br> [";

            foreach ($newOnes as $cid) {
                if (!in_array($cid, $recommendations)) {
                    $recommendations[] = $cid;
                    echo " -- Recomended: $cid";
                }
                if (count($recommendations) >= $limit)
                    break 2;
            }
            echo " ]<br>";
            echo "</span>";

            echo "<span class='text-amber-400'><b>Score:</b> <i>Both Have / Joint Community => Intersection / Union => ";
            echo showIds($intersection) . " / " . showIds($union) . " => ";
            echo count($intersection) . " / " . count($union) . " = " . count($intersection) / count($union);
            echo "</i><br></span>";
        }
        echo "<br>Total Recomendation: " . showIds($recommendations);

        echo "<br><br><hr> Result for suggestCommunities() : <br>";
        return $recommendations;
    }
    echo showIds(suggestCommunities($conn, $target_uid));

    function showIds($arrs)
    {
        return "(" . implode(", ", $arrs) . ")";

    }
    function showIdsPairs($arrs)
    {
        $pairs = [];
        foreach ($arrs as $k => $v) {
            $pairs[] = "<br>$k => $v";
        }
        $out = implode(", ", $pairs);
        return $out;
    }
    ?>
</body>

</html>