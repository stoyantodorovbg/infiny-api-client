<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class UserRepository extends Repository implements UserRepositoryInterface
{
    protected string $model = User::class;

    public function userClientsPaginated(User $user, int $perPage = 10): LengthAwarePaginator
    {
        return $user->clients()->paginate($perPage);
    }
}
