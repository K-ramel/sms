<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Model;

class Transaction extends Model
{
    public function createRequest(int $userId, int $bookId): bool
    {
        $stmt = $this->db->prepare("INSERT INTO transactions (user_id, book_id, borrow_date, due_date, status, penalty_amount) VALUES (:user_id, :book_id, CURDATE(), DATE_ADD(CURDATE(), INTERVAL 7 DAY), 'Requested', 0)");
        return $stmt->execute(['user_id' => $userId, 'book_id' => $bookId]);
    }

    public function requested(): array
    {
        return $this->db->query("SELECT t.*, u.fullname, b.title FROM transactions t JOIN users u ON u.user_id=t.user_id JOIN books b ON b.book_id=t.book_id WHERE t.status='Requested' ORDER BY t.transaction_id DESC")->fetchAll();
    }

    public function borrowedByUser(int $userId): array
    {
        $stmt = $this->db->prepare('SELECT t.*, b.title, b.author FROM transactions t JOIN books b ON b.book_id=t.book_id WHERE t.user_id=:uid ORDER BY t.transaction_id DESC');
        $stmt->execute(['uid' => $userId]);
        return $stmt->fetchAll();
    }

    public function markBorrowed(int $transactionId): bool
    {
        $stmt = $this->db->prepare("UPDATE transactions SET status='Borrowed' WHERE transaction_id=:id");
        return $stmt->execute(['id' => $transactionId]);
    }

    public function borrowedActive(): array
    {
        return $this->db->query("SELECT t.*, u.fullname, b.title FROM transactions t JOIN users u ON u.user_id=t.user_id JOIN books b ON b.book_id=t.book_id WHERE t.status='Borrowed' ORDER BY t.due_date ASC")->fetchAll();
    }

    public function returnBook(int $transactionId): bool
    {
        $stmt = $this->db->prepare('SELECT due_date FROM transactions WHERE transaction_id=:id');
        $stmt->execute(['id' => $transactionId]);
        $transaction = $stmt->fetch();

        if (!$transaction) {
            return false;
        }

        $dueDate = strtotime($transaction['due_date']);
        $today = strtotime(date('Y-m-d'));
        $daysLate = max(0, (int)(($today - $dueDate) / 86400));
        $penalty = $daysLate * 10;

        $update = $this->db->prepare("UPDATE transactions SET return_date=CURDATE(), status='Returned', penalty_amount=:penalty WHERE transaction_id=:id");

        return $update->execute(['penalty' => $penalty, 'id' => $transactionId]);
    }

    public function penaltyList(): array
    {
        return $this->db->query('SELECT t.transaction_id, u.fullname, b.title, t.penalty_amount, t.status FROM transactions t JOIN users u ON u.user_id=t.user_id JOIN books b ON b.book_id=t.book_id WHERE t.penalty_amount > 0 ORDER BY t.transaction_id DESC')->fetchAll();
    }

    public function reportSummary(): array
    {
        return [
            'users' => (int) $this->db->query('SELECT COUNT(*) FROM users')->fetchColumn(),
            'books' => (int) $this->db->query('SELECT COUNT(*) FROM books')->fetchColumn(),
            'borrowed' => (int) $this->db->query("SELECT COUNT(*) FROM transactions WHERE status='Borrowed'")->fetchColumn(),
            'penalties' => (float) $this->db->query('SELECT COALESCE(SUM(penalty_amount),0) FROM transactions')->fetchColumn(),
        ];
    }
}
