<?php

namespace App\Services\Users;

use App\Models\Users\User;
use App\Repositories\Users\UserRepository;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

class UserService
{

    private UserRepository $userRepository;

    public function __construct()
    {
        $this->userRepository = app(UserRepository::class);
    }

    /**
     * @param array $userIDs
     * @return EloquentBuilder[]|EloquentCollection
     */
    public function getUsersExceptIDs(array $userIDs)
    {
        return $this->userRepository->newQuery()
            ->except($userIDs)
            ->get();
    }

    public function getTransactions(User $user, array $with = []): EloquentCollection
    {
        return $user->transactions()
            ->with($with)
            ->orderBy('transact_at', 'desc')
            ->get();
    }
}
