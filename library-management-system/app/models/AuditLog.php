<?php

class AuditLog extends Model
{
    public function create(array $data): bool
    {
        $this->db->query('INSERT INTO audit_logs (user_id, action) VALUES (:user_id, :action)');
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':action', $data['action']);
        return $this->db->execute();
    }

    public function all(): array
    {
        $this->db->query('SELECT a.*, u.name FROM audit_logs a JOIN users u ON u.id=a.user_id ORDER BY a.id DESC');
        return $this->db->resultSet();
    }

    public function find(int $id): array|false
    {
        $this->db->query('SELECT * FROM audit_logs WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function update(int $id, array $data): bool
    {
        $this->db->query('UPDATE audit_logs SET action=:action WHERE id=:id');
        $this->db->bind(':action', $data['action']);
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    public function delete(int $id): bool
    {
        $this->db->query('DELETE FROM audit_logs WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}
