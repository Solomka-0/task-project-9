<?php

namespace App\Enums;

enum ConfirmationMethodEnum: string
{
    case Email = 'email';
    case SMS = 'sms';
    case Telegram = 'telegram';

    /**
     * Получить массив значений для валидации.
     *
     * @return array
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
