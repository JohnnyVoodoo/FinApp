<?php

namespace App\Models\Transactions;

use App\Models\Users\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['sender_id', 'recipient_id', 'amount', 'status_id', 'transact_at'];
    protected $dates = ['created_at', 'updated_at', 'transact_at'];

    public function sender() {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function recipient() {
        return $this->belongsTo(User::class, 'recipient_id');
    }

    public function status() {
        return $this->belongsTo(TransactionStatus::class, 'status_id');
    }
}
