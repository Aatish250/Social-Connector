<?php

require_once __DIR__ . "/class.JaccardSimilarity.php";
class Community
{
    private $conn;
    private $uid;
    public $details = []; // Stores fetched data

    public function __construct($conn, $uid = null)
    {
        $this->conn = $conn;
        $this->uid = $uid;
    }

    // --- ACTION: CREATE A COMMUNITY ---
    public function create($data, $file = null)
    {
        $name = mysqli_real_escape_string($this->conn, $data['name']);
        $category = mysqli_real_escape_string($this->conn, $data['category']);
        $location = mysqli_real_escape_string($this->conn, $data['location']);
        $description = mysqli_real_escape_string($this->conn, $data['description'] ?? '');

        $cover_image = $this->handleUpload($file);

        $query = "INSERT INTO communities (name, category, location, description, cover_image, created_by)
                  VALUES ('$name', '$category', '$location', '$description', '$cover_image', '{$this->uid}')";

        if (mysqli_query($this->conn, $query)) {
            $cid = $this->conn->insert_id;
            // Add owner to members table
            $member_query = "INSERT INTO community_members (uid, cid, role) VALUES ('{$this->uid}', '$cid', 'owner')";
            mysqli_query($this->conn, $member_query);
            return ["status" => 1, "message" => "Community created successfully."];
        }
        return ["status" => 0, "message" => "DB Error: " . mysqli_error($this->conn)];
    }

    // --- ACTION: FETCH COMMUNITY BY ID ---
    public function getCommunity($cid)
    {
        $cid = mysqli_real_escape_string($this->conn, $cid);
        $query = "SELECT * FROM communities WHERE cid = '$cid'";
        $result = mysqli_query($this->conn, $query);

        if ($row = mysqli_fetch_assoc($result)) {
            $this->details = $row;
            return $row;
        }
        return null;
    }

    private function getMyCommunitiesIds()
    {
        $uid = $this->uid;
        $myCids = [];

        $query = "SELECT * FROM communities WHERE created_by = '$uid'";
        $result = mysqli_query($this->conn, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            $myCids[] = $row['cid'];
        }
        return $myCids;
    }

    // --- ACTION: SUGGEST COMMUNITIES NOT INTERSECTING WITH RECOMMENDED ---
    // Provide communities that do not overlap with the recommended from suggestCommunities
    public function getCommunitiesNotInSuggestions($limit = 4)
    {

        $algo = new JaccardSimilarity($this->conn, $this->uid);
        // Get the IDs from suggestCommunities (recommended)
        $JCsuggested = $algo->suggestCommunities($limit);

        $suggestedIds = [];

        foreach ($JCsuggested as $cid) {
            $suggestedIds[] = intval($cid);
        }

        foreach ($this->getMyCommunitiesIds() as $myCids) {
            $suggestedIds[] = intval($myCids);
        }

        // Make a comma-separated list for SQL query, or "NULL" for empty array
        $excludeList = !empty($suggestedIds) ? implode(',', $suggestedIds) : NULL;

        $uid = mysqli_real_escape_string($this->conn, $this->uid);
        $limit = intval($limit);

        // 1. Create your base query string
        $query = "SELECT * FROM communities";

        // 2. Conditionally append the WHERE clause if the array isn't empty
        if (!empty($suggestedIds)) {
            // Sanitize the array values to protect against SQL Injection
            $sanitizedIds = array_map('intval', $suggestedIds);
            $excludeList = implode(',', $sanitizedIds);

            $query .= " WHERE cid NOT IN ($excludeList)";
        }

        // 3. Append the limit at the very end
        $query .= " LIMIT $limit";

        $result = mysqli_query($this->conn, $query);
        $communities = [];
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $communities[] = $row['cid'];
            }
        }
        // Shuffle the communities before returning
        shuffle($communities);
        return $communities;

    }

    // --- ACTION: UPDATE A COMMUNITY ---
    public function update($cid, $data, $file = null)
    {
        $cid = mysqli_real_escape_string($this->conn, $cid);
        $name = mysqli_real_escape_string($this->conn, $data['name']);
        $category = mysqli_real_escape_string($this->conn, $data['category']);
        $location = mysqli_real_escape_string($this->conn, $data['location']);
        $description = mysqli_real_escape_string($this->conn, $data['description'] ?? '');

        // Check if user is the owner
        $owner_query = "SELECT created_by FROM communities WHERE cid = '$cid'";
        $owner_res = mysqli_query($this->conn, $owner_query);
        $owner_row = mysqli_fetch_assoc($owner_res);
        if (!$owner_row || $owner_row['created_by'] != $this->uid) {
            return ["status" => 0, "message" => "Unauthorized: Only the creator can edit this community."];
        }

        $update_image_sql = "";
        if ($file && !empty($file['name'])) {
            $cover_image = $this->handleUpload($file);
            if ($cover_image) {
                $update_image_sql = ", cover_image = '$cover_image'";
            }
        }

        $query = "UPDATE communities SET 
                  name = '$name', 
                  category = '$category', 
                  location = '$location', 
                  description = '$description'
                  $update_image_sql
                  WHERE cid = '$cid'";

        if (mysqli_query($this->conn, $query)) {
            return ["status" => 1, "message" => "Community updated successfully."];
        }
        return ["status" => 0, "message" => "DB Error: " . mysqli_error($this->conn)];
    }

    // --- ACTION: DELETE A COMMUNITY ---
    public function deleteCommunity($cid)
    {
        $cid = mysqli_real_escape_string($this->conn, $cid);

        // Ensure the community exists and fetch its data
        $query = "SELECT * FROM communities WHERE cid = '$cid'";
        $result = mysqli_query($this->conn, $query);

        if (!$result || mysqli_num_rows($result) == 0) {
            return ["status" => 0, "message" => "Community not found."];
        }

        $community = mysqli_fetch_assoc($result);

        // Check if user is the owner
        if ($community['created_by'] != $this->uid) {
            return ["status" => 0, "message" => "Unauthorized: Only the creator can delete this community."];
        }

        // Delete cover image if exists
        if (!empty($community['cover_image'])) {
            $this->handelDeleteUploads($community['cover_image']);
        }

        // Because ON DELETE CASCADE is set, deleting from communities will automatically clean up associated rows
        $del_comm = "DELETE FROM communities WHERE cid = '$cid'";
        if (mysqli_query($this->conn, $del_comm)) {
            return ["status" => 1, "message" => "Community deleted successfully."];
        } else {
            return ["status" => 0, "message" => "DB Error: " . mysqli_error($this->conn)];
        }
    }


    // --- ACTION: LEAVE A COMMUNITY ---
    public function leaveCommunity($cid, $uid)
    {
        $cid = mysqli_real_escape_string($this->conn, $cid);
        $uid = mysqli_real_escape_string($this->conn, $uid);

        // Get member's current role
        $get_role_query = "SELECT role FROM community_members WHERE cid = '$cid' AND uid = '$uid'";
        $res = mysqli_query($this->conn, $get_role_query);

        if (!$res || mysqli_num_rows($res) == 0) {
            return ["status" => 0, "message" => "Not a member of this community."];
        }

        $member = mysqli_fetch_assoc($res);

        // Prevent owners from leaving their own community
        if ($member['role'] === "owner") {
            return ["status" => 0, "message" => "Community owners cannot leave the community. Delete the community instead."];
        }

        // Remove the user from the community_members table
        $delete_query = "DELETE FROM community_members WHERE cid = '$cid' AND uid = '$uid'";
        if (mysqli_query($this->conn, $delete_query)) {
            return ["status" => 1, "message" => "You have left the community."];
        } else {
            return ["status" => 0, "message" => "DB Error: " . mysqli_error($this->conn)];
        }
    }

    // Helper to delete uploaded images/files
    private function handelDeleteUploads($filepath)
    {
        // $filepath is expected to be a path like 'uploads/communities/filename.ext'
        $fullpath = dirname(__DIR__) . "/" . $filepath;
        if (file_exists($fullpath) && is_file($fullpath)) {
            @unlink($fullpath);
        }
    }

    // Private helper to handle the image logic
    private function handleUpload($file)
    {
        if (!$file || empty($file['name']))
            return '';

        $upload_dir = __DIR__ . '/../uploads/communities/';
        if (!file_exists($upload_dir))
            mkdir($upload_dir, 0777, true);

        $ext = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));
        if (!in_array($ext, ["jpg", "jpeg", "png", "webp"]))
            return '';

        $unique_name = uniqid("community_", true) . '.' . $ext;
        if (move_uploaded_file($file["tmp_name"], $upload_dir . $unique_name)) {
            return 'uploads/communities/' . $unique_name;
        }
        return '';
    }

    public function joinCommunity($cid, $uid)
    {
        $cid = mysqli_real_escape_string($this->conn, $cid);
        $uid = mysqli_real_escape_string($this->conn, $uid);

        // Check if user already a member
        $check_query = "SELECT role FROM community_members WHERE cid = '$cid' AND uid = '$uid' LIMIT 1";
        $res = mysqli_query($this->conn, $check_query);

        if ($row = mysqli_fetch_assoc($res)) {
            // Already a member, ensure role is at least 'member'
            $role = $row['role'] ?? 'member';
            // If role is not set to 'member', update to member
            if ($role !== 'member') {
                $update_query = "UPDATE community_members SET role = 'member' WHERE cid = '$cid' AND uid = '$uid'";
                mysqli_query($this->conn, $update_query);
            }
            return ["status" => 1, "message" => "Already a member."];
        } else {
            // Not a member, insert as member
            $insert_query = "INSERT INTO community_members (uid, cid, role) VALUES ('$uid', '$cid', 'member')";
            if (mysqli_query($this->conn, $insert_query)) {
                return ["status" => 1, "message" => "Joined community as member."];
            } else {
                return ["status" => 0, "message" => "Could not join community: " . mysqli_error($this->conn)];
            }
        }
    }

    public function getCommunityMemberCount($cid)
    {
        $cid = mysqli_real_escape_string($this->conn, $cid);

        $query = "SELECT COUNT(uid) AS member_count FROM community_members WHERE cid = $cid";
        $result = mysqli_query($this->conn, $query);
        $data = mysqli_fetch_assoc($result);
        return $data['member_count'];
    }
}