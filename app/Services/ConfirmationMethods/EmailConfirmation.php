<?php

namespace App\Services\ConfirmationMethods;

use App\Models\User;
use Illuminate\Support\Facades\Log;

class EmailConfirmation implements ConfirmationMethodInterface
{
    public function send(User $user, string $code): void
    {
        // Симуляция отправки кода по Email
        // В реальной реализации Mail::to($user)->send(new ConfirmationMail($code)) или использовать обертку;
        Log::info("Отправка кода подтверждения {$code} на Email #{$user->id}");
    }
}
