<?php

namespace App\Console\Commands;

use App\Models\Transactions\Transaction;
use App\Repositories\Transactions\TransactionRepository;
use App\Services\Transactions\TransactionService;
use Illuminate\Console\Command;

class ExecTransactions extends Command
{
    protected $signature = 'transactions:execute';
    protected $description = 'Проведет переводы текущего часа';

    private TransactionRepository $transactionRepository;
    private TransactionService $transactionService;

    public function __construct()
    {
        parent::__construct();
        $this->transactionRepository = app(TransactionRepository::class);
        $this->transactionService = app(TransactionService::class);
    }

    public function handle(): int
    {
        $datetime = now()->format("Y-m-d H:00:00");
        $this->transactionRepository->transactAt($datetime)
            ->planned()
            ->chunk(10, function ($transactions) {
                /** @var Transaction $transaction */
                foreach ($transactions as $transaction) {
                    $this->transactionService->execTransaction($transaction);
                }
            });
        return 1;
    }
}
