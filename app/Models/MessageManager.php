<?php

class MessageManager extends AbstractEntityManager
{
    public function countUnread(int $userId): int
    {
        $sql = 'SELECT COUNT(*) FROM messages WHERE receiver_id = :user_id AND viewed = 0';

        return (int) $this->db->query($sql, ['user_id' => $userId])->fetchColumn();
    }

    public function markConversationAsViewed(int $userId, int $contactId): void
    {
        $sql = 'UPDATE messages SET viewed = 1 WHERE receiver_id = :user_id AND sender_id = :contact_id AND viewed = 0';
        $this->db->query($sql, [
            'user_id' => $userId,
            'contact_id' => $contactId,
        ]);
    }

    public function findConversationUsers(int $userId): array
    {
        $sql = <<<'SQL'
            SELECT users.id, users.username, users.profile_photo_mime, MAX(messages.created_at) AS last_message_at,
                (
                    SELECT latest_message.content
                    FROM messages AS latest_message
                    WHERE (latest_message.sender_id = :user_id_latest_sender AND latest_message.receiver_id = users.id)
                       OR (latest_message.sender_id = users.id AND latest_message.receiver_id = :user_id_latest_receiver)
                    ORDER BY latest_message.created_at DESC, latest_message.id DESC
                    LIMIT 1
                ) AS last_message
            FROM users
            INNER JOIN messages ON users.id = CASE
                WHEN messages.sender_id = :user_id_sender THEN messages.receiver_id
                ELSE messages.sender_id
            END
            WHERE messages.sender_id = :user_id_receiver OR messages.receiver_id = :user_id_recipient
            GROUP BY users.id, users.username, users.profile_photo_mime
            ORDER BY last_message_at DESC
        SQL;

        return $this->db->query($sql, [
            'user_id_sender' => $userId,
            'user_id_receiver' => $userId,
            'user_id_recipient' => $userId,
                'user_id_latest_sender' => $userId,
                'user_id_latest_receiver' => $userId,
        ])->fetchAll();
    }

    public function findConversation(int $userId, int $contactId): array
    {
        $sql = <<<'SQL'
            SELECT id, sender_id, receiver_id, content, created_at, viewed
            FROM messages
            WHERE (sender_id = :user_id_sender AND receiver_id = :contact_id_receiver)
               OR (sender_id = :contact_id_sender AND receiver_id = :user_id_receiver)
            ORDER BY created_at ASC, id ASC
        SQL;

        return $this->db->query($sql, [
            'user_id_sender' => $userId,
            'contact_id_receiver' => $contactId,
            'contact_id_sender' => $contactId,
            'user_id_receiver' => $userId,
        ])->fetchAll();
    }

    public function create(int $senderId, int $receiverId, string $content): void
    {
        $sql = 'INSERT INTO messages (sender_id, receiver_id, content, viewed) VALUES (:sender_id, :receiver_id, :content, 0)';
        $this->db->query($sql, [
            'sender_id' => $senderId,
            'receiver_id' => $receiverId,
            'content' => $content,
        ]);
    }
}