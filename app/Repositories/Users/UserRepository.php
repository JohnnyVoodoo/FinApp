<?php
namespace App\Repositories\Users;

use App\Models\Users\User;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;

class UserRepository extends BaseRepository {

    public function __construct()
    {
        parent::__construct(app(User::class));
    }

    public function except(array $userIDs = null): UserRepository
    {
        $this->builder->when(!empty($userIDs), function (Builder $builder) use ($userIDs) {
            $builder->whereNotIn('id', $userIDs);
        });
        return $this;
    }
}
