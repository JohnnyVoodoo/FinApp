<?php

namespace Database\Factories\Transactions;

use App\Models\Transactions\TransactionStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionStatusFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TransactionStatus::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => 1,
            'alias' => 'planned',
        ];
    }

    public function planned() {
        return $this->state(function (array $attributes) {
            return [
                'id' => 1,
                'alias' => 'planned',
            ];
        });
    }

    public function success() {
        return $this->state(function (array $attributes) {
            return [
                'id' => 2,
                'alias' => 'success',
            ];
        });
    }

    public function rejected() {
        return $this->state(function (array $attributes) {
            return [
                'id' => 3,
                'alias' => 'rejected',
            ];
        });
    }
}
