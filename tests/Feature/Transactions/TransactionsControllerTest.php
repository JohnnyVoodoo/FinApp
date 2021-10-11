<?php

namespace Tests\Feature\Transactions;

use App\Models\Transactions\Transaction;
use App\Models\Transactions\TransactionStatus;
use App\Models\Users\User;
use Database\Factories\Transactions\TransactionFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TransactionsControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_transactions_screen_can_be_rendered()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/transactions');
        $response->assertStatus(200);
    }

    public function test_transactions_can_create()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        TransactionStatus::factory()->planned()->create();
        $datetime = explode(' ', now()->addHours(1)->format('Y-m-d H:i:s'));
        $response = $this->actingAs($user1)
            ->post('/transactions', [
                'sender_id' => $user1->id,
                'recipient_id' => $user2->id,
                'amount' => 500,
                'transaction_date' => $datetime[0],
                'transaction_time' => $datetime[1],
            ]);
        $response->assertStatus(200);
    }

    public function test_transactions_create_fail()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        TransactionStatus::factory()->planned()->create();
        $datetime = explode(' ', now()->addHours(1)->format('Y-m-d H:i:s'));
        $response = $this->actingAs($user1)
            ->post('/transactions', [
                'sender_id' => $user1->id,
                'recipient_id' => $user2->id,
                'amount' => 1000000,
                'transaction_date' => $datetime[0],
                'transaction_time' => $datetime[1],
            ]);
        $response->assertRedirect();
    }

    public function test_transactions_create_fail_more_planned()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        TransactionStatus::factory()->planned()->create();
        Transaction::factory()->makeOne([
            'sender_id' => $user1->id,
            'recipient_id' => $user2->id,
            'amount' => 2000,
            'status_id' => 1,
            'transact_at' => now()->addHours(rand(1,10))->format('Y-d-m H:00:00'),
        ])->save();
        $datetime = explode(' ', now()->addHours(1)->format('Y-m-d H:i:s'));
        $response = $this->actingAs($user1)
            ->post('/transactions', [
                'sender_id' => $user1->id,
                'recipient_id' => $user2->id,
                'amount' => 9000,
                'transaction_date' => $datetime[0],
                'transaction_time' => $datetime[1],
            ]);
        $response->assertRedirect();
    }

    public function test_last_transactions_list_screen_can_be_rendered()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/transactions/latest');
        $response->assertStatus(200);
    }
}
