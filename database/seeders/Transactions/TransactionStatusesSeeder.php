<?php

namespace Database\Seeders\Transactions;

use App\Models\Transactions\TransactionStatus;
use Illuminate\Database\Seeder;

class TransactionStatusesSeeder extends Seeder
{
    const STATUSES = [
        ['id' => 1, 'alias' => 'planned'],
        ['id' => 2, 'alias' => 'success'],
        ['id' => 3, 'alias' => 'rejected']
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (self::STATUSES as $status) {
            TransactionStatus::updateOrCreate(['id' => $status['id']], $status);
        }
    }
}
