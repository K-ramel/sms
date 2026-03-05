<?php

class Book extends Model
{
    public function create(array $data): bool
    {
        $this->db->query('INSERT INTO books (title, author, category, isbn, quantity, available) VALUES (:title, :author, :category, :isbn, :quantity, :available)');
        foreach ($data as $key => $value) {
            $this->db->bind(':' . $key, $value);
        }
        return $this->db->execute();
    }

    public function all(): array
    {
        $this->db->query('SELECT * FROM books ORDER BY id DESC');
        return $this->db->resultSet();
    }

    public function find(int $id): array|false
    {
        $this->db->query('SELECT * FROM books WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function search(string $keyword): array
    {
        $this->db->query('SELECT * FROM books WHERE title LIKE :keyword OR author LIKE :keyword OR category LIKE :keyword ORDER BY title ASC');
        $this->db->bind(':keyword', '%' . $keyword . '%');
        return $this->db->resultSet();
    }

    public function update(int $id, array $data): bool
    {
        $this->db->query('UPDATE books SET title=:title, author=:author, category=:category, isbn=:isbn, quantity=:quantity, available=:available WHERE id=:id');
        foreach ($data as $key => $value) {
            $this->db->bind(':' . $key, $value);
        }
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    public function delete(int $id): bool
    {
        $this->db->query('DELETE FROM books WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    public function adjustAvailability(int $bookId, int $delta): bool
    {
        $this->db->query('UPDATE books SET available = available + :delta WHERE id = :id');
        $this->db->bind(':delta', $delta);
        $this->db->bind(':id', $bookId);
        return $this->db->execute();
    }

    public function total(): int
    {
        $this->db->query('SELECT COUNT(*) AS total FROM books');
        $result = $this->db->single();
        return (int) ($result['total'] ?? 0);
    }
}
