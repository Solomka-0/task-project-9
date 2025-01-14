<?php

namespace App\Repositories;

use App\Models\SettingConfirmation;
use App\Repositories\Interfaces\SettingConfirmationRepositoryInterface;
use Illuminate\Support\Carbon;

class SettingConfirmationRepository implements SettingConfirmationRepositoryInterface
{
    public function create(array $data): SettingConfirmation
    {
        return SettingConfirmation::create($data);
    }

    public function findPendingConfirmation(int $userId, string $code): ?SettingConfirmation
    {
        return SettingConfirmation::where('user_id', $userId)
            ->where('confirmation_code', $code)
            ->whereNull('confirmed_at')
            ->where('expires_at', '>', Carbon::now())
            ->first();
    }

    public function markAsConfirmed(SettingConfirmation $confirmation): void
    {
        $confirmation->update(['confirmed_at' => Carbon::now()]);
    }
}
