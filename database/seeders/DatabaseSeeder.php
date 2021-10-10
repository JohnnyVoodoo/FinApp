<?php

namespace Database\Seeders;

use Database\Seeders\Transactions\TransactionsSeeder;
use Database\Seeders\Transactions\TransactionStatusesSeeder;
use Database\Seeders\Users\UsersSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersSeeder::class);
        $this->call(TransactionStatusesSeeder::class);
        $this->call(TransactionsSeeder::class);
    }
}
