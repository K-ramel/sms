<?php

namespace App\Models;

use Core\Model;

class Book extends Model
{
    public function all(): array
    {
        return $this->query('SELECT * FROM books ORDER BY created_at DESC')->fetchAll();
    }

    public function search(string $keyword): array
    {
        $sql = 'SELECT * FROM books WHERE title LIKE :keyword OR author LIKE :keyword OR category LIKE :keyword ORDER BY title';
        return $this->query($sql, ['keyword' => "%{$keyword}%"])->fetchAll();
    }

    public function create(array $data): bool
    {
        $sql = 'INSERT INTO books (title, author, category, year, status, created_at) VALUES (:title, :author, :category, :year, :status, NOW())';
        return (bool)$this->query($sql, $data);
    }

    public function update(int $id, array $data): bool
    {
        $data['id'] = $id;
        $sql = 'UPDATE books SET title = :title, author = :author, category = :category, year = :year, status = :status WHERE id = :id';
        return (bool)$this->query($sql, $data);
    }

    public function delete(int $id): bool
    {
        return (bool)$this->query('DELETE FROM books WHERE id = :id', ['id' => $id]);
    }

    public function find(int $id): array|false
    {
        return $this->query('SELECT * FROM books WHERE id = :id LIMIT 1', ['id' => $id])->fetch();
    }

    public function setStatus(int $id, string $status): bool
    {
        return (bool)$this->query('UPDATE books SET status = :status WHERE id = :id', [
            'status' => $status,
            'id' => $id,
        ]);
    }
}
