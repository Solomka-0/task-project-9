<?php

namespace App\Repositories;

use App\Models\UserSetting;
use App\Repositories\Interfaces\UserSettingRepositoryInterface;

class UserSettingRepository implements UserSettingRepositoryInterface
{
    public function updateOrCreate(array $attributes, array $values): \App\Models\UserSetting
    {
        return UserSetting::updateOrCreate($attributes, $values);
    }
}
