<?php

namespace App\Services\ConfirmationMethods;

use App\Models\User;
use Illuminate\Support\Facades\Log;

class SMSConfirmation implements ConfirmationMethodInterface
{
    public function send(User $user, string $code): void
    {
        // TODO: симуляция
        // Симуляция отправки кода по SMS
        Log::info("Отправка кода подтверждения {$code} по SMS на номер пользователю #{$user->id}");
    }
}
