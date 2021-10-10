<?php

namespace App\Repositories\Transactions;

use App\Models\Transactions\Transaction;
use App\Models\Transactions\TransactionStatus;
use App\Repositories\BaseRepository;

class TransactionRepository extends BaseRepository
{

    public function __construct()
    {
        parent::__construct(app(Transaction::class));
    }

    public function planned(): TransactionRepository
    {
        $this->builder->where('status_id', TransactionStatus::PLANNED_STATUS_ID);
        return $this;
    }

    public function fromSender(int $userID): TransactionRepository
    {
        $this->builder->where('sender_id', $userID);
        return $this;
    }

    public function transactAt(string $datetime) {
        $this->builder->where('transact_at', $datetime);
        return $this;
    }
}
