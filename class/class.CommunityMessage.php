<?php
class CommunityMessage
{
    private $conn;
    private $uid;

    public function __construct($db, $user_id)
    {
        $this->conn = $db;
        $this->uid = $user_id;
    }

    /**
     * SECURITY GUARD: Checks if user belongs to the community
     */
    public function isMember($cid)
    {
        $sql = "SELECT 1 FROM community_members WHERE cid = ? AND uid = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $cid, $this->uid);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }

    /**
     * Side-bar logic: Fetches joined communities ordered by most recent activity
     */
    public function getJoinedCommunitiesWithLatest()
    {
        $sql = "SELECT c.cid, c.name, c.cover_image,
                (SELECT content FROM community_messages 
                 WHERE cid = c.cid 
                 ORDER BY sent_at DESC LIMIT 1) as last_message_text,
                (SELECT sent_at FROM community_messages 
                 WHERE cid = c.cid 
                 ORDER BY sent_at DESC LIMIT 1) as last_message_time,
                (SELECT u.fullname FROM community_messages cm 
                 JOIN users u ON cm.sender_uid = u.uid 
                 WHERE cm.cid = c.cid 
                 ORDER BY cm.sent_at DESC LIMIT 1) as last_sender
                FROM communities c
                JOIN community_members cm_member ON c.cid = cm_member.cid
                WHERE cm_member.uid = ?
                ORDER BY last_message_time DESC, c.name ASC";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $this->uid);
        $stmt->execute();
        return $stmt->get_result();
    }

    /**
     * Fetches all messages for a specific community
     */
    public function getGroupMessages($cid)
    {
        $sql = "SELECT cm.*, u.fullname, u.profile_pic 
                FROM community_messages cm
                JOIN users u ON cm.sender_uid = u.uid
                WHERE cm.cid = ?
                ORDER BY cm.sent_at ASC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $cid);
        $stmt->execute();
        return $stmt->get_result();
    }

    /**
     * Save a new community message
     */
    public function sendGroupMessage($cid, $content)
    {
        if (!$this->isMember($cid)) return false;
        
        $sql = "INSERT INTO community_messages (cid, sender_uid, content) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iis", $cid, $this->uid, $content);
        return $stmt->execute();
    }
}