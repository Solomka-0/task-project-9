<?php

namespace App\Repositories\Interfaces;

use App\Models\UserSetting;

interface UserSettingRepositoryInterface
{
    public function updateOrCreate(array $attributes, array $values): UserSetting;
}
