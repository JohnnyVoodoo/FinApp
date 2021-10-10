<?php

namespace App\Http\Resources\Transactions;

use App\Http\Resources\Users\UserResource;
use App\Models\Transactions\Transaction;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

/**
 * @mixin Transaction
 */
class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'sender' => UserResource::make($this->sender),
            'recipient' => UserResource::make($this->recipient),
            'amount' => $this->amount,
            'transact_at' => $this->transact_at->format('Y-m-d H:i:s'),
            'status' => TransactionStatusResource::make($this->status)
        ];
    }
}
