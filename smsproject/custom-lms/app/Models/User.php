<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Model;

class User extends Model
{
    public function create(array $data): bool
    {
        $stmt = $this->db->prepare(
            'INSERT INTO users (school_id, fullname, email, password, role, department, status, created_at) VALUES (:school_id, :fullname, :email, :password, :role, :department, :status, NOW())'
        );

        return $stmt->execute($data);
    }

    public function findByEmail(string $email): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE email = :email LIMIT 1');
        $stmt->execute(['email' => $email]);
        return $stmt->fetch() ?: null;
    }

    public function pending(): array
    {
        return $this->db->query("SELECT * FROM users WHERE status = 'Pending' ORDER BY created_at DESC")->fetchAll();
    }

    public function updateStatus(int $id, string $status): bool
    {
        $stmt = $this->db->prepare('UPDATE users SET status = :status WHERE user_id = :id');
        return $stmt->execute(['status' => $status, 'id' => $id]);
    }

    public function all(): array
    {
        return $this->db->query('SELECT user_id, school_id, fullname, email, role, department, status, created_at FROM users ORDER BY created_at DESC')->fetchAll();
    }
}
