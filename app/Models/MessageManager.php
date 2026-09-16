<?php

class MessageManager extends AbstractEntityManager
{
    public function findConversationUsers(int $userId): array
    {
        $sql = <<<'SQL'
            SELECT users.id, users.username, users.profile_photo, MAX(messages.created_at) AS last_message_at
            FROM users
            INNER JOIN messages ON users.id = CASE
                WHEN messages.sender_id = :user_id_sender THEN messages.receiver_id
                ELSE messages.sender_id
            END
            WHERE messages.sender_id = :user_id_receiver OR messages.receiver_id = :user_id_recipient
            GROUP BY users.id, users.username, users.profile_photo
            ORDER BY last_message_at DESC
        SQL;

        return $this->db->query($sql, [
            'user_id_sender' => $userId,
            'user_id_receiver' => $userId,
            'user_id_recipient' => $userId,
        ])->fetchAll();
    }

    public function findConversation(int $userId, int $contactId): array
    {
        $sql = <<<'SQL'
            SELECT id, sender_id, receiver_id, content, created_at
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
        $sql = 'INSERT INTO messages (sender_id, receiver_id, content) VALUES (:sender_id, :receiver_id, :content)';
        $this->db->query($sql, [
            'sender_id' => $senderId,
            'receiver_id' => $receiverId,
            'content' => $content,
        ]);
    }
}