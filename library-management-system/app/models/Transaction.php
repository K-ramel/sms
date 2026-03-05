<?php

class Transaction extends Model
{
    public function create(array $data): bool
    {
        $this->db->query('INSERT INTO transactions (user_id, book_id, borrow_date, due_date, status) VALUES (:user_id, :book_id, :borrow_date, :due_date, :status)');
        foreach ($data as $key => $value) {
            $this->db->bind(':' . $key, $value);
        }
        return $this->db->execute();
    }

    public function all(): array
    {
        $this->db->query('SELECT t.*, u.name AS user_name, b.title AS book_title FROM transactions t JOIN users u ON u.id=t.user_id JOIN books b ON b.id=t.book_id ORDER BY t.id DESC');
        return $this->db->resultSet();
    }

    public function find(int $id): array|false
    {
        $this->db->query('SELECT * FROM transactions WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function update(int $id, array $data): bool
    {
        $this->db->query('UPDATE transactions SET borrow_date=:borrow_date, due_date=:due_date, return_date=:return_date, status=:status WHERE id=:id');
        foreach ($data as $key => $value) {
            $this->db->bind(':' . $key, $value);
        }
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    public function delete(int $id): bool
    {
        $this->db->query('DELETE FROM transactions WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    public function markReturned(int $id): bool
    {
        $this->db->query('UPDATE transactions SET status = "returned", return_date = CURDATE() WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    public function borrowedCount(): int
    {
        $this->db->query('SELECT COUNT(*) AS total FROM transactions WHERE status = "borrowed"');
        $result = $this->db->single();
        return (int) ($result['total'] ?? 0);
    }

    public function overdueCount(): int
    {
        $this->db->query('SELECT COUNT(*) AS total FROM transactions WHERE status = "borrowed" AND due_date < CURDATE()');
        $result = $this->db->single();
        return (int) ($result['total'] ?? 0);
    }

    public function byUser(int $userId): array
    {
        $this->db->query('SELECT t.*, b.title, b.author FROM transactions t JOIN books b ON b.id=t.book_id WHERE t.user_id = :user_id ORDER BY t.id DESC');
        $this->db->bind(':user_id', $userId);
        return $this->db->resultSet();
    }
}
