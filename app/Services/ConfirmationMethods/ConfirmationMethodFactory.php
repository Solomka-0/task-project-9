<?php

namespace App\Services\ConfirmationMethods;

use App\Enums\ConfirmationMethodEnum;

/**
 * Фабрика для метода подтверждения
 */
class ConfirmationMethodFactory
{
    public static function make(ConfirmationMethodEnum $method): ConfirmationMethodInterface
    {
        return match ($method) {
            ConfirmationMethodEnum::Email => new EmailConfirmation(),
            ConfirmationMethodEnum::SMS => new SmsConfirmation(),
            ConfirmationMethodEnum::Telegram => new TelegramConfirmation(),
        };
    }
}
