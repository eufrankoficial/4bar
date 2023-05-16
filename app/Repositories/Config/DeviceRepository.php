<?php

namespace App\Repositories\Config;

use App\Models\Device;
use App\Repositories\BaseRepository;

/**
 * Class MenuRepository.
 * @package App\Repositories\Config.
 */
class DeviceRepository extends BaseRepository
{

    /**
     * @var string.
     */
    protected $modelClass = Device::class;


}
