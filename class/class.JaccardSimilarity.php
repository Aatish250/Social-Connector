<?php
class JaccardSimilarity
{
    private $conn;
    private $uid;

    public function __construct($conn, $uid)
    {
        $this->conn = $conn;
        $this->uid = $uid;
    }

    /**
     * Fetches community IDs for a specific user using MySQLi
     */
    public function getUserCommunities($targetUid)
    {
        $cids = [];
        $sql = "SELECT cid FROM community_members WHERE uid = $targetUid";
        $result = $this->conn->query($sql);

        while ($row = $result->fetch_assoc()) {
            $cids[] = $row['cid'];
        }
        return $cids;
    }

    /**
     * The Core Jaccard Logic (Sets comparison)
     */
    public function calculateScore($setA, $setB)
    {
        if (empty($setA) && empty($setB))
            return 0;

        // Intersection: Items present in BOTH sets
        $intersection = array_intersect($setA, $setB);
        // Union: All unique items from BOTH sets combined
        $union = array_unique(array_merge($setA, $setB));

        return count($intersection) / count($union);
    }

    /**
     * Compares logged-in user with all other users
     */
    public function getSimilarityScores()
    {
        $myCommunities = $this->getUserCommunities($this->uid);
        $scores = [];

        // Fetch all other users who have joined at least one community
        $sql = "SELECT DISTINCT uid FROM community_members WHERE uid != " . $this->uid;
        $result = $this->conn->query($sql);

        while ($row = $result->fetch_assoc()) {
            $otherUid = $row['uid'];
            $otherCommunities = $this->getUserCommunities($otherUid);

            $score = $this->calculateScore($myCommunities, $otherCommunities);

            // Only keep users who have at least something in common
            if ($score > 0) {
                $scores[$otherUid] = $score;
            }
        }

        arsort($scores); // Sort: highest score (1.0) to lowest
        return $scores;
    }

    /**
     * Final Suggestion Logic
     */
    public function suggestCommunities($limit = 4)
    {
        $myCommunities = $this->getUserCommunities($this->uid);
        $scores = $this->getSimilarityScores();
        $recommendations = [];

        foreach ($scores as $otherUid => $score) {
            $theirCommunities = $this->getUserCommunities($otherUid);

            // Get communities the other user is in, but I am NOT
            $newOnes = array_diff($theirCommunities, $myCommunities);

            foreach ($newOnes as $cid) {
                if (!in_array($cid, $recommendations)) {
                    $recommendations[] = $cid;
                }
                if (count($recommendations) >= $limit)
                    break 2;
            }
        }

        return $recommendations;
    }
}