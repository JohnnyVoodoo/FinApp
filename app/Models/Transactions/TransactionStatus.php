<?php

namespace App\Models\Transactions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $alias
 */
class TransactionStatus extends Model
{
    use HasFactory;

    protected $table = 'transaction_statuses';
    public $timestamps = false;
    public $incrementing = false;

    const PLANNED_STATUS_ID = 1;
    const SUCCESS_STATUS_ID = 2;
    const REJECTED_STATUS_ID = 3;

    protected $fillable = ['id', 'alias'];
}
