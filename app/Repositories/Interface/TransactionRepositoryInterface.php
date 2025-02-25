<?php

namespace App\Repositories\Interface;

use App\Models\Transaction;

interface TransactionRepositoryInterface
{
    public function getAllTransactions();
    public function getTransactionById($id);
    public function createTransaction(array $data);
    public function updateTransaction($id, array $data);
    public function deleteTransaction($id);
}
