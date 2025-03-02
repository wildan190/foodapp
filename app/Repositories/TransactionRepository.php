<?php

namespace App\Repositories;

use App\Models\Transaction;
use App\Repositories\Interface\TransactionRepositoryInterface;

class TransactionRepository implements TransactionRepositoryInterface
{
    public function getAllTransactions()
    {
        return Transaction::orderBy('transaction_date', 'desc')->get();
    }

    public function getTransactionById($id)
    {
        return Transaction::findOrFail($id);
    }

    public function createTransaction(array $data)
    {
        return Transaction::create($data);
    }

    public function updateTransaction($id, array $data)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->update($data);

        return $transaction;
    }

    public function deleteTransaction($id)
    {
        $transaction = Transaction::findOrFail($id);

        return $transaction->delete();
    }
}
