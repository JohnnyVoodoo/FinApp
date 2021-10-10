<?php

namespace App\Models\Users;

use App\Models\Transactions\Transaction;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property integer $balance
 * @property \Carbon\Carbon $email_verified_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read Collection|Transaction[] $transactions
 * @property-read Collection|Transaction[] $incomes
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'balance'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $dates = ['email_verified_at','created_at','updated_at'];

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'sender_id');
    }

    public function incomes(): HasMany
    {
        return $this->hasMany(Transaction::class, 'recipient_id');
    }
}
