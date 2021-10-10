<?php

namespace App\Http\Resources\Users;

use App\Models\Users\User;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

/**
 * @mixin User
 */
class UserWithLatestTransactionResource extends JsonResource
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
            'name' => $this->name,
            'recipient' => $this->recipient,
            'amount' => $this->amount,
            'transact_at' => $this->transact_at,
        ];
    }
}
