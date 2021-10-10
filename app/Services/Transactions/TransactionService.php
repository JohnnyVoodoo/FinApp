<?php

namespace App\Services\Transactions;

use App\Models\Transactions\Transaction;
use App\Models\Users\User;
use App\Repositories\Transactions\TransactionRepository;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

class TransactionService
{

    private TransactionRepository $transactionRepository;

    public function __construct()
    {
        $this->transactionRepository = app(TransactionRepository::class);
    }

    public function getUserFreeFunds(User $user): int
    {
        $plannedTransactions = $this->getUserPlannedTransactions($user->id);
        $plannedSum = $plannedTransactions->pluck('amount')->sum();
        return $user->balance - $plannedSum;
    }

    /**
     * @param int $userId
     * @return EloquentBuilder[]|EloquentCollection
     */
    public function getUserPlannedTransactions(int $userId)
    {
        return $this->transactionRepository->planned()
            ->fromSender($userId)
            ->get();
    }

    public function create(array $attributes): Transaction
    {
        return $this->transactionRepository->create($attributes);
    }
}
