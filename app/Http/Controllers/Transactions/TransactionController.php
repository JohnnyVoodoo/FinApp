<?php

namespace App\Http\Controllers\Transactions;

use App\Http\Controllers\Controller;
use App\Http\Requests\Transactions\TransactionCreateRequest;
use App\Http\Resources\Transactions\TransactionResource;
use App\Http\Resources\Users\UserResource;
use App\Models\Transactions\TransactionStatus;
use App\Models\Users\User;
use App\Services\Transactions\TransactionService;
use App\Services\Users\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    private UserService $userService;

    private TransactionService $transactionService;

    public function __construct()
    {
        $this->userService = app(UserService::class);
        $this->transactionService = app(TransactionService::class);
    }

    public function index()
    {
        /** @var User $user */
        $user = Auth::user();
        $users = $this->userService->getUsersExceptIDs([$user->id]);
        $transactions = $this->userService->getTransactions($user, [
            'sender', 'recipient', 'status'
        ]);
        return view('transactions', [
            'users' => UserResource::collection($users),
            'transactions' => TransactionResource::collection($transactions)
        ]);
    }

    public function create(TransactionCreateRequest $request)
    {
        /** @var User $user */
        $user = Auth::user();
        $attributes = $request->validated();
        $attributes['status_id'] = TransactionStatus::PLANNED_STATUS_ID;
        $attributes['sender_id'] = $user->id;
        $this->transactionService->create($attributes);
        $users = $this->userService->getUsersExceptIDs([$user->id]);
        $transactions = $this->userService->getTransactions($user, [
            'sender', 'recipient', 'status'
        ]);
        return view('transactions', [
            'users' => UserResource::collection($users),
            'transactions' => TransactionResource::collection($transactions)
        ]);
    }
}
