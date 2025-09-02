<?php

declare(strict_types=1);

namespace App\Repositories\Common;

use App\Models\User;
use App\Repositories\BaseRepository;

/**
 * @extends BaseRepository<User>
 */
final class UserRepository extends BaseRepository
{
    public function getModel(): User
    {
        return app(User::class);
    }
}
