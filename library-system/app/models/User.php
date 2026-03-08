<?php

namespace App\Models;

use Core\Model;

class User extends Model
{
    public function create(array $data): bool
    {
        $sql = 'INSERT INTO users (name, email, student_id, password, role, status, created_at) VALUES (:name, :email, :student_id, :password, :role, :status, NOW())';

        return (bool)$this->query($sql, $data);
    }

    public function findByEmail(string $email): array|false
    {
        $statement = $this->query('SELECT * FROM users WHERE email = :email LIMIT 1', ['email' => $email]);

        return $statement->fetch();
    }

    public function all(): array
    {
        return $this->query('SELECT * FROM users ORDER BY created_at DESC')->fetchAll();
    }

    public function updateStatus(int $id, string $status): bool
    {
        return (bool)$this->query('UPDATE users SET status = :status WHERE id = :id', [
            'status' => $status,
            'id' => $id,
        ]);
    }
}
