<?php

namespace App\Services\Users;

use App\Models\Transactions\TransactionStatus;
use App\Models\Users\User;
use App\Repositories\Users\UserRepository;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Query\JoinClause;

class UserService
{

    private UserRepository $userRepository;

    public function __construct()
    {
        $this->userRepository = app(UserRepository::class);
    }

    /**
     * @param array $userIDs
     * @return EloquentBuilder[]|EloquentCollection
     */
    public function getUsersExceptIDs(array $userIDs)
    {
        return $this->userRepository->newQuery()
            ->except($userIDs)
            ->get();
    }

    public function getTransactions(User $user, array $with = []): EloquentCollection
    {
        return $user->transactions()
            ->with($with)
            ->orderBy('transact_at', 'desc')
            ->get();
    }

    public function getUsersWithLatestTransactions() {
        return $this->userRepository
            ->selectRaw('users.*, recipient.name as recipient, transactions.transact_at, transactions.amount')
            ->join('transactions', function (JoinClause $join) {
                $join->on('users.id', '=', 'transactions.sender_id')
                    ->where('transactions.status_id', TransactionStatus::SUCCESS_STATUS_ID);
            })
            ->join('users as recipient', function (JoinClause $join) {
                $join->on('recipient.id', '=', 'transactions.recipient_id');
            })
            ->groupBy('users.id')
            ->havingRaw('MAX(transactions.transact_at)')
            ->get();
    }
}
