<?php

namespace App\Services\Transactions;

use App\Models\Transactions\Transaction;
use App\Models\Transactions\TransactionStatus;
use App\Models\Users\User;
use App\Repositories\Transactions\TransactionRepository;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Facades\DB;

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

    public function execTransaction(Transaction $transaction) {
        $sender = $transaction->sender;
        $recipient = $transaction->recipient;
        DB::transaction(function () use ($sender, $recipient, $transaction) {
            $sender->update([
                'balance' => $sender->balance - $transaction->amount
            ]);
            $recipient->update([
                'balance' => $recipient->balance + $transaction->amount
            ]);
            $transaction->update([
                'status_id' => TransactionStatus::SUCCESS_STATUS_ID
            ]);
        });
    }
}
