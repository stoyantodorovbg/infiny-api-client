<?php

namespace App\Repositories\Interfaces;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface UserRepositoryInterface extends RepositoryInterface
{
    /**
     * Get user's clients paginated
     *
     * @param User $user
     * @param int  $perPage
     * @return LengthAwarePaginator
     */
    public function userClientsPaginated(User $user, int $perPage = 20): LengthAwarePaginator;
}
