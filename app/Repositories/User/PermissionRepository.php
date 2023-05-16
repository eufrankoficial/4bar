<?php

namespace App\Repositories\User;

use App\Models\GroupPermission;
use App\Repositories\BaseRepository;

/**
 * Class UserGroupRepository.
 * @package App\Repositories\User.
 */
class PermissionRepository extends BaseRepository
{
    protected $modelClass = GroupPermission::class;
}
