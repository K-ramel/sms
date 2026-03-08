<?php

class Penalty extends Model
{
    public function create(array $data): bool
    {
        $this->db->query('INSERT INTO penalties (transaction_id, days_late, penalty_amount) VALUES (:transaction_id, :days_late, :penalty_amount)');
        foreach ($data as $key => $value) {
            $this->db->bind(':' . $key, $value);
        }
        return $this->db->execute();
    }

    public function all(): array
    {
        $this->db->query('SELECT p.*, t.user_id, u.name AS user_name, b.title AS book_title FROM penalties p JOIN transactions t ON t.id=p.transaction_id JOIN users u ON u.id=t.user_id JOIN books b ON b.id=t.book_id ORDER BY p.id DESC');
        return $this->db->resultSet();
    }

    public function find(int $id): array|false
    {
        $this->db->query('SELECT * FROM penalties WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function update(int $id, array $data): bool
    {
        $this->db->query('UPDATE penalties SET days_late=:days_late, penalty_amount=:penalty_amount WHERE id=:id');
        $this->db->bind(':days_late', $data['days_late']);
        $this->db->bind(':penalty_amount', $data['penalty_amount']);
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    public function delete(int $id): bool
    {
        $this->db->query('DELETE FROM penalties WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    public function byUser(int $userId): array
    {
        $this->db->query('SELECT p.*, b.title FROM penalties p JOIN transactions t ON t.id=p.transaction_id JOIN books b ON b.id=t.book_id WHERE t.user_id = :user_id ORDER BY p.id DESC');
        $this->db->bind(':user_id', $userId);
        return $this->db->resultSet();
    }
}
