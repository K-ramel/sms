<?php

class User extends Model
{
    public function create(array $data): bool
    {
        $this->db->query('INSERT INTO users (name, email, password, role) VALUES (:name, :email, :password, :role)');
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':role', $data['role']);
        return $this->db->execute();
    }

    public function all(): array
    {
        $this->db->query('SELECT id, name, email, role, created_at FROM users ORDER BY id DESC');
        return $this->db->resultSet();
    }

    public function find(int $id): array|false
    {
        $this->db->query('SELECT * FROM users WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function findByEmail(string $email): array|false
    {
        $this->db->query('SELECT * FROM users WHERE email = :email LIMIT 1');
        $this->db->bind(':email', $email);
        return $this->db->single();
    }

    public function update(int $id, array $data): bool
    {
        $sql = 'UPDATE users SET name = :name, email = :email, role = :role';
        if (!empty($data['password'])) {
            $sql .= ', password = :password';
        }
        $sql .= ' WHERE id = :id';

        $this->db->query($sql);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':role', $data['role']);
        if (!empty($data['password'])) {
            $this->db->bind(':password', $data['password']);
        }
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    public function delete(int $id): bool
    {
        $this->db->query('DELETE FROM users WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    public function total(): int
    {
        $this->db->query('SELECT COUNT(*) AS total FROM users');
        $result = $this->db->single();
        return (int) ($result['total'] ?? 0);
    }
}
