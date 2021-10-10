<?php

namespace Database\Factories\Transactions;

use App\Models\Transactions\Transaction;
use App\Models\Transactions\TransactionStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Transaction::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'sender_id' => rand(1,5),
            'recipient_id' => rand(6,10),
            'amount' => rand(50, 250),
            'status_id' => rand(1,3),
            'transact_at' => now()->addHours(rand(1,10))->format('Y-d-m H:00:00'),
        ];
    }

    public function planned() {
        return $this->state(function (array $attributes) {
            return [
                'status_id' => TransactionStatus::PLANNED_STATUS_ID,
                'sender_id' => rand(1,3),
                'recipient_id' => rand(4,10),
            ];
        });
    }

    public function success() {
        return $this->state(function (array $attributes) {
            $sender = rand(1,10);
            $recipient = rand(1,9);
            $recipient = $recipient == $sender ? ++$recipient : $recipient;
            return [
                'status_id' => TransactionStatus::SUCCESS_STATUS_ID,
                'sender_id' => $sender,
                'recipient_id' => $recipient,
                'transact_at' => now()->subHours(rand(1,10))->format('Y-d-m H:00:00'),
            ];
        });
    }
}
