<?php

namespace App\Services\ConfirmationMethods;

use App\Models\User;
use Illuminate\Support\Facades\Log;

class TelegramConfirmation implements ConfirmationMethodInterface
{
    public function send(User $user, string $code): void
    {
        // TODO: симуляция
        // Симуляция отправки кода в Telegram
        Log::info("Отправка кода подтверждения {$code} в Telegram пользователю #{$user->id}");
    }
}
