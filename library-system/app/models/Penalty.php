<?php

namespace App\Models;

use Core\Model;

class Penalty extends Model
{
    public function create(int $transactionId, float $amount): bool
    {
        $sql = 'INSERT INTO penalties (transaction_id, amount, status) VALUES (:transaction_id, :amount, :status)';

        return (bool)$this->query($sql, [
            'transaction_id' => $transactionId,
            'amount' => $amount,
            'status' => $amount > 0 ? 'Unpaid' : 'Paid',
        ]);
    }
}
