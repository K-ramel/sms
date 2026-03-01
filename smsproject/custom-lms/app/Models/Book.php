<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Model;

class Book extends Model
{
    public function all(): array
    {
        return $this->db->query('SELECT * FROM books ORDER BY title ASC')->fetchAll();
    }

    public function availableByKeyword(?string $keyword): array
    {
        $sql = 'SELECT * FROM books WHERE 1=1';
        $params = [];

        if ($keyword !== null && $keyword !== '') {
            $sql .= ' AND (title LIKE :q OR author LIKE :q OR category LIKE :q)';
            $params['q'] = '%' . $keyword . '%';
        }

        $sql .= ' ORDER BY title ASC';
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll();
    }

    public function create(array $data): bool
    {
        $stmt = $this->db->prepare('INSERT INTO books (title, author, category, quantity, status) VALUES (:title, :author, :category, :quantity, :status)');
        return $stmt->execute($data);
    }

    public function update(int $id, array $data): bool
    {
        $data['id'] = $id;
        $stmt = $this->db->prepare('UPDATE books SET title=:title, author=:author, category=:category, quantity=:quantity, status=:status WHERE book_id=:id');
        return $stmt->execute($data);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare('DELETE FROM books WHERE book_id = :id');
        return $stmt->execute(['id' => $id]);
    }

    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM books WHERE book_id = :id');
        $stmt->execute(['id' => $id]);
        return $stmt->fetch() ?: null;
    }
}
