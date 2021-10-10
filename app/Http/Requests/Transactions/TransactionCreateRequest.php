<?php

namespace App\Http\Requests\Transactions;

use App\Models\Users\User;
use App\Services\Transactions\TransactionService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class TransactionCreateRequest extends FormRequest
{
    private TransactionService $transactionService;

    public function __construct(array $query = [], array $request = [], array $attributes = [], array $cookies = [], array $files = [], array $server = [], $content = null)
    {
        parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);
        $this->transactionService = app(TransactionService::class);
    }

    protected function prepareForValidation()
    {
        $transactAt = implode(' ', [
            $this->transaction_date,
            $this->transaction_time
        ]);
        $this->merge([
            'transact_at' => $transactAt
        ]);
    }

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        /** @var User $user */
        $user = Auth::user();
        $maxAmount = $this->transactionService->getUserFreeFunds($user);
        return [
            'recipient_id' => ['required', 'exists:users,id', 'notIn:'.$user->id],
            'amount' => ['required', 'integer', 'max:'.$maxAmount],
            'transact_at' => ['required', 'date', 'after:now'],
        ];
    }

    public function messages(): array
    {
        return [
            'recipient_id.required' => "Необходимо указать получателя перевода.",
            'recipient_id.notIn' => "Нельзя отправить перевод самому себе.",
            'transact_at.required' => "Необходимо указать дату и время перевода.",
            'transact_at.date' => "Необходимо указать дату и время перевода.",
            'transact_at.after' => "Дату и время перевода должны быть больше текущих.",
            'amount.required' => "Необходимо указать сумму перевода.",
            'amount.integer' => "Сумму перевода должна быть целым числом.",
            'amount.max' => "Недостаточно средств для осуществления перевода.",
        ];
    }
}
