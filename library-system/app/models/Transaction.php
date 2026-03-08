<?php

namespace App\Models;

use Core\Model;

class Transaction extends Model
{
    public function createBorrowRequest(int $userId, int $bookId, string $dueDate): bool
    {
        $sql = 'INSERT INTO transactions (user_id, book_id, borrow_date, due_date, status) VALUES (:user_id, :book_id, NOW(), :due_date, :status)';

        return (bool)$this->query($sql, [
            'user_id' => $userId,
            'book_id' => $bookId,
            'due_date' => $dueDate,
            'status' => 'Pending',
        ]);
    }

    public function confirmBorrow(int $transactionId): bool
    {
        return (bool)$this->query('UPDATE transactions SET status = :status WHERE id = :id', [
            'status' => 'Borrowed',
            'id' => $transactionId,
        ]);
    }

    public function completeReturn(int $transactionId): bool
    {
        return (bool)$this->query('UPDATE transactions SET return_date = NOW(), status = :status WHERE id = :id', [
            'status' => 'Returned',
            'id' => $transactionId,
        ]);
    }

    public function userHistory(int $userId): array
    {
        $sql = 'SELECT t.*, b.title, b.author FROM transactions t INNER JOIN books b ON b.id = t.book_id WHERE t.user_id = :user_id ORDER BY t.borrow_date DESC';
        return $this->query($sql, ['user_id' => $userId])->fetchAll();
    }

    public function pending(): array
    {
        $sql = 'SELECT t.*, b.title, u.name FROM transactions t INNER JOIN books b ON b.id = t.book_id INNER JOIN users u ON u.id = t.user_id WHERE t.status = :status ORDER BY t.borrow_date DESC';
        return $this->query($sql, ['status' => 'Pending'])->fetchAll();
    }

    public function active(): array
    {
        $sql = 'SELECT t.*, b.title, u.name FROM transactions t INNER JOIN books b ON b.id = t.book_id INNER JOIN users u ON u.id = t.user_id WHERE t.status = :status ORDER BY t.due_date ASC';
        return $this->query($sql, ['status' => 'Borrowed'])->fetchAll();
    }

    public function find(int $id): array|false
    {
        return $this->query('SELECT * FROM transactions WHERE id = :id LIMIT 1', ['id' => $id])->fetch();
    }

    public function monthlyReport(): array
    {
        return $this->query('SELECT DATE_FORMAT(borrow_date, "%Y-%m") AS month, COUNT(*) AS total FROM transactions GROUP BY month ORDER BY month DESC')->fetchAll();
    }

    public function annualReport(): array
    {
        return $this->query('SELECT YEAR(borrow_date) AS year, COUNT(*) AS total FROM transactions GROUP BY year ORDER BY year DESC')->fetchAll();
    }
}
