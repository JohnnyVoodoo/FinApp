<?php

namespace Database\Seeders\Transactions;

use App\Models\Transactions\Transaction;
use Illuminate\Database\Seeder;

class TransactionsSeeder extends Seeder
{
    public function run()
    {
        Transaction::factory(50)->success()->create();
        Transaction::factory(10)->planned()->create();
    }
}
