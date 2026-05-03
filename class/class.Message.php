<?php
class Message
{
    private $conn;
    private $uid;

    public function __construct($conn, $uid)
    {
        $this->conn = $conn;
        $this->uid = $uid;
    }

    // Get list of users the current user has exchanged messages with
    public function getChatHistoryList()
    {
        $sql = "SELECT DISTINCT 
                CASE WHEN sender_uid = $this->uid THEN receiver_uid ELSE sender_uid END as contact_id 
                FROM direct_messages 
                WHERE sender_uid = $this->uid OR receiver_uid = $this->uid
                ORDER BY sent_at DESC";
        return $this->conn->query($sql);
    }

    // Get messages between current user and a specific target user
    public function getMessagesWith($target_uid)
    {
        $target_uid = (int) $target_uid;
        $sql = "SELECT * FROM direct_messages 
                WHERE (sender_uid = $this->uid AND receiver_uid = $target_uid) 
                OR (sender_uid = $target_uid AND receiver_uid = $this->uid) 
                ORDER BY sent_at ASC";
        return $this->conn->query($sql);
    }

    // Save a new message
    public function sendMessage($receiver_uid, $content)
    {
        $content = mysqli_real_escape_string($this->conn, $content);
        $sql = "INSERT INTO direct_messages (sender_uid, receiver_uid, content) 
                VALUES ($this->uid, $receiver_uid, '$content')";
        return $this->conn->query($sql);
    }
    public function getFriendsToChatWith()
    {
        // Finds users you are friends with, excluding yourself
        $sql = "SELECT users.uid, users.fullname, users.profile_pic 
            FROM friendships 
            JOIN users ON (friendships.sender_uid = users.uid OR friendships.reciver_uid = users.uid)
            WHERE (friendships.sender_uid = $this->uid OR friendships.reciver_uid = $this->uid)
            AND users.uid != $this->uid
            AND friendships.status = 'accepted'";
        return $this->conn->query($sql);
    }

    public function getConversationsList()
    {
        $sql = "SELECT DISTINCT users.uid, users.fullname, users.profile_pic,
            -- Get the timestamp of the latest message
            (SELECT MAX(sent_at) FROM direct_messages 
             WHERE (sender_uid = users.uid AND receiver_uid = $this->uid) 
             OR (sender_uid = $this->uid AND receiver_uid = $this->uid)) as last_message_time,
            -- Get the actual content of that latest message
            (SELECT content FROM direct_messages 
             WHERE (sender_uid = users.uid AND receiver_uid = $this->uid) 
             OR (sender_uid = $this->uid AND receiver_uid = users.uid)
             ORDER BY sent_at DESC LIMIT 1) as last_message_text
            FROM users
            WHERE users.uid IN (
                SELECT CASE WHEN sender_uid = $this->uid THEN reciver_uid ELSE sender_uid END 
                FROM friendships WHERE (sender_uid = $this->uid OR reciver_uid = $this->uid) AND status = 'accepted'
                UNION
                SELECT CASE WHEN sender_uid = $this->uid THEN receiver_uid ELSE sender_uid END 
                FROM direct_messages WHERE sender_uid = $this->uid OR receiver_uid = $this->uid
            )
            ORDER BY last_message_time DESC, users.fullname ASC";
        return $this->conn->query($sql);
    }

    public function getFriendshipStatus($target_uid)
    {
        $target_uid = (int) $target_uid;
        $sql = "SELECT status FROM friendships 
            WHERE (sender_uid = $this->uid AND reciver_uid = $target_uid) 
            OR (sender_uid = $target_uid AND reciver_uid = $this->uid) 
            LIMIT 1";
        $result = $this->conn->query($sql);
        if ($row = $result->fetch_assoc()) {
            return $row['status'];
        }
        return 'none';
    }

    // Inside class.Message.php
    public function isUserConnected($target_uid)
    {
        // Note the spelling 'reciver_uid' from your CREATE TABLE statement
        $sql = "SELECT 1 FROM friendships 
            WHERE (
                (sender_uid = ? AND reciver_uid = ?) 
                OR 
                (sender_uid = ? AND reciver_uid = ?)
            ) 
            AND status = 'accepted' LIMIT 1";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iiii", $this->uid, $target_uid, $target_uid, $this->uid);
        $stmt->execute();
        return $stmt->get_result()->num_rows > 0;
    }
}