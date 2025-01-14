<?php

namespace App\Repositories\Interfaces;

use App\Models\SettingConfirmation;

interface SettingConfirmationRepositoryInterface
{
    public function create(array $data): SettingConfirmation;
    public function findPendingConfirmation(int $userId, string $code): ?SettingConfirmation;
    public function markAsConfirmed(SettingConfirmation $confirmation): void;
}
